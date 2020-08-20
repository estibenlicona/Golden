<!DOCTYPE html>
<html>
<head>
	<title>My Team</title>
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>
<style type="text/css">
	body {
		background: #fff;
	}
	
	a {
		color: #000;
	}

	.bl-card{
		height: 100px;
		font-size: 19px;
		font-weight: bold; 
	}

	.bl-card-title{
		font-size: 13px;
	}

	.card-money{
		font-size: 18px;
		position: absolute;
		bottom: 0px;
		right: 15px;
	}

	.bl-card-img{
		height: 270px;
	}

	.card-img-star{

		width: 90%;
	}

</style>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-dark">
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <a class="navbar-brand text-light" href="<?= base_url('/team') ?>">Team</a>

	  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
	    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
	      <li class="nav-item active">
	        <a class="nav-link text-light" href="<?= base_url('/jugadores') ?>">Jugadores</a>
	      </li>
	    </ul>
	  </div>
	</nav>
	<div class="container">
		<div class="row mt-4">
			<div class="col-md-3 shadow rounded bl-card">
				<label class="bl-card-title">Total ingresos</label>				
				<label class="card-money">$ 3,500,000</label>				
			</div>			
			<div class="col-md-3 shadow rounded bl-card">
				<label class="bl-card-title">Partidos ganados</label>				
				<label class="card-money">$ 3,500,000</label>	
			</div>
			<div class="col-md-3 shadow rounded bl-card">
				<label class="bl-card-title">Partidos empatados</label>				
				<label class="card-money">$ 3,500,000</label>	
			</div>
			<div class="col-md-3 shadow rounded bl-card">
				<label class="bl-card-title">Partidos perdidos</label>				
				<label class="card-money">$ 3,500,000</label>	
			</div>
		</div>
		<div class="row mt-4">
			<div class="col-md-12">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item" role="presentation">
						<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Equipo</a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Presupuesto</a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Jugadores</a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Titulos</a>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<div class="row mt-4">
							<div class="col-md-3">
								<div class="card" style="width: 18rem;">
								  <h5 class="card-title mt-3 text-center">Alianza Platanera</h5>
								  <img src="<?= base_url('assets\escudos\alianzaplatanera.png') ?>" class="rounded mx-auto d-block" width="200px">
								  <img src="<?= base_url('assets\icons\5_estrellas.png') ?>" class="rounded mx-auto d-block" width="200px">
								</div>
							</div>
							<div class="col-md-9 pl-5">
								<div class="card">
								  <div class="card-body">
								    This is some text within a card body.
								  </div>
								</div>
							</div>

						</div>
					</div>
					<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</div>
					<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>