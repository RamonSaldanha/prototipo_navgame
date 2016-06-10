<?php
	class construcoes
	{
		public function checarRecursos($aid,$edificio)
		{
			global $aldeia;

			foreach($aldeia->calcularProdEstoque($aid) as $seu_estoque):
				$checar_prop_ed = $this->checarPropEdificio($edificio);
				if($checar_prop_ed["custo_{$seu_estoque["recurso_nome"]}"] <= $seu_estoque['estoque']):

				else:
					return "sem_recursos";
				endif;
			endforeach;
		}

		public function longPollingTempoConstrucao(){
			global $pdo_mysql;
			$resultado_final = "";
			foreach($pdo_mysql->select_pdo("ed_construcao","`aid` = {$_SESSION['aid']}") as $edificios_construcao):
				$edificio_prop = $this->checarPropEdificio("{$edificios_construcao->edificio_tipo}");
				$tempo_restante = ($edificio_prop["tempo_construcao"]) - time();
				$resultado_final.= "<br /> <b>edificio em construção:</b> ". $edificio_prop["edificio_nome"]. " ficará pronto às " . $this->checarTempoRestante($edificios_construcao->tempo_construcao-time()) . "<br />";
			endforeach;
			return $resultado_final;
		}

		public function verificarQuantConstrucoes() {
			global $pdo_mysql;
			global $construcoes;
			$consulta_mysql = $pdo_mysql->select_pdo("edificios","`aid` = {$_SESSION['aid']}");
		    $quant_ed = array();
			foreach($consulta_mysql as $edificios):
				foreach ($edificios as $ed_tabela => $ed_id):
				  if($ed_tabela != "aid" && $ed_tabela != "id"):
				    // echo $ed_tabela . " " . $ed_id . "<br />";
				    if($ed_id != ""):
				      $limite_habitantes = $construcoes->checarPropEdificio($ed_id)['limite_habitantes'];
				    else:
				      $limite_habitantes = 0;
				    endif;
				      $quant_ed[] = array (  
				          'tabela' => $ed_tabela,  
				          'edificio' => $ed_id,
				          'limite_habitantes' => $limite_habitantes
				      );
				  endif;
				endforeach;
			endforeach;
			$i = 0;
			foreach ($quant_ed as $edificios_prop):
				// aqui imprime todas as propriedades das construções
				// echo $edificios_prop["tabela"] . " => " . $edificios_prop["edificio"] . " / " . $edificios_prop["limite_habitantes"] . "<br />"; 
				$i += $edificios_prop["limite_habitantes"];
			endforeach;

			return $i;
			// para verificar echo $construcoes->verificarQuantConstrucoes();
		}

		public function distribuirPopulacao (){
			$div = floor($numero / $caixas);
		    $sobra = $numero - ($caixas * $div);

		    for ($i = 1; $i <= $caixas; $i++) {
		        $caixa[$i] = $div;
		        if($sobra > 0){
		            $caixa[$i]++;
		        }
		        $sobra--;
		    }

		    return $caixa;	
		}
		public function checarSeExisteEd($aldeia,$edificio,$terreno=null)
		{
			global $pdo_mysql;
			// o foreach exibe todas as colunas, por exemplo t1,t2,t3,t4,t5 e dai ele verifica se existe a construção
			// em alguma das colunas, ele verifica todas as colunas excheto a "aid" e "id", isso é se existir alguma coisa,
			// alguma coluna, ele retorna um erro!
			foreach($pdo_mysql->selectColuna("edificios") as $colunas):
					if($colunas != "aid" && $colunas != "id"):
						$coluna_valor = $pdo_mysql->select_pdo_where("edificios", "{$colunas} = '{$edificio}' AND aid = '{$aldeia}'");
						if($coluna_valor != ""):
							 return "existe";
						endif;
					endif;
			endforeach;
			// já fora do foreach, ele pesquisa se existe alguma construção em andamento com esse edificio, assim ele não verifica
			// tantas vezes, e economiza banda, pois se outro select estiver dentro do foreach, vai consumir mais o desempenho;
			$checar_construindo = $pdo_mysql->select_pdo_where("ed_construcao", "edificio_tipo = '{$edificio}' AND aid = '{$aldeia}'");
			if($checar_construindo != ""):
				return "existe_construindo";
			endif;
			if(isset($terreno)):
				// essa consulta sql a  seguir, ele vai verificar se já existe algum edificio construindo no terreno caso exista, retornará um erro
				$checar_terreno_c = $pdo_mysql->select_pdo_where("ed_construcao", "terreno = '{$terreno}' AND aid = '{$aldeia}'");
				if($checar_terreno_c != ""):
					return "existe_terreno_construindo";
				endif;

				$checar_terreno = $pdo_mysql->select_pdo_where("edificios", "{$terreno} = '' AND aid = '{$aldeia}'");
				if($checar_terreno == ""):
					return "existe_terreno";
				endif;
			endif;

		}

		public function checarPropEdificio($edificio)
		{
			// essa função é muito importante, pois exibe as propriedades de um determinado edifício, que você escolher
			// e transforma as propriedades em uma array que é a $edificio_prop;
			global $edificios_data;
			$edificio_prop = $edificios_data[$edificio];
			return $edificio_prop;
		}

		public function construir ($terreno,$edificio,$aid)
		{
			// o get vai passar o id do terreno, e aqui vai concatenar o t, pra transformar no nome da tabela. exemplo: t1,t2..
			$terreno = "t" . $terreno;

			global $pdo_mysql;
			// recuperar as propriedades, as caracteristicas da construção é feito através da seguinte função: checarPropEdificios
			// desta forma, você pode saber o tempo que demora para construir, e os atributos da construção
			$edificio_prop = $this->checarPropEdificio($edificio);
			$tempo_construcao = time() + $edificio_prop["tempo_construcao"];
			global $construcoes;
			// essa condição verificará se existe a construção em algum terreno, ou se o terreno já está sendo usado...
			if($this->checarRecursos($_SESSION['aid'],$edificio["id"]) != "sem_recursos"):
				if($construcoes->checarSeExisteEd($_SESSION['aid'],$_GET['e'],$terreno) == ""):
					$pdo_mysql->update_pdo('aldeia',"`madeira` = madeira - '{$edificio_prop['custo_madeira']}' , `pedra` = pedra - '{$edificio_prop['custo_pedra']}'","`id` = {$aid}");
					$pdo_mysql->insert_pdo("`ed_construcao`","(`id`, `aid`, `terreno`, `edificio_tipo`, `tempo_construcao`) VALUES (NULL, '{$_SESSION['aid']}', '{$terreno}', '{$edificio}', '{$tempo_construcao}');");
				endif;
			endif;
			header("Location: aldeia.php");
		}

		public function checarTempoRestante($time)
		{
			// 	esta função foi importade de outro projeto no github Travianz, pra substituir a hora
			// 	assim, mostrará quanto tempo falta pra construir ou fazer determinada ação.
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
