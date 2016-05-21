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

		public function select_pdo_assoc_all ($tabela)
		{
			$select = $this->db->query("SELECT * FROM `$tabela`");
			return $select->fetchAll(PDO::FETCH_ASSOC);
		}
		
		public function select_pdo_assoc ($tabela)
		{
			$select = $this->db->query("SELECT * FROM `$tabela`");
			return $select->fetch(PDO::FETCH_ASSOC);
		}

		public function show_tables_name ()
		{
			$sql = "SHOW TABLES";
			$query = $this->db->query($sql);
        	return $query->fetchAll(PDO::FETCH_COLUMN);
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

		public function count ($tabela) {
			$sql = "SELECT COUNT(*) FROM `$tabela`";
			$pdo = $this->db->prepare($sql);
			$pdo->execute();
			$num_rows = $pdo->fetchColumn();
			return $num_rows;
		}
		
		public function delete_pdo($tabela,$where)
		{
				$sql = "DELETE FROM `$tabela` WHERE $where";
				$pdo = $this->db->prepare($sql);
				$pdo->execute();
		}

		public function sum ($tabela,$coluna)
		{
			$sql = "SELECT SUM(`$coluna`) AS `$coluna` FROM `$tabela`";
			$pdo = $this->db->prepare($sql);
			$pdo->execute();
			$soma = $pdo->fetchColumn();
			return $soma;
		}

		public function selectColuna($tabela)
		{
			$select = $this->db->query("DESCRIBE `$tabela`");
			return $select->fetchAll(PDO::FETCH_COLUMN);
		}
	}

?>
