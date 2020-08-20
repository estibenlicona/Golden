<div class="container">
	<div class="row mt-2 justify-content-center">
		<div class="col-md-6">
			<div class="form-group">
				<label>ID PSD</label>
				<input id="id_psd" type="text" class="form-control">
			</div>
			<div class="form-group">
			    <label for="exampleFormControlTextarea1">Stast SOFIFA</label>
			    <textarea id="stast" class="form-control" id="exampleFormControlTextarea1" rows="26"></textarea>
			</div>
			<button id="guardar" class="form-control btn btn-dark">Guardar</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#guardar').click(function () {
		var stast = $('#stast').val();
		var id_psd = $('#id_psd').val();
		if (stast == "") {
			alert("Los stast son obligatorios.");
			return;
		}


		stast = stast.split("\n");
		var jugador = [];
		jugador['id_psd'] = $('#id_psd').val();
		var claveepecial = "";
		var aAbilities = [];
		stast.forEach(function (item, key) {
			item.trim();
			if (item.length !== 0 && claveepecial !== 'special_abilities') { 
				var clave = item.split(":")[0].trim().toLowerCase().replace(/[^A-Za-z0-9]/g, "_");
				var valor = item.split(":")[1].trim();
				if (clave === 'speed') {
					clave = 'top_speed';
				}
				if (clave === 'speed') {
					clave = 'top_speed';
				}					
				if (clave === 'swerve') {
					clave = 'curling';
				}
				if (clave === 'gk_skills') {
					clave = 'keeper_skills';
				}
				if (clave === 'heading') {
					clave = 'header';
				}
				if (clave === 'team_work') {
					clave = 'teamwork';
				}
				claveepecial = clave;
				jugador[clave] = valor;
			}else if(claveepecial === 'special_abilities'){
				var especial_ability = item.split(":")[0].trim();
				if (especial_ability.length !== 0) {
					aAbilities.push(especial_ability);
				}
			}

		});
		jugador['special_abilities'] = aAbilities.join("\n");
		var position = jugador['registred_positions'].replace("★", "");
		jugador['positions'] = jugador['positions'].replace(position, position+"★");
		delete jugador.registred_positions; 
		delete jugador.dribbling_style; 
		delete jugador.drop_kick_style; 
		delete jugador.penalty_style; 
		delete jugador.free_kick_style; 
		delete jugador.consistency; 
		
		var url = "<?= base_url('api/players/create');?>";
		var data = {
			stast: Object.assign({}, jugador),
			tipo: 1
		}

		$.post(url, data)
		.done(function(response) {
			if (response.status == true) {
				alert(response.message);
			}
		});
	});
</script>