<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 * 
	 */
	class Player extends CI_Model
	{

		const GET_ABILITIES = "SELECT attack,defence,balance,stamina,top_speed,acceleration,response,agility,dribble_accuracy,dribble_speed,short_pass_accuracy,short_pass_speed,long_pass_accuracy,long_pass_speed,shot_accuracy,shot_power,shot_technique,free_kick_accuracy,curling,header,jump,technique,mentality,keeper_skills,teamwork
								FROM jugadores WHERE id = ?;";
		

		const PLAYER_INFO = "SELECT j.aggression, j.name, j.shirt_name, j.nationality, j.age, j.height, j.weight, j.injury_tolerance, j.side, j.foot, j.condition_fitness, j.weak_foot_accuracy, j.weak_foot_frequency, j.positions, j.special_abilities, js.id as id_sofifa FROM jugadores j LEFT JOIN jugadores_sofifa js ON j.id = js.id_psd WHERE j.id = ?;";

		const GET_ABILITIES_SOFIFA = "SELECT attack,defence,balance,stamina,top_speed,acceleration,response,agility,dribble_accuracy,dribble_speed,short_pass_accuracy,short_pass_speed,long_pass_accuracy,long_pass_speed,shot_accuracy,shot_power,shot_technique,free_kick_accuracy,curling,header,jump,technique,mentality,keeper_skills,teamwork
								FROM jugadores_sofifa WHERE id = ?;";

		const PLAYER_INFO_SOFIFA = "SELECT js.aggression, js.name, js.shirt_name, js.nationality, js.age, js.height, js.weight, js.injury_tolerance, js.side, js.foot, js.condition_fitness, js.weak_foot_accuracy, js.weak_foot_frequency, js.positions, js.special_abilities, j.id id_psd FROM jugadores_sofifa js LEFT JOIN jugadores j ON js.id_psd = j.id WHERE js.id = ?;";

		
		function __construct()
		{
			parent::__construct();
			$this->load->database();
		}

		public function search($sFields, $aFilters)
		{
			try {

				if (count($aFilters) == 0) {
					throw new Exception("Filtros no proporcionados");	
				}
				
				$sSql = "SELECT id, name, positions, height, weight, nationality, age, foot, side, $sFields FROM jugadores WHERE 0 = 0";
				foreach ($aFilters as $oFilter) {

					$sClave = $oFilter['clave'];
					$iMin = $oFilter['min'];
					$iMax = $oFilter['max'];
					
					$sSql = "$sSql AND $sClave BETWEEN $iMin AND $iMax";
				}

				$oConexion = $this->db->query($sSql);
				$aJugadores = $oConexion->result();
				return $aJugadores;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}
		}

		public function like($text)
		{
			$sSql = "SELECT id, CONVERT(name USING utf8) name, CONVERT(positions USING utf8) positions, 'PSD' as tipo FROM jugadores WHERE name LIKE '%$text%'
						UNION
					SELECT id, CONVERT(name USING utf8) name, CONVERT(positions USING utf8) positions, 'SOFIFA' as tipo FROM jugadores_sofifa WHERE CONVERT(name USING utf8) LIKE '%$text%'
						LIMIT 10";
			$oConexion = $this->db->query($sSql);
			$aJugadores = $oConexion->result();
			return $aJugadores;
		}

		public function insert_sofifa($oJugador)
		{
			$this->db->insert('jugadores_sofifa', $oJugador);
		}

		public function format_psd($id)
		{
			$sSQL = Player::GET_ABILITIES;
			$oDB = $this->db->query($sSQL, array($id));
			$oAbilities = $oDB->row();

			$sSQL = Player::PLAYER_INFO;
			$oDB = $this->db->query($sSQL, array($id));
			$oPlayer = $oDB->row();

			$aPosiciones = explode(",", $oPlayer->positions);

			$aDelantero = array();
			$aDefensa = array();
			$aPortero = array();
			$aAtaque[] = 'CF★';
			$aAtaque[] = 'SS★';
			$aAtaque[] = 'WF★';
			$aAtaque[] = 'DMF★';
			$aAtaque[] = 'WB★';
			$aAtaque[] = 'CMF★';
			$aAtaque[] = 'SMF★';
			$aAtaque[] = 'AMF★';
			$aAtaque[] = 'SB★';
			$aAtaque[] = 'CWP★';
			$aDefensa[] = 'CBT★';
			$aDefensa[] = 'CB★';
			$aPortero[] = 'GK★';

			$iBalance = 0;
			$iVelocidad = 0;
			$iCountAmarillo = 0;
			$iCountNaranja = 0;
			$iPrecio = 0;
			// Es Delantero
			if (array_intersect($aAtaque, $aPosiciones)) {
				$aValoresFinales = array();	

				foreach ($oAbilities as $key => $iValue) {

					if ($iValue >= 98) {
						$aValoresFinales[$key] = 20;
					}

					if ($iValue >= 93 and $iValue <= 97) {
						$aValoresFinales[$key] = 15;
					}

					if ($iValue >= 90 and $iValue <= 92) {
						$aValoresFinales[$key] = 12;
					}				

					if ($iValue >= 86 and $iValue <= 89) {
						$aValoresFinales[$key] = 5;
					}

					if ($iValue >= 80 and $iValue <= 85) {
						$aValoresFinales[$key] = 1;
					}

					if ($iValue >= 74 and $iValue <= 79) {
						$aValoresFinales[$key] = 0.02;
					}

					if ($iValue < 74 ) {
						$aValoresFinales[$key] = .001;
					}

					if ($iValue >= 80) {
						$iCountAmarillo++;
					}

					if ($iValue >= 90) {
						$iCountNaranja++;
					}

				}

				$aValoresFinales['attack'] = $aValoresFinales['attack'] 							* 0.13;
				$aValoresFinales['defence'] = $aValoresFinales['defence'] 							* 0;
				$aValoresFinales['balance'] = $aValoresFinales['balance'] 							* 0.4;
				$aValoresFinales['stamina'] = $aValoresFinales['stamina'] 							* 0.1;
				$aValoresFinales['top_speed'] = $aValoresFinales['top_speed'] 						* 0.1;
				$aValoresFinales['acceleration'] = $aValoresFinales['acceleration'] 				* 0.1;
				$aValoresFinales['response'] = $aValoresFinales['response'] 						* 0.1;
				$aValoresFinales['agility'] = $aValoresFinales['agility'] 							* 0.1;
				$aValoresFinales['dribble_accuracy'] = $aValoresFinales['dribble_accuracy']			* 0.1;
				$aValoresFinales['dribble_speed'] = $aValoresFinales['dribble_speed'] 				* 0.1;
				$aValoresFinales['short_pass_accuracy'] = $aValoresFinales['short_pass_accuracy'] 	* 0.05;
				$aValoresFinales['short_pass_speed'] = $aValoresFinales['short_pass_speed'] 		* 0.05;
				$aValoresFinales['long_pass_accuracy'] = $aValoresFinales['long_pass_accuracy'] 	* 0.05;
				$aValoresFinales['long_pass_speed'] = $aValoresFinales['long_pass_speed'] 			* 0.05;
				$aValoresFinales['shot_accuracy'] = $aValoresFinales['shot_accuracy'] 				* 0.09;
				$aValoresFinales['shot_power'] = $aValoresFinales['shot_power'] 					* 0.04;
				$aValoresFinales['shot_technique'] = $aValoresFinales['shot_technique'] 			* 0.09;
				$aValoresFinales['free_kick_accuracy'] = $aValoresFinales['free_kick_accuracy'] 	* 0;
				$aValoresFinales['curling'] = $aValoresFinales['curling'] 							* 0.1;
				$aValoresFinales['header'] = $aValoresFinales['header'] 							* 0.1;
				$aValoresFinales['jump'] = $aValoresFinales['jump'] 								* 0.1;
				$aValoresFinales['technique'] = $aValoresFinales['technique'] 						* 0.13;
				$aValoresFinales['mentality'] = $aValoresFinales['mentality'] 						* 0.1;
				$aValoresFinales['keeper_skills'] = $aValoresFinales['keeper_skills'] 				* 0;
				$aValoresFinales['teamwork'] = $aValoresFinales['teamwork'] 						* 0.1;

				$iDescuentoVelocidad = 0;
				$iPrecio = array_sum($aValoresFinales) * 10000000;		
				if ($oAbilities->balance >= 90 and ($oAbilities->top_speed <= 79 or $oAbilities->acceleration <= 79)) {
					$iPrecio -= ($iPrecio * 0.5);
				}

				if ($oAbilities->balance <= 79 and ($oAbilities->top_speed >= 90 or $oAbilities->acceleration >= 90)) {
					$iPrecio -= ($iPrecio * 0.5);
				}

				if ($iCountAmarillo >= 12 and $iPrecio <= 80000000) {
					$iPrecio += ($iPrecio * 0.3);
				}

				if ($iCountNaranja >= 9 and $iPrecio <= 100000000) {
					$iPrecio += ($iPrecio * 0.2);
				}
			}

			if (array_intersect($aPortero, $aPosiciones)) {
					$aValoresFinales = array();

					foreach ($oAbilities as $key => $iValue) {
						if ($iValue >= 98) {
							$aValoresFinales[$key] = 20;
						}

						if ($iValue >= 93 and $iValue <= 97) {
							$aValoresFinales[$key] = 15;
						}

						if ($iValue >= 90 and $iValue <= 92) {
							$aValoresFinales[$key] = 13;
						}				

						if ($iValue >= 86 and $iValue <= 89) {
							$aValoresFinales[$key] = 5;
						}

						if ($iValue >= 80 and $iValue <= 85) {
							$aValoresFinales[$key] = 1;
						}

						if ($iValue >= 74 and $iValue <= 79) {
							$aValoresFinales[$key] = 0.02;
						}

						if ($iValue < 74 ) {
							$aValoresFinales[$key] = .001;
						}
					}

					$aValoresFinales['attack'] = $aValoresFinales['attack'] 							* 0;
					$aValoresFinales['defence'] = $aValoresFinales['defence'] 							* 0.01;
					$aValoresFinales['balance'] = $aValoresFinales['balance'] 							* 0.04;
					$aValoresFinales['stamina'] = $aValoresFinales['stamina'] 							* 0.01;
					$aValoresFinales['top_speed'] = $aValoresFinales['top_speed'] 						* 0;
					$aValoresFinales['acceleration'] = $aValoresFinales['acceleration'] 				* 0;
					$aValoresFinales['response'] = $aValoresFinales['response'] 						* 0.2;
					$aValoresFinales['agility'] = $aValoresFinales['agility'] 							* 0.01;
					$aValoresFinales['dribble_accuracy'] = $aValoresFinales['dribble_accuracy']			* 0;
					$aValoresFinales['dribble_speed'] = $aValoresFinales['dribble_speed'] 				* 0;
					$aValoresFinales['short_pass_accuracy'] = $aValoresFinales['short_pass_accuracy'] 	* 0.01;
					$aValoresFinales['short_pass_speed'] = $aValoresFinales['short_pass_speed'] 		* 0.01;
					$aValoresFinales['long_pass_accuracy'] = $aValoresFinales['long_pass_accuracy'] 	* 0.01;
					$aValoresFinales['long_pass_speed'] = $aValoresFinales['long_pass_speed'] 			* 0.01;
					$aValoresFinales['shot_accuracy'] = $aValoresFinales['shot_accuracy'] 				* 0.03;
					$aValoresFinales['shot_power'] = $aValoresFinales['shot_power'] 					* 0.03;
					$aValoresFinales['shot_technique'] = $aValoresFinales['shot_technique'] 			* 0.03;
					$aValoresFinales['free_kick_accuracy'] = $aValoresFinales['free_kick_accuracy'] 	* 0.01;
					$aValoresFinales['curling'] = $aValoresFinales['curling'] 							* 0.01;
					$aValoresFinales['header'] = $aValoresFinales['header'] 							* 0.01;
					$aValoresFinales['jump'] = $aValoresFinales['jump'] 								* 0.01;
					$aValoresFinales['technique'] = $aValoresFinales['technique'] 						* 0.01;
					$aValoresFinales['mentality'] = $aValoresFinales['mentality'] 						* 0.01;
					$aValoresFinales['keeper_skills'] = $aValoresFinales['keeper_skills'] 				* 0.2;
					$aValoresFinales['teamwork'] = $aValoresFinales['teamwork'] 						* 0.01;
					

					$iPrecio = array_sum($aValoresFinales) * 8000000;
			}

			if (array_intersect($aDefensa, $aPosiciones)) {
					$aValoresFinales = array();

					foreach ($oAbilities as $key => $iValue) {
						if ($iValue >= 98) {
							$aValoresFinales[$key] = 20;
						}

						if ($iValue >= 93 and $iValue <= 97) {
							$aValoresFinales[$key] = 15;
						}

						if ($iValue >= 90 and $iValue <= 92) {
							$aValoresFinales[$key] = 13;
						}				

						if ($iValue >= 86 and $iValue <= 89) {
							$aValoresFinales[$key] = 5;
						}

						if ($iValue >= 80 and $iValue <= 85) {
							$aValoresFinales[$key] = 1;
						}

						if ($iValue >= 74 and $iValue <= 79) {
							$aValoresFinales[$key] = 0.02;
						}

						if ($iValue < 74 ) {
							$aValoresFinales[$key] = .001;
						}
					}

					$aValoresFinales['attack'] = $aValoresFinales['attack'] 							* 0.01;
					$aValoresFinales['defence'] = $aValoresFinales['defence'] 							* 0.2;
					$aValoresFinales['balance'] = $aValoresFinales['balance'] 							* 0.2;
					$aValoresFinales['stamina'] = $aValoresFinales['stamina'] 							* 0.01;
					$aValoresFinales['top_speed'] = $aValoresFinales['top_speed'] 						* 0.09;
					$aValoresFinales['acceleration'] = $aValoresFinales['acceleration'] 				* 0.09;
					$aValoresFinales['response'] = $aValoresFinales['response'] 						* 0.05;
					$aValoresFinales['agility'] = $aValoresFinales['agility'] 							* 0.05;
					$aValoresFinales['dribble_accuracy'] = $aValoresFinales['dribble_accuracy']			* 0;
					$aValoresFinales['dribble_speed'] = $aValoresFinales['dribble_speed'] 				* 0;
					$aValoresFinales['short_pass_accuracy'] = $aValoresFinales['short_pass_accuracy'] 	* 0.07;
					$aValoresFinales['short_pass_speed'] = $aValoresFinales['short_pass_speed'] 		* 0.07;
					$aValoresFinales['long_pass_accuracy'] = $aValoresFinales['long_pass_accuracy'] 	* 0.07;
					$aValoresFinales['long_pass_speed'] = $aValoresFinales['long_pass_speed'] 			* 0.07;
					$aValoresFinales['shot_accuracy'] = $aValoresFinales['shot_accuracy'] 				* 0.05;
					$aValoresFinales['shot_power'] = $aValoresFinales['shot_power'] 					* 0.05;
					$aValoresFinales['shot_technique'] = $aValoresFinales['shot_technique'] 			* 0.05;
					$aValoresFinales['free_kick_accuracy'] = $aValoresFinales['free_kick_accuracy'] 	* 0.05;
					$aValoresFinales['curling'] = $aValoresFinales['curling'] 							* 0.15;
					$aValoresFinales['header'] = $aValoresFinales['header'] 							* 0.15;
					$aValoresFinales['jump'] = $aValoresFinales['jump'] 								* 0.15;
					$aValoresFinales['technique'] = $aValoresFinales['technique'] 						* 0.05;
					$aValoresFinales['mentality'] = $aValoresFinales['mentality'] 						* 0.01;
					$aValoresFinales['keeper_skills'] = $aValoresFinales['keeper_skills'] 				* 0;
					$aValoresFinales['teamwork'] = $aValoresFinales['teamwork'] 						* 0.01;
					

					$iPrecio = array_sum($aValoresFinales) * 8000000;
			}
			
			$oPlayer->valor_maximo = $iPrecio + ($iPrecio * 0.5); 
			$oPlayer->valor_minimo = $iPrecio - ($iPrecio * 0.5); 

			$fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
			$oPlayer->valor = $fmt->formatCurrency($iPrecio, "USD");
			$oPlayer->valor_maximo = $fmt->formatCurrency($oPlayer->valor_maximo, "USD");
			$oPlayer->valor_minimo = $fmt->formatCurrency($oPlayer->valor_minimo, "USD");

			$aSpecialAbilities = preg_split('/\n|\r\n?/', rtrim(ltrim($oPlayer->special_abilities)));
			$aData = array();
			$aData['oPlayer'] = $oPlayer;
			$aData['oAbilities'] = $oAbilities;
			$aData['aSpecialAbilities'] = $aSpecialAbilities;

			return $aData;
		}

		public function format_sofifa($id)
		{
			$sSQL = Player::GET_ABILITIES_SOFIFA;
			$oDB = $this->db->query($sSQL, array($id));
			$oAbilities = $oDB->row();

			$sSQL = Player::PLAYER_INFO_SOFIFA;
			$oDB = $this->db->query($sSQL, array($id));
			$oPlayer = $oDB->row();

			$aPosiciones = explode(",", $oPlayer->positions);
			$aDelantero = array();
			$aDefensa = array();
			$aPortero = array();
			$aAtaque[] = 'CF★';
			$aAtaque[] = 'SS★';
			$aAtaque[] = 'WF★';
			$aAtaque[] = 'WG★';
			$aAtaque[] = 'DMF★';
			$aAtaque[] = 'WB★';
			$aAtaque[] = 'CMF★';
			$aAtaque[] = 'SMF★';
			$aAtaque[] = 'SM★';
			$aAtaque[] = 'AMF★';
			$aAtaque[] = 'DM★';
			$aAtaque[] = 'AM★';
			$aAtaque[] = 'SB★';
			$aAtaque[] = 'CWP★';
			$aAtaque[] = 'CM★';
			$aDefensa[] = 'CB★';
			$aDefensa[] = 'CBT★';
			$aPortero[] = 'GK★';

			$iBalance = 0;
			$iVelocidad = 0;
			$iCountAmarillo = 0;
			$iCountNaranja = 0;
			$iPrecio = 0;
			// Es Delantero
			if (array_intersect($aAtaque, $aPosiciones)) {
				$aValoresFinales = array();	

				foreach ($oAbilities as $key => $iValue) {

					if ($iValue >= 98) {
						$aValoresFinales[$key] = 20;
					}

					if ($iValue >= 93 and $iValue <= 97) {
						$aValoresFinales[$key] = 15;
					}

					if ($iValue >= 90 and $iValue <= 92) {
						$aValoresFinales[$key] = 12;
					}				

					if ($iValue >= 86 and $iValue <= 89) {
						$aValoresFinales[$key] = 5;
					}

					if ($iValue >= 80 and $iValue <= 85) {
						$aValoresFinales[$key] = 1;
					}

					if ($iValue >= 74 and $iValue <= 79) {
						$aValoresFinales[$key] = 0.02;
					}

					if ($iValue < 74 ) {
						$aValoresFinales[$key] = .001;
					}

					if ($iValue >= 80) {
						$iCountAmarillo++;
					}

					if ($iValue >= 90) {
						$iCountNaranja++;
					}

				}

				$aValoresFinales['attack'] = $aValoresFinales['attack'] 							* 0.13;
				$aValoresFinales['defence'] = $aValoresFinales['defence'] 							* 0;
				$aValoresFinales['balance'] = $aValoresFinales['balance'] 							* 0.4;
				$aValoresFinales['stamina'] = $aValoresFinales['stamina'] 							* 0.1;
				$aValoresFinales['top_speed'] = $aValoresFinales['top_speed'] 						* 0.1;
				$aValoresFinales['acceleration'] = $aValoresFinales['acceleration'] 				* 0.1;
				$aValoresFinales['response'] = $aValoresFinales['response'] 						* 0.1;
				$aValoresFinales['agility'] = $aValoresFinales['agility'] 							* 0.1;
				$aValoresFinales['dribble_accuracy'] = $aValoresFinales['dribble_accuracy']			* 0.1;
				$aValoresFinales['dribble_speed'] = $aValoresFinales['dribble_speed'] 				* 0.1;
				$aValoresFinales['short_pass_accuracy'] = $aValoresFinales['short_pass_accuracy'] 	* 0.05;
				$aValoresFinales['short_pass_speed'] = $aValoresFinales['short_pass_speed'] 		* 0.05;
				$aValoresFinales['long_pass_accuracy'] = $aValoresFinales['long_pass_accuracy'] 	* 0.05;
				$aValoresFinales['long_pass_speed'] = $aValoresFinales['long_pass_speed'] 			* 0.05;
				$aValoresFinales['shot_accuracy'] = $aValoresFinales['shot_accuracy'] 				* 0.09;
				$aValoresFinales['shot_power'] = $aValoresFinales['shot_power'] 					* 0.04;
				$aValoresFinales['shot_technique'] = $aValoresFinales['shot_technique'] 			* 0.09;
				$aValoresFinales['free_kick_accuracy'] = $aValoresFinales['free_kick_accuracy'] 	* 0;
				$aValoresFinales['curling'] = $aValoresFinales['curling'] 							* 0.1;
				$aValoresFinales['header'] = $aValoresFinales['header'] 							* 0.1;
				$aValoresFinales['jump'] = $aValoresFinales['jump'] 								* 0.1;
				$aValoresFinales['technique'] = $aValoresFinales['technique'] 						* 0.13;
				$aValoresFinales['mentality'] = $aValoresFinales['mentality'] 						* 0.1;
				$aValoresFinales['keeper_skills'] = $aValoresFinales['keeper_skills'] 				* 0;
				$aValoresFinales['teamwork'] = $aValoresFinales['teamwork'] 						* 0.1;

				$iDescuentoVelocidad = 0;
				$iPrecio = array_sum($aValoresFinales) * 10000000;		
				if ($oAbilities->balance >= 90 and ($oAbilities->top_speed <= 79 or $oAbilities->acceleration <= 79)) {
					$iPrecio -= ($iPrecio * 0.5);
				}

				if ($oAbilities->balance <= 79 and ($oAbilities->top_speed >= 90 or $oAbilities->acceleration >= 90)) {
					$iPrecio -= ($iPrecio * 0.5);
				}

				if ($iCountAmarillo >= 12 and $iPrecio <= 80000000) {
					$iPrecio += ($iPrecio * 0.3);
				}

				if ($iCountNaranja >= 9 and $iPrecio <= 100000000) {
					$iPrecio += ($iPrecio * 0.2);
				}
			}

			if (array_intersect($aPortero, $aPosiciones)) {
					$aValoresFinales = array();

					foreach ($oAbilities as $key => $iValue) {
						if ($iValue >= 98) {
							$aValoresFinales[$key] = 20;
						}

						if ($iValue >= 93 and $iValue <= 97) {
							$aValoresFinales[$key] = 15;
						}

						if ($iValue >= 90 and $iValue <= 92) {
							$aValoresFinales[$key] = 13;
						}				

						if ($iValue >= 86 and $iValue <= 89) {
							$aValoresFinales[$key] = 5;
						}

						if ($iValue >= 80 and $iValue <= 85) {
							$aValoresFinales[$key] = 1;
						}

						if ($iValue >= 74 and $iValue <= 79) {
							$aValoresFinales[$key] = 0.02;
						}

						if ($iValue < 74 ) {
							$aValoresFinales[$key] = .001;
						}
					}

					$aValoresFinales['attack'] = $aValoresFinales['attack'] 							* 0;
					$aValoresFinales['defence'] = $aValoresFinales['defence'] 							* 0.01;
					$aValoresFinales['balance'] = $aValoresFinales['balance'] 							* 0.04;
					$aValoresFinales['stamina'] = $aValoresFinales['stamina'] 							* 0.01;
					$aValoresFinales['top_speed'] = $aValoresFinales['top_speed'] 						* 0;
					$aValoresFinales['acceleration'] = $aValoresFinales['acceleration'] 				* 0;
					$aValoresFinales['response'] = $aValoresFinales['response'] 						* 0.2;
					$aValoresFinales['agility'] = $aValoresFinales['agility'] 							* 0.01;
					$aValoresFinales['dribble_accuracy'] = $aValoresFinales['dribble_accuracy']			* 0;
					$aValoresFinales['dribble_speed'] = $aValoresFinales['dribble_speed'] 				* 0;
					$aValoresFinales['short_pass_accuracy'] = $aValoresFinales['short_pass_accuracy'] 	* 0.01;
					$aValoresFinales['short_pass_speed'] = $aValoresFinales['short_pass_speed'] 		* 0.01;
					$aValoresFinales['long_pass_accuracy'] = $aValoresFinales['long_pass_accuracy'] 	* 0.01;
					$aValoresFinales['long_pass_speed'] = $aValoresFinales['long_pass_speed'] 			* 0.01;
					$aValoresFinales['shot_accuracy'] = $aValoresFinales['shot_accuracy'] 				* 0.03;
					$aValoresFinales['shot_power'] = $aValoresFinales['shot_power'] 					* 0.03;
					$aValoresFinales['shot_technique'] = $aValoresFinales['shot_technique'] 			* 0.03;
					$aValoresFinales['free_kick_accuracy'] = $aValoresFinales['free_kick_accuracy'] 	* 0.01;
					$aValoresFinales['curling'] = $aValoresFinales['curling'] 							* 0.01;
					$aValoresFinales['header'] = $aValoresFinales['header'] 							* 0.01;
					$aValoresFinales['jump'] = $aValoresFinales['jump'] 								* 0.01;
					$aValoresFinales['technique'] = $aValoresFinales['technique'] 						* 0.01;
					$aValoresFinales['mentality'] = $aValoresFinales['mentality'] 						* 0.01;
					$aValoresFinales['keeper_skills'] = $aValoresFinales['keeper_skills'] 				* 0.2;
					$aValoresFinales['teamwork'] = $aValoresFinales['teamwork'] 						* 0.01;
					

					$iPrecio = array_sum($aValoresFinales) * 8000000;
			}

			if (array_intersect($aDefensa, $aPosiciones)) {
					$aValoresFinales = array();

					foreach ($oAbilities as $key => $iValue) {
						if ($iValue >= 98) {
							$aValoresFinales[$key] = 20;
						}

						if ($iValue >= 93 and $iValue <= 97) {
							$aValoresFinales[$key] = 15;
						}

						if ($iValue >= 90 and $iValue <= 92) {
							$aValoresFinales[$key] = 13;
						}				

						if ($iValue >= 86 and $iValue <= 89) {
							$aValoresFinales[$key] = 5;
						}

						if ($iValue >= 80 and $iValue <= 85) {
							$aValoresFinales[$key] = 1;
						}

						if ($iValue >= 74 and $iValue <= 79) {
							$aValoresFinales[$key] = 0.02;
						}

						if ($iValue < 74 ) {
							$aValoresFinales[$key] = .001;
						}
					}

					$aValoresFinales['attack'] = $aValoresFinales['attack'] 							* 0.01;
					$aValoresFinales['defence'] = $aValoresFinales['defence'] 							* 0.2;
					$aValoresFinales['balance'] = $aValoresFinales['balance'] 							* 0.2;
					$aValoresFinales['stamina'] = $aValoresFinales['stamina'] 							* 0.01;
					$aValoresFinales['top_speed'] = $aValoresFinales['top_speed'] 						* 0.09;
					$aValoresFinales['acceleration'] = $aValoresFinales['acceleration'] 				* 0.09;
					$aValoresFinales['response'] = $aValoresFinales['response'] 						* 0.05;
					$aValoresFinales['agility'] = $aValoresFinales['agility'] 							* 0.05;
					$aValoresFinales['dribble_accuracy'] = $aValoresFinales['dribble_accuracy']			* 0;
					$aValoresFinales['dribble_speed'] = $aValoresFinales['dribble_speed'] 				* 0;
					$aValoresFinales['short_pass_accuracy'] = $aValoresFinales['short_pass_accuracy'] 	* 0.07;
					$aValoresFinales['short_pass_speed'] = $aValoresFinales['short_pass_speed'] 		* 0.07;
					$aValoresFinales['long_pass_accuracy'] = $aValoresFinales['long_pass_accuracy'] 	* 0.07;
					$aValoresFinales['long_pass_speed'] = $aValoresFinales['long_pass_speed'] 			* 0.07;
					$aValoresFinales['shot_accuracy'] = $aValoresFinales['shot_accuracy'] 				* 0.05;
					$aValoresFinales['shot_power'] = $aValoresFinales['shot_power'] 					* 0.05;
					$aValoresFinales['shot_technique'] = $aValoresFinales['shot_technique'] 			* 0.05;
					$aValoresFinales['free_kick_accuracy'] = $aValoresFinales['free_kick_accuracy'] 	* 0.05;
					$aValoresFinales['curling'] = $aValoresFinales['curling'] 							* 0.15;
					$aValoresFinales['header'] = $aValoresFinales['header'] 							* 0.15;
					$aValoresFinales['jump'] = $aValoresFinales['jump'] 								* 0.15;
					$aValoresFinales['technique'] = $aValoresFinales['technique'] 						* 0.05;
					$aValoresFinales['mentality'] = $aValoresFinales['mentality'] 						* 0.01;
					$aValoresFinales['keeper_skills'] = $aValoresFinales['keeper_skills'] 				* 0;
					$aValoresFinales['teamwork'] = $aValoresFinales['teamwork'] 						* 0.01;
					

					$iPrecio = array_sum($aValoresFinales) * 8000000;
			}

			$oPlayer->valor_maximo = $iPrecio + ($iPrecio * 0.5); 
			$oPlayer->valor_minimo = $iPrecio - ($iPrecio * 0.5); 
			

			$fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
			$oPlayer->valor = $fmt->formatCurrency($iPrecio, "USD");
			$oPlayer->valor_maximo = $fmt->formatCurrency($oPlayer->valor_maximo, "USD");
			$oPlayer->valor_minimo = $fmt->formatCurrency($oPlayer->valor_minimo, "USD");
			
			$aSpecialAbilities = preg_split('/\n|\r\n?/', rtrim(ltrim($oPlayer->special_abilities)));
			$aData = array();
			$aData['oPlayer'] = $oPlayer;
			$aData['oAbilities'] = $oAbilities;
			$aData['aSpecialAbilities'] = $aSpecialAbilities;
			
			return $aData;
		}

		public function update($id, $sDate)
		{
			try {
	        	$oResponse = new stdClass();
				$oResponse->status = FALSE;
				$oResponse->psd = FALSE;
				$oResponse->message = NULL;
				$oResponse->id = NULL;

				$date = date('Y-m-d H:i', strtotime($sDate));

				$sql = "SELECT id, update_date FROM jugadores WHERE id = $id;";
				$query = $this->db->query($sql);
				$oJugador = $query->row();
				if (!$oJugador) {
					$this->db->query("INSERT INTO jugadores(id) VALUES(?);", array($id));
				}

				$query = $this->db->query($sql);
				$oJugador = $query->row();

				if (!is_null($oJugador->update_date) and $date <= $oJugador->update_date) {
					$oResponse->message = "El jugador ya se encuentra actualizado.";
					$oResponse->id = $id;
					$oResponse->date_psd = $date;
					$oResponse->date_bd = $oJugador->update_date;
					return $oResponse;
				}

				$url = "https://pes-editor.herokuapp.com/index.php?v=6&p={$id}";
				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, $url);
				curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_BINARYTRANSFER, true);
				$stast = curl_exec($curl);

       
		        curl_close($curl);

		        if (is_null($stast) or empty($stast)) {
					$oResponse->message = "El servicio PSD fallo.";
					$oResponse->id = $id;
					return $oResponse;
		        }
		        
				$oJugador = new stdClass();
				$sClaveEspecial = "";
		        $aStast = preg_split('/\n|\r\n?/', rtrim(ltrim($stast)));

				$sClave = "";						

				foreach ($aStast as $key => $sStast) {

					 $aHabilidad = explode(":", $sStast);
					 if (count($aHabilidad) == 2) {
						 
						//Formatear Clave
						$sClave = str_replace(" ", "_", ltrim(rtrim(strtolower($aHabilidad[0])))); 
						// Condiciones especiales
						if ($sClave == 'condition/fitness') {
						 	$sClave = 'condition_fitness';
						}				 

						if ($sClave == 'attack_/_defence_awareness') {
						 	$sClave = 'attack_defence_awareness';
						}

						$sValor = ltrim(rtrim($aHabilidad[1])); 

						if (empty($sClaveEspecial)) {
							$oJugador->$sClave = $sValor;
						}

						if ($sClave == "special_abilities") {
						 	$sClaveEspecial = "special_abilities";
						 	$oJugador->$sClaveEspecial = array();
						}

						if ($sClave == "motion_style") {
						 	$sClaveEspecial = "motion_style";
						}
					 }

					if (count($aHabilidad) == 1 and $sClave == "special_abilities") {
					 	$sValor = ltrim(rtrim($aHabilidad[0]));
					 	if (strlen($sValor) > 0) {
					 		$oJugador->$sClaveEspecial[] = $sValor;
					 	}
					}

				}

				unset($oJugador->motion_style);
				$oJugador->special_abilities = implode("\n", $oJugador->special_abilities);
				$oJugador->update_date = $date;
				$this->db->where('id', $id);
				$this->db->update('jugadores', $oJugador);

				// Respuesta Exitosa
				$oResponse->status = TRUE;
				$oResponse->psd = TRUE;
				$oResponse->message = "Jugador actualizado";
				$oResponse->id = $id;
				return $oResponse;

			} catch (Exception $e) {
				$oResponse = new stdClass();
				$oResponse->message = "No se actualizo el jugador.";
				return $oResponse;
			}
		}

		public function check($iId, $sDate)
		{
			$bActualizar = FALSE;

			$sDate = date('Y-m-d H:i', strtotime($sDate));
			$sql = "SELECT * FROM jugadores WHERE id = $iId and update_date < '$sDate';";
			$query = $this->db->query($sql);
			$oJugador = $query->result();

			if ($oJugador) {
				$bActualizar = TRUE;
			}

			return $bActualizar;
		}

		public function update_id($id)
		{
			try {
	        	$oResponse = new stdClass();
				$oResponse->status = FALSE;
				$oResponse->message = NULL;
				$oResponse->id = NULL;

				$url = "https://pes-editor.herokuapp.com/index.php?v=6&p={$id}";
				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, $url);
				curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_BINARYTRANSFER, true);
				$stast = curl_exec($curl);

       
		        curl_close($curl);

		        if (is_null($stast) or empty($stast)) {
					$oResponse->message = "El servicio PSD fallo.";
					$oResponse->id = $id;
					return $oResponse;
		        }
		        
				$oJugador = new stdClass();
				$sClaveEspecial = "";
		        $aStast = preg_split('/\n|\r\n?/', rtrim(ltrim($stast)));

				$sClave = "";						

				foreach ($aStast as $key => $sStast) {

					 $aHabilidad = explode(":", $sStast);
					 if (count($aHabilidad) == 2) {
						 
						//Formatear Clave
						$sClave = str_replace(" ", "_", ltrim(rtrim(strtolower($aHabilidad[0])))); 
						// Condiciones especiales
						if ($sClave == 'condition/fitness') {
						 	$sClave = 'condition_fitness';
						}				 

						if ($sClave == 'attack_/_defence_awareness') {
						 	$sClave = 'attack_defence_awareness';
						}

						$sValor = ltrim(rtrim($aHabilidad[1])); 

						if (empty($sClaveEspecial)) {
							$oJugador->$sClave = $sValor;
						}

						if ($sClave == "special_abilities") {
						 	$sClaveEspecial = "special_abilities";
						 	$oJugador->$sClaveEspecial = array();
						}

						if ($sClave == "motion_style") {
						 	$sClaveEspecial = "motion_style";
						}
					 }

					if (count($aHabilidad) == 1 and $sClave == "special_abilities") {
					 	$sValor = ltrim(rtrim($aHabilidad[0]));
					 	if (strlen($sValor) > 0) {
					 		$oJugador->$sClaveEspecial[] = $sValor;
					 	}
					}

				}

				unset($oJugador->motion_style);
				$oJugador->special_abilities = implode("\n", $oJugador->special_abilities);
				$this->db->where('id', $id);
				$this->db->update('jugadores', $oJugador);

				// Respuesta Exitosa
				$oResponse->status = TRUE;
				$oResponse->message = "Jugador actualizado";
				$oResponse->id = $id;
				return $oResponse;

			} catch (Exception $e) {
				$oResponse = new stdClass();
				$oResponse->message = "No se actualizo el jugador.";
				return $oResponse;
			}
		}
	}
 ?>