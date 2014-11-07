<?php
	class colheita
	{

		public function checarPropColheita($colheita)
		{
			// essa função é muito importante, pois exibe as propriedades de um determinada colheita, que você escolher
			// e transforma as propriedades em uma array que é a $colheita_prop;
			global $colheita_data;
			$colheita_prop = $colheita_data[$colheita];
			return $colheita_prop;
		}

		public function tempoColheitaAtt($aid,$recurso)
		{
			global $pdo_mysql,$colheita_data;

			foreach($colheita_data as $plantar):
				if($plantar['colheita_nome'] == "{$recurso}"):
					$tempo = $plantar['tempo_prod'];
					$tipo = $plantar['id'];
				endif;
			endforeach;
			$ult_att = time() + $tempo;
			$pdo_mysql->update_pdo("aldeia","temp_colheita = $ult_att, tipo_colheita = $tipo ","`id` = {$aid}");
			header("Location: aldeia.php");
		}

		public function colheitaRecolher($aid)
		{
			global $pdo_mysql,$colheita_data;
			$aldeia_checar = $pdo_mysql->select_pdo_where("aldeia","`id` = {$_SESSION['aid']}");

			$colheita_prop = $this->checarPropColheita($aldeia_checar['tipo_colheita']);

			$pdo_mysql->update_pdo("aldeia","comida = comida + {$colheita_prop["atributo"]}, tipo_colheita = \"\", temp_colheita = 0","`id` = {$aid}");

			header("Location: edificio.php?ed=3");
		}

	}

?>
