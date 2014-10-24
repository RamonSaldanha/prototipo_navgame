<?php
	class construcoes
	{

		public function checarSeExisteEd($aldeia,$edificio)
		{
			global $pdo_mysql;
			foreach($pdo_mysql->selectColuna("edificios") as $colunas):
					if($colunas != "aid" && $colunas != "id"):
						$coluna_valor = $pdo_mysql->select_pdo_where("edificios", "{$colunas} = '{$edificio}' AND aid = '{$aldeia}'");
						if($coluna_valor != ""):
							 return "existe";
						endif;
						$checar_construindo = $pdo_mysql->select_pdo_where("ed_construcao", "edificio_tipo = '{$edificio}' AND aid = '{$aldeia}'");
						if($checar_construindo != ""):
							return "existe_construindo";
						endif;
					endif;
			endforeach;
		}

		public function checarPropEdificio($edificio)
		{
			global $edificios_data;
			$edificio_prop = $edificios_data[$edificio];
			return $edificio_prop;
		}

		public function construir ($terreno,$edificio,$aid)
		{
			$terreno = "t" . $terreno;
			global $pdo_mysql;
			$edificio_prop = $this->checarPropEdificio($edificio);
			$tempo_construcao = time() + $edificio_prop["tempo_construcao"];
			global $construcoes;
			if($construcoes->checarSeExisteEd($_SESSION['aid'],$_GET['e']) != "existe" && $construcoes->checarSeExisteEd($_SESSION['aid'],$_GET['e']) != "existe_construindo"):
				$pdo_mysql->update_pdo('aldeia',"`armazem` = armazem - {$edificio_prop['custo_madeira']}","`id` = {$aid}");
				$pdo_mysql->insert_pdo("`ed_construcao`","(`id`, `aid`, `terreno`, `edificio_tipo`, `tempo_construcao`) VALUES (NULL, '{$_SESSION['aid']}', '{$terreno}', '{$edificio}', '{$tempo_construcao}');");
			endif;
			// header("Location: aldeia.php");
		}

		public function checarTempoRestante($time)
		{
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
