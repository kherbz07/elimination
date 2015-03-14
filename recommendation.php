<?php
new Recommend();

class Recommend
{
	private $base;
	private $recommendation;

	public function __construct()
	{
		$this->recommendation = '';

		if (isset($_GET['username']))
		{
			$this->base = $this->getBase($_GET['username']);
			$this->recommendation = $this->recommendUsername($_GET['username']);
		}
		if (isset($_GET['action']))
		{
			$this->getRecommendation();
		}
		$this->index();
	}

	public function index()
	{
		include 'display.php';
	}

	public function recommendUsername($username)
	{
		$flag = true;
		$ctr = 0;

		while ($flag)
		{
			$isFound = false;

			$users_file = fopen("usernames.txt", "r") or die('Unable to open file.');
			while (!feof($users_file) && !$isFound)
			{
				$old_user = fgets($users_file);
				$old_user = substr($old_user, 0, -2);
				if ($username == $old_user)
				{
					$username = $this->base;
					$username .= $ctr;
					$ctr++;
					$isFound = true;
				}
			}
			$old_user = fgets($users_file);
			fclose($users_file);

			if (!$isFound)
			{
				$flag = false;
			}
		}

		return $username;
	}

	public function getBase($username)
	{
		$flag = true;
		$count = strlen($username);
		for ($i = 0; $i < $count && $flag; $i++)
		{
			if (ctype_digit($username[$i]))
			{
				$flag = false;
				$username = substr($username, 0, ($i));
			}
		}
		return $username;
	}

	public function getRecommendation()
	{

	}
}