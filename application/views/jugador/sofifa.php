<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<div class="container pb-5">
	<div class="row mt-4">
		<div class="col-md-6 d-flex flex-row">
			<img src="<?php echo base_url('assets/icons/usuario.svg')  ?>" width="160" height="160">
			<h1 class="align-self-end"><?php echo $oPlayer->name  ?></h1>
		</div>
		<div class="col-md-6 d-flex flex-row-reverse">
			<h1 class="align-self-end"><?php echo $oPlayer->valor ?></h1>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-6">
			<div class="card d-flex flex-row bg-dark text-light p-4">
				<div style="width: 50%">
					<h6 class="mb-1">Venta máxima:</h6>
					<h6 class="mb-1">Venta minima:</h6>
				</div>
				<div style="width: 50%" class="d-flex flex-column align-items-end">
					<h6 class="mb-1"><?php echo $oPlayer->valor_maximo ?></h6>
					<h6 class="mb-1"><?php echo $oPlayer->valor_minimo ?></h6>
				</div>
			</div>
			<div class="card d-flex flex-row bg-dark text-light p-4 mt-3">
				<div style="width: 50%">
					<h6 class="mb-1">Positions:</h6>
					<h6 class="mb-1">Age:</h6>
					<h6 class="mb-1">Height:</h6>
					<h6 class="mb-1">Height:</h6>
					<h6 class="mb-1">Injury Tolerance:</h6>
					<h6 class="mb-1">Foot:</h6>
					<h6 class="mb-1">Side:</h6>
				</div>
				<div style="width: 50%" class="d-flex flex-column align-items-end">
					<h6 class="mb-1" id="position"></h6>
					<h6 class="mb-1"><?php echo $oPlayer->shirt_name ?></h6>
					<h6 class="mb-1"><?php echo $oPlayer->nationality ?></h6>
					<h6 class="mb-1"><?php echo $oPlayer->age ?></h6>
					<h6 class="mb-1"><?php echo $oPlayer->height ?> cm</h6>
					<h6 class="mb-1"><?php echo $oPlayer->weight ?> kg</h6>
					<h6 class="mb-1"><?php echo $oPlayer->injury_tolerance ?></h6>
					<h6 class="mb-1"><?php echo $oPlayer->foot ?></h6>
					<h6 class="mb-1"><?php echo $oPlayer->side ?></h6>
				</div>
			</div>
			<div class="card d-flex flex-row bg-dark text-light p-4 mt-3">
				<div style="width: 50%">
					<h6 class="mb-1">Attack:</h6>
					<h6 class="mb-1">Defence:</h6>
					<h6 class="mb-1">Balance:</h6>
					<h6 class="mb-1">Stamina:</h6>
					<h6 class="mb-1">Top Speed:</h6>
					<h6 class="mb-1">Acceleration:</h6>
					<h6 class="mb-1">Response:</h6>
					<h6 class="mb-1">Agility:</h6>
					<h6 class="mb-1">Dribble Accuracy:</h6>
					<h6 class="mb-1">Dribble Speed:</h6>
					<h6 class="mb-1">Short Pass Accuracy:</h6>
					<h6 class="mb-1">Short Pass Speed:</h6>
					<h6 class="mb-1">Long Pass Accuracy:</h6>
					<h6 class="mb-1">Long Pass Speed:</h6>
					<h6 class="mb-1">Shot Accuracy:</h6>
					<h6 class="mb-1">Shot Power:</h6>
					<h6 class="mb-1">Shot Technique:</h6>
					<h6 class="mb-1">Free Kick Accuracy:</h6>
					<h6 class="mb-1">Curling:</h6>
					<h6 class="mb-1">Header:</h6>
					<h6 class="mb-1">Jump:</h6>
					<h6 class="mb-1">Technique:</h6>
					<h6 class="mb-1">Aggression:</h6>
					<h6 class="mb-1">Mentality:</h6>
					<h6 class="mb-1">Keeper Skills:</h6>
					<h6 class="mb-1">Teamwork:</h6>
				</div>
				<div style="width: 50%" class="d-flex flex-column align-items-end">
					<h6 class="mb-1 label-ability"><?php echo $oAbilities->attack ?></h6>
					<h6 class="mb-1 label-ability"><?php echo $oAbilities->defence ?></h6>
					<h6 class="mb-1 label-ability"><?php echo $oAbilities->balance ?></h6>
					<h6 class="mb-1 label-ability"><?php echo $oAbilities->stamina ?></h6>
					<h6 class="mb-1 label-ability"><?php echo $oAbilities->top_speed ?></h6>
					<h6 class="mb-1 label-ability"><?php echo $oAbilities->acceleration ?></h6>
					<h6 class="mb-1 label-ability"><?php echo $oAbilities->response ?></h6>
					<h6 class="mb-1 label-ability"><?php echo $oAbilities->agility ?></h6>
					<h6 class="mb-1 label-ability"><?php echo $oAbilities->dribble_accuracy ?></h6>
					<h6 class="mb-1 label-ability"><?php echo $oAbilities->dribble_speed ?></h6>
					<h6 class="mb-1 label-ability"><?php echo $oAbilities->short_pass_accuracy ?></h6>
					<h6 class="mb-1 label-ability"><?php echo $oAbilities->short_pass_speed ?></h6>
					<h6 class="mb-1 label-ability"><?php echo $oAbilities->long_pass_accuracy ?></h6>
					<h6 class="mb-1 label-ability"><?php echo $oAbilities->long_pass_speed ?></h6>
					<h6 class="mb-1 label-ability"><?php echo $oAbilities->shot_accuracy ?></h6>
					<h6 class="mb-1 label-ability"><?php echo $oAbilities->shot_power ?></h6>
					<h6 class="mb-1 label-ability"><?php echo $oAbilities->shot_technique ?></h6>
					<h6 class="mb-1 label-ability"><?php echo $oAbilities->free_kick_accuracy ?></h6>
					<h6 class="mb-1 label-ability"><?php echo $oAbilities->curling ?></h6>
					<h6 class="mb-1 label-ability"><?php echo $oAbilities->header ?></h6>
					<h6 class="mb-1 label-ability"><?php echo $oAbilities->jump ?></h6>
					<h6 class="mb-1 label-ability"><?php echo $oAbilities->technique ?></h6>
					<h6 class="mb-1 label-ability"><?php echo $oPlayer->aggression ?></h6>
					<h6 class="mb-1 label-ability"><?php echo $oAbilities->mentality ?></h6>
					<h6 class="mb-1 label-ability"><?php echo $oAbilities->keeper_skills ?></h6>
					<h6 class="mb-1 label-ability"><?php echo $oAbilities->teamwork ?></h6>
				</div>
			</div>
			<div class="card d-flex flex-row bg-dark text-light p-4 mt-3">
				<div style="width: 50%">
					<h6 class="mb-1">Condition:</h6>	
					<h6 class="mb-1">Fitness:</h6>	
					<h6 class="mb-1">Weak Foot Accuracy:</h6>	
					<h6 class="mb-1">Weak Foot Frequencys:</h6>	
				</div>
				<div style="width: 50%" class="d-flex flex-column align-items-end">
					<h6 class="mb-1 label-ability"><?php echo $oPlayer->condition_fitness ?></h6>
					<h6 class="mb-1 label-ability"><?php echo $oPlayer->condition_fitness ?></h6>
					<h6 class="mb-1 label-ability"><?php echo $oPlayer->weak_foot_accuracy ?></h6>
					<h6 class="mb-1 label-ability"><?php echo $oPlayer->weak_foot_frequency ?></h6>
				</div>
			</div>	
		</div>
		<div class="col-md-6">
			<button type="button" class="btn btn-dark" data-toggle="modal" data-target="#staticBackdrop">Configurar</button>
			<?php if (!is_null($oPlayer->id_psd)): ?>
				<button id="psd" player_id="<?php echo $oPlayer->id_psd?>" class="btn btn-dark float-rigth">PSD</button>	
			<?php endif ?>
			<canvas width="1000" height="1000" id="myChart"></canvas>
			<?php if (count($aSpecialAbilities) > 0): ?>
				<div class="card d-flex flex-row bg-dark text-light p-4 mt-3">
					<div style="width: 50%">
						<?php foreach ($aSpecialAbilities as $sAbility): ?>
							<h6 class="mb-1"><?php echo $sAbility ?></h6>	
						<?php endforeach ?>
					</div>
				</div>	
			<?php endif ?>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form action="<?= base_url('api/users/updatevalueplayer') ?>" method="POST">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="staticBackdropLabel">Editar valor</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        	<input type="text" class="form-control" name="proveedor" value="sofifa" style="display:none">
	        	<input type="text" class="form-control" name="jugador" value="<?php echo $oPlayer->id ?>" style="display:none">
	        	<input type="text" class="form-control" name="valor" value="<?php echo $oPlayer->valor_simple ?>">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-dark">Guardar</button>
	      </div>
	    </div>
    </form>
  </div>
</div>
<script type="text/javascript">
	// Btn Ver Jugador
	$('#psd').click(function () {
		var playe_id = $('#psd').attr('player_id');
		url = "<?php echo base_url('/jugador/psd/') ?>" + playe_id;
  		window.open(url, '_blank');
	})

	var ctx = document.getElementById('myChart').getContext('2d');
	Chart.defaults.global.elements.point = 'none';
	var chart = new Chart(ctx, {
	    type: 'radar',
	    data: {
	        labels: ['ATA', 'TEC', 'EST', 'DEF', 'FZA', 'VCD'],
	        datasets: [{
				backgroundColor: 'rgba(20, 106, 193, 0.3)',
	            data: [
	            	parseInt("<?php echo $oAbilities->attack ?>"), 
	            	parseInt("<?php echo $oAbilities->technique ?>"), 
	            	parseInt("<?php echo $oAbilities->balance ?>"),
	            	parseInt("<?php echo $oAbilities->defence ?>"),
	            	parseInt("<?php echo $oAbilities->stamina ?>"),
	            	parseInt("<?php echo $oAbilities->top_speed ?>")
	            ]
	        }]
	    },
	    options: {
	    	legend: {
			   display: false,
			},
	    	scale: {
		        angleLines: {
		            display: false
		        },
		        ticks: {
			            suggestedMin: 1,
			            suggestedMax: 99
			        }
		    }
	    }
	});

	function setColors(value) {
		
		var color = "text-light";

		if (value >= 95) {
			color = "text-red";
		}
		
		if(value >= 90 && value <= 94) {
			color = "text-orange";
		}
		
		if (value >= 80 && value <= 89) {
			color = "text-yellow";
		}

		if (value >= 75 && value <= 79) {
			color = "text-green";
		}

		return color; 

	}

	var abilities = $('.label-ability');
	abilities.each(function (item) {
		var value = $(this).html();
		var clase = setColors(value);
		$(this).addClass(clase);
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

	var posiciones = "<?php echo $oPlayer->positions ?>";
	var htmlPosiciones = getPosition(posiciones);
	$("#position").html(htmlPosiciones);
</script>