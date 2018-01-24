<?php

require_once('dbconfig.php');

class PROVIDER
{

	private $conn;

	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}

	public function register($vname,$vcnpj,$vfdate,$vldate)
	{
		try
		{
			$stmt = $this->conn->prepare("INSERT INTO providers(provider_name,provider_cnpj,provider_firstdate,provider_lastdate)
		                                               VALUES(:vname, :vcnpj, :vfdate, :vldate)");

			$stmt->bindparam(":vname", $vname);
			$stmt->bindparam(":vcnpj", $vcnpj);
			$stmt->bindparam(":vfdate", $vfdate);
			$stmt->bindparam(":vldate", $vldate);

			$stmt->execute();

			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}
?>
