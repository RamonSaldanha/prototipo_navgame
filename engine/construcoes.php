<?php
	class construcoes
	{

		public function checarPropEdificio($edificio)
		{
			global $$edificio;
			$edificio_prop = $$edificio;
			return $edificio_prop;
		}

		public function construir ($terreno,$edificio)
		{
			$terreno = "t" . $terreno;
			global $pdo_mysql;
			$edificio_prop = $this->checarPropEdificio("{$edificio}");
			$tempo_construcao = time() + $edificio_prop["tempo_construcao"];
			$pdo_mysql->update_pdo('aldeia',"`armazem` = armazem - {$edificio_prop['custo_madeira']}","`id` = {$_SESSION['aid']}");
			$pdo_mysql->insert_pdo("`ed_construcao`","(`id`, `aid`, `terreno`, `edificio_tipo`, `tempo_construcao`) VALUES (NULL, '{$_SESSION['aid']}', '{$terreno}', '{$edificio}', '{$tempo_construcao}');");
			header("Location: aldeia.php");
		}

		public function checarTempoRestante($time) {
			$min = 0;
			$hr = 0;
			$days = 0;
			while($time >= 60) :
				$time -= 60;
				$min += 1;
			endwhile;
			while ($min >= 60) :
				$min -= 60;
				$hr += 1;
			endwhile;
			if ($min < 10) {
				$min = "0".$min;
			}
			if($time < 10) {
				$time = "0".$time;
			}
		return $hr.":".$min.":".$time;
		}
	}

?>
