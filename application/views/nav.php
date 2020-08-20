<nav class="navbar navbar-expand-lg navbar-light bg-dark">
  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
   		<span class="navbar-toggler-icon"></span>
  	</button>
  	<a class="navbar-brand text-light" href="<?= base_url('/jugadores') ?>">Jugadores</a>
  	<?php if (empty($sess_id)): ?>	
  	<form id="login-form" class="d-flex flex-row-reverse form-nav">
  		<button id="login" class="btn btn-light" type="button">Entrar</button>
  		<input type="text" name="pass" class="form-control element-nav password" id="pass" placeholder="Password" value="123">
  		<input type="text" name="user" class="form-control element-nav" id="user" placeholder="Username" value="admin">
  	</form>
  	<?php elseif(!empty($sess_id)):  ?>
  		<div class="d-flex flex-row-reverse form-nav">
  			<button id="out" class="btn btn-danger" type="button">Salir</button>
  		</div>
  	<?php endif ?>
</nav>
<script type="text/javascript">
	$('#login-form').disableAutoFill({
		passwordField: '.password'
	});

	var url_base = "<?php echo base_url(); ?>";
  	$('#login').click(function () {
		var user = $('#user').val(); 
		var pass = $('#pass').val(); 

		fetch(
		  url_base + "api/users/login", {
		  method: 'POST',
		  body: JSON.stringify({ user: user, pass: pass }),
		  headers:{'Content-Type': 'application/json'}
		})
		.then(response => response.json());
  	});

  	$('#out').click(function () {
  		fetch(url_base + "api/users/out", {
  			method: 'POST'
		})
		.then(response => response.json());
  	});
</script>