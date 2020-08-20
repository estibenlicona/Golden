<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
<body>
	<div class="container">
		<div class="row mt-3">
			<div class="col-md-12">
				<button id="buscar-actualizaciones" class="btn btn-dark">Buscar</button>
				<button id="comprobar-actualizaciones" class="btn btn-dark">Actualizar 10</button>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<ul id="jugadores"></ul>
			</div>
		</div>
	</div>
	<div id="content" style="visibility: hidden;"></div>
</body>
<script type="text/javascript">
var date = new Date();
var month = date.getMonth()+1;
var year = date.getFullYear();

var url_base = "<?php echo base_url(); ?>";
var jugadores = [];

$('#buscar-actualizaciones').click(function () {
	$.getJSON('https://api.allorigins.win/get?url=' + encodeURIComponent('https://pesstatsdatabase.com/PSD/Select/Updates/Updates.php?Nation=global&Championship=1&Year='+year+'&Month='+month), function (data) {
		$('#content').html(data.contents);
		var p = $('#content').find("p");
		var day = $('h1').find("a[name]").attr("name");
		$('#content').html(p);
		p.each(function (index, item) {
			var href = $(item).find("a[href^='Player.php']").attr("href");
			var start = href.indexOf("Id=") + 3;
			var end = href.indexOf("&Club");
			var id = href.slice(start, end);
			var auxdate = $(item).children("span[class='data']").text().trim();
			var date = new Date(auxdate);
			var jugador = {id: id, date: date};
			if (auxdate.indexOf(day) != -1) {
				jugadores.push(jugador);
			}

		});

		console.log(jugadores);


	});

});

$('#comprobar-actualizaciones').click(function () {

	var url = url_base + "api/players/update";

	for (var i = 0; i < 10 && jugadores.length > 0; i++) {
		fetch(url, {
		  method: 'POST',
		  body: JSON.stringify(jugadores[i]),
		  headers:{
		    'Content-Type': 'application/json'
		  }
		}).then(function (response) {
			response.json().then(function(data) {
		        if (!data.psd) {
					jugadores.splice(jugadores[i], 1);
		        }
		    });
		});
	}

	if (jugadores.length == 0) {
		alert("Jugadores actualizados");
		return;
	}

});

Array.prototype.unique=function(a){
  return function(){return this.filter(a.id)}}(function(a,b,c){return c.indexOf(a.id,b+1)<0
});

</script>