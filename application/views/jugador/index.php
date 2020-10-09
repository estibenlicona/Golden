<!DOCTYPE html>
<html>
<head>
	<title>Jugadores</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/nouislider/main.css') ?>">
	<script type="text/javascript" src="<?= base_url('assets/wnumb/main.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/nouislider/main.js') ?>"></script>
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

</head>
<style type="text/css">
	.noUi-connect {
		background: #343a40 !important;
	}

	.noUi-tooltip {
   		display: none;
	}

	.noUi-active .noUi-tooltip {
	    display: block;
	}

	#bs-select-1::-webkit-scrollbar {
	    width: 10px !important;
	    height: 10px !important;
	}
	#bs-select-1::-webkit-scrollbar-thumb {
	    background: #343a40 !important;
	    border-radius: 4px !important;
	}

	#bs-select-1::-webkit-scrollbar-thumb:hover {
	    background: #b3b3b3;
	    box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.2);
	}

	#bs-select-1::-webkit-scrollbar-thumb:active {
	    background-color: #999999;
	}

	#table-players_wrapper .page-item.active .page-link {
	    background-color: #343a40 !important;
	    border-color: #343a40 !important;
	}

	#table-players_wrapper .page-item.active .page-link:focus {
	    box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.3);
	    color: #fff !important;
	}

	#table-players_wrapper .active a{
		color: #fff !important;
	}

	#table-players_wrapper .page-link {
	    color: #000;
	}

	.text-red {
		color: #FF0000;
	}

	.text-orange {
		color: #FF8000;
	}

	.text-yellow {
		color: #FFFF00;
	}

	.text-green {
		color: #008000;
	}

	#table-players_wrapper{
		background: #343a40 !important;
		border-radius: 5px;
		padding: 20px;
		color: #fff;
	}

	.border-input-search {
		border-bottom-left-radius: 0px !important;
		border-bottom-right-radius: 0px !important;
	}

	.container, .col-md-12 {
		padding-left: 0px !important;
		padding-right: 0px !important;
	}

	.row {
		margin-left: 0px !important;
		margin-right: 0px !important;
	}

	#input-search {
		border: 0px !important;
		box-shadow: none !important;
	}

	.div-input-search {
		position: absolute;
		right: 0px;
		left: 0px;
		z-index: 1001;
		border: 1px solid rgba(0,0,0,.125);
	}

	.border-top-item{
		border-top:  1px solid rgba(0,0,0,.125) !important;
	}

</style>
<body>
	<div class="container pt-3 pl-0 pr-0 pb-5">
		<h4>Buscar por nombre</h4>
		<hr/>
		<div class="row">
			<div class="col-md-12" style="height: 55px;">
				<div id="div-lista" class="div-input-search rounded-sm">
					<input type="text" id="input-search" class="form-control form-control-lg" placeholder="Nombre">
					<ul id="ul-search" class="list-group list-group-flush"></ul>	
				</div>
			</div>
		</div> <br>
		<div class="row">
			<div class="col-md-12">
				<h4 class="float-left">Buscar por habilidad</h4>
				<button id="btn-buscar" class="btn btn-dark float-right ml-3" type="button">Buscar</button>
				<select 
					class="ability-select float-right" 
					data-style="btn-dark text-white" 
					title="Habilidades"
					data-selected-text-format="count > 3"
					data-width="auto"
					multiple>
				  <?php foreach ($aHabilidades as $oHabilidad): ?>
				  <option value="<?= $oHabilidad->clave ?>"><?= $oHabilidad->descripcion ?></option>
				  <?php endforeach ?>
				</select>
			</div>
		</div>
		<hr/>
		<div class="row pt-1">
			<div class="col-md-12 text-center">
				<img id="img-load" src="<?= base_url('assets/icons/load.gif') ?>" width="200px" height="200px">
			</div>
			<?php foreach ($aHabilidades as $oHabilidad): ?>
			<div class="div-slider col-md-12 mb-3" id="div-<?= $oHabilidad->clave ?>-slider">
				<h5 class="float-left"><?= $oHabilidad->descripcion ?></h5>
				<h5 class="text-right"><span id="<?= $oHabilidad->clave ?>-min">85</span> - <span id="<?= $oHabilidad->clave ?>-max">99</span></h5>
				<div id="slider-<?= $oHabilidad->clave ?>" class="sliders"></div>
			</div>			
			<?php endforeach ?>
		</div>
		<div class="row">
			<div class="col-md-12" id="container-table"></div>
		</div>
	</div>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
	<script>
		// Btn Ver Jugador
		function ver_jugador(btn) {
			var playe_id = $(btn).attr('player');
			var tipo = $(btn).attr('playerTipo').toLowerCase();
			url = "<?php echo base_url() ?>" + "jugador/"+tipo+"/" + playe_id;
      		window.open(url, '_blank');
		}

		// Input Search
		var input_search = $("#input-search");
		
		input_search.keyup(function() {

			var text = input_search.val();

			var ul_search = $('#ul-search');

		  	input_search.removeClass("border-input-search");

			if (text.length < 3) { 
				ul_search.html("");
				return; 
			}

		  	var url = "<?= base_url('api/players/like');?>";

		  	var data = {
		  		text: text 
		  	};


		  	$.post(url, data, function () {
		  		ul_search.html("");
		  	})
			.done(function(response) {

				var players = response.body;
				
				players.forEach(function (player, index) {
					var id = player.id;
					var name = player.name;
					var tipo = player.tipo;
					var positions = getPosition(player.positions, "");
					
					var border_top = "";
					if (index == 0) {
						border_top = "border-top-item"
					}

					var li = "<li class='list-group-item "+border_top+"'>"+
								"<span class='float-left mr-3'>"+name+"</span>"+
								"<button type='button' player='"+id+"' playerTipo="+tipo+" class='btn btn-dark btn-sm float-right ml-3' onClick='ver_jugador(this)'>"+tipo+"</button>"
								+positions+
							 "</li>"; 
		  			input_search.addClass("border-input-search");
		  			ul_search.append(li);

				});
		    	
			});
		});

		// Imagen de carga
		var img_load = $('#img-load');
		img_load.hide();

		var lang = {
	            lengthMenu: " _MENU_ ",
	            zeroRecords: "No se encontró ningún jugador que cumpla con las condiciones establecidas.",
	            info: " _PAGE_ de _PAGES_",
	            infoEmpty: "",
	            infoFiltered: "(filtered from _MAX_ total records)",
	            search: "",
	            paginate: {
	            	next: "Siguiente",
	            	previous: "Atrás"
	            }
	    };

		var habilities = new Array();
	    habilities["balance"] = "Estabilidad";
	    habilities["top_speed"] = "Velocidad";
	    habilities["acceleration"] = "Aceleración";
	    habilities["stamina"] = "Resistencia";
	    habilities["attack"] = "Ataque";
	    habilities["defence"] = "Defensa";
	    habilities["response"] = "Respuesta";
	    habilities["agility"] = "Agilidad";

		// Select Picker
		var selectpicker = $('.ability-select');
		selectpicker.selectpicker({
			maxOptions: 4
		});

	    // Sliders 
		var sliders = document.getElementsByClassName('sliders');
		for ( var i = 0; i < sliders.length; i++ ) {
			noUiSlider.create(sliders[i], {
				start: [85, 99],
				step: 1,
				connect: true,
				padding: [1, 1], 
				behaviour: 'drag',
			    tooltips: true,
			    margin: 4,
			    format: wNumb({
			        decimals: 0
			    }),
				range: {
					min: [0],
					max: [100]
				}
			});
		}


		selectpicker.change(function() {
		$(".ability-select option").each(function() {
				
				var idslider = "#div-" + $(this).val() + "-slider";
		    	var slider = $(idslider);

		    	if (this.selected) {
			    	slider.fadeIn();
		    	}else{
			    	slider.fadeOut();
		    	}
		    });
		});

		// Buscar
		$("#btn-buscar").click(function () {
			
			var filters = selectpicker.selectpicker('val');

			if (filters.length == 0) { return; }

			$('#container-table').html(
				"<table id='table-players' class='table table-dark'>" +
				  "<thead id='head-table'></thead>" +
				  "<tbody id='body-table'></tbody>" +
				"</table>"
			);

			// Tabla
			var table = $("#table-players");
			var table_head = $("#head-table");
			var table_body = $("#body-table");

			$('.div-slider').fadeOut();
			img_load.fadeIn();
			
			var url = "<?= base_url('api/players/search');?>";

			var data = {
				fields: filters.reverse().join(", "), 
				filters: [] 
			};

			filters.forEach(function (filter, index) {
				var slider = document.getElementById('slider-' + filter);
				var values = slider.noUiSlider.get();
				var aux = {
					clave: filter,
					min: values[0],
					max: values[1]
				};

				data.filters.push(aux);
			});

			$.post(url, data)
			.always(function() {
    			img_load.fadeOut();
  			})
			.done(function(response) {

				var auxHeads = "";
				filters.forEach(function (filter) {
					auxHeads = auxHeads + "<th class='text-center'>"+habilities[filter]+"</th>"; 
				});

				var players = response.body;
				var head = "<tr><th>Jugador</th><th>Posiciones</th>"+auxHeads+"<th>Ver</th></tr>";
			    table_head.html(head);
				
				players.forEach(function (player, index) {

					var auxRows = [];
					filters.forEach(function (item) {

						value = player[item];

						var auxColor = "text-white";

						if (value >= 95) {
							auxColor = "text-red";
						}
						
						if(value >= 90 && value <= 94) {
							auxColor = "text-orange";
						}
						
						if (value >= 80 && value <= 89) {
							auxColor = "text-yellow";
						}

						if (value >= 75 && value <= 79) {
							auxColor = "text-green";
						}

						
						auxRows.push("<td class='text-center'><h6 class='"+auxColor+"'><strong>"+value+"</strong></h6></td>");

					});
					var rows = auxRows.join("");
					var id = player.id;
					var name = player.name;
					var positions = getPosition(player.positions);
			    	table_body.append("<tr>"+
			    							"<td><strong>"+name+"</strong></td>"+
			    							"<td>"+positions+"</td>"+
			    							rows+
			    							"<td><button type='button' player='"+id+"' playerTipo='psd' class='btn btn-light btn-sm' onClick='ver_jugador(this)'>Ir</button></td>"+
			    						"</tr>");
				});
		    	
		    	table.DataTable({
					language: lang
				});

				var input = $('#table-players_wrapper').find("input");
				input.removeClass('form-control-sm');
				input.addClass('form-control');
				input.attr('placeholder', 'Buscar');
				
				var select = $('#table-players_wrapper').find("select");
				select.removeClass('form-control-sm');
				select.removeClass('custom-select-sm'); 
				select.addClass('form-control');

		    	selectpicker.selectpicker('val', []);
				table.fadeIn(2000);
			});
		});

		function getPosition(positions, clases = "") {
			positions = positions + ",";
			var positions = positions.split(",");
			var aux = [];
			positions.forEach(function (position, index) {
				
				// Delantera
				if ("WG★, WG, CF★, CF, SS★, SS, WF★, WF".indexOf(position) >= 0) {
					var span = "<span class='badge badge-danger mr-1 "+clases+"'>"+position+"</span>";
				}

				// Medio campo
				if ("AM★, AM, DM★, DM, SM★, SM, CM★, CM, DMF★, DMF, WB★, WB, CMF★, CMF, SMF★, SMF, AMF★, AMF".indexOf(position) >= 0) {
					var span = "<span class='badge badge-success mr-1 "+clases+"'>"+position+"</span>";
				}

				// Defensa
				if ("CBT★, CBT, CWP★, CWP, CB★, CB, SB★, SB".indexOf(position) >= 0) {
					var span = "<span class='badge badge-primary mr-1 "+clases+"'>"+position+"</span>";
				}

				// Porteria
				if ("GK★, GK".indexOf(position) >= 0) {
					var span = "<span class='badge badge-warning mr-1 "+clases+"'>"+position+"</span>";
				}

				aux.push(span);
			});

			return aux.join("");
 
		}
 
	</script>
	<?php foreach ($aHabilidades as $oHabilidad): ?>
		<script type="text/javascript">
			
			$('#div-<?= $oHabilidad->clave ?>-slider').hide();

			document.getElementById('slider-<?= $oHabilidad->clave ?>').noUiSlider.on('update', function (values, handle, unencoded, isTap, positions) {
		    $('#<?= $oHabilidad->clave ?>-min').html(values[0]);
		    $('#<?= $oHabilidad->clave ?>-max').html(values[1]);
		});
		</script>
	<?php endforeach ?>
</body>
</html>