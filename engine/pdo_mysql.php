<?php

	class pdo_mysql
	{
		public $db;

		public function __construct ()
		{
			$this->db = new PDO("mysql:host=127.0.0.1;dbname=jogo",'root','');
		}

		public function select_pdo_where ($tabela,$where)
		{
			$select = $this->db->query("SELECT * FROM `$tabela` WHERE $where");
			return $select->fetch(PDO::FETCH_ASSOC);
		}

		public function select_pdo ($tabela,$where=null)
		{
			if(empty($where)){
				$sql = "SELECT * FROM `$tabela`";
				$pdo = $this->db->prepare($sql);
				$pdo->execute();
				$dados = $pdo->fetchAll(PDO::FETCH_OBJ);
				return $dados;
			} else {
				$select = $this->db->query("SELECT * FROM `$tabela` WHERE $where");
				return $select->fetchAll(PDO::FETCH_OBJ);
			}
		}

		public function update_pdo($tabela,$set,$where=null)
		{
			if(!empty($where))
			{
				$sql = "UPDATE `$tabela` SET $set WHERE $where";
				$pdo = $this->db->prepare($sql);
				$pdo->execute();
			} else {
				$sql = "UPDATE `$tabela` SET $set";
				$pdo = $this->db->prepare($sql);
				$pdo->execute();
			}
		}

		public function insert_pdo($tabela,$insert)
		{
			$sql = "INSERT INTO $tabela $insert";
			$pdo = $this->db->prepare($sql);
			$pdo->execute();
		}

		public function delete_pdo($tabela,$where)
		{
				$sql = "DELETE FROM `$tabela` WHERE $where";
				$pdo = $this->db->prepare($sql);
				$pdo->execute();
		}

		public function selectColuna($tabela)
		{
			$select = $this->db->query("DESCRIBE `$tabela`");
			return $select->fetchAll(PDO::FETCH_COLUMN);
		}
	}

?>
