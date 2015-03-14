<?php
new Recommend();

class Recommend
{
	private $input;
	private $base;
	private $recommendation;

	public function __construct()
	{
		$this->recommendation = '';

		$argc = $_SERVER['argc'];
		$argv = $_SERVER['argv'];

		if ($argc >= 2)
		{
			$this->input = $argv[1];
			$this->base = $this->getBase($this->input);
			$this->recommendation = $this->recommendUsername($this->input);
		}
		$this->index();
	}

	public function index()
	{
		print('Input: ' . $this->input . "\n");
		print('Recommendation: ' . $this->recommendation);
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
				/*$users_file = fopen("usernames.txt", "a") or die('Unable to open file.');
				fwrite($users_file, " \n". $username);
				fclose($users_file);*/
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