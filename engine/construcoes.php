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
			$pdo_mysql->insert_pdo("`ed_construcao`","(`id`, `aid`, `terreno`, `edificio_tipo`, `tempo_construcao`) VALUES (NULL, '{$_SESSION['aid']}', '{$terreno}', '{$edificio}', '{$tempo_construcao}');");
			header("Location: aldeia.php");
		}
	}

?>
