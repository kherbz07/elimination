<?php
require_once('Connector.class.php');

new UserModel();

class UserModel	
{
	private $dbh;
	private $stmt;

	public function __construct()
	{
		$connector = new Connector();
		$this->dbh = $connector->getConnection();

		$this->index();
	}

	public function addUser($username)
	{
		$stmt = $this->dbh->prepare('INSERT INTO tbl_user (username) VALUES (?)');
		$stmt->bindValue(1, $username, PDO::PARAM_STR);
		$stmt->execute();

		return $this->dbh->lastInsertId();
	}

	public function index()
	{
		$users_file = fopen("usernames.txt", "r") or die('Unable to open file.');
		while (!feof($users_file))
		{
			$username = fgets($users_file);
			if ($username != '')
			{
				$this->addUser($username);
			}
		}
		fclose($users_file);
	}
}