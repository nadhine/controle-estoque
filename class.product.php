<?php

require_once('dbconfig.php');

class PRODUCT
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

	public function register($pname,$pvalor,$punit,$pprovider)
	{
		try
		{
			$stmt = $this->conn->prepare("INSERT INTO products(product_name,product_valor,product_unit,product_provider)
		                                               VALUES(:pname, :pvalor, :punit, :pprovider)");

			$stmt->bindparam(":pname", $pname);
			$stmt->bindparam(":pvalor", $pvalor);
			$stmt->bindparam(":punit", $punit);
			$stmt->bindparam(":pprovider", $pprovider);

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
