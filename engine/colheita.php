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
		
		public function percaDeColheita($aid,$colheita_tipo)
		{
			global $pdo_mysql,$colheita_data;
			$aldeia_checar = $pdo_mysql->select_pdo_where("aldeia","`id` = {$aid}");

			$deficit_percentual = ($colheita_data[$colheita_tipo]['atributo'] / 100) * DEFICIT_PORCENTAGEM_COLHEITA;
			$deficit_total = ($deficit_percentual / ($colheita_data[$colheita_tipo]['tempo_prod'] * 2)) * ($aldeia_checar["temp_colheita"] - time());

			if(-$deficit_total > $deficit_percentual):
				$deficit_total = -$deficit_percentual;
			endif;

			$tempo_perdido = $aldeia_checar["temp_colheita"] - time();

			$porcentagem_perdida = (($deficit_total / $deficit_percentual) * DEFICIT_PORCENTAGEM_COLHEITA);

			$deficit_colheita = array(
				"tempo_perdido" => "{$tempo_perdido}",
				"colheita_perdida" => "{$deficit_total}",
				"porcentagem_perdida" => "{$porcentagem_perdida} %",
			);

			return $deficit_colheita;
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
			
			header("Location: edificio.php?ed=3");
		}

		public function colheitaRecolher($aid,$colheita_perdida)
		{
			global $pdo_mysql,$colheita_data;
			$aldeia_checar = $pdo_mysql->select_pdo_where("aldeia","`id` = {$aid}");
			$tempo = $aldeia_checar["temp_colheita"] - time();

			if($aldeia_checar["tipo_colheita"] != "" && $tempo < 0):
				$colheita_prop = $this->checarPropColheita($aldeia_checar['tipo_colheita']);
				// a colheita perdida vai vim em um valor negativo, por isso que operador é um "+", colheita(atributo) + -colheitaperdida
				$colheita = $colheita_prop["atributo"] + $colheita_perdida; 
				$pdo_mysql->update_pdo("aldeia","comida = comida + {$colheita}, tipo_colheita = \"\", temp_colheita = 0","`id` = {$aid}");
			endif;
			
			header("Location: edificio.php?ed=3");
		}

	}

?>
