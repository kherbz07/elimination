<?php
class Connector
{
	private $host = 'localhost';
	private $user = 'root';
	private $pass = '';
	private $database = 'db_elimination';

	public function getConnection()
	{
		$dbh = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->user, $this->pass);
		return $dbh;
	}

	public function close($dbh)
	{
		$dbh = null;
	}
}