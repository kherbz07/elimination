<?php

$argc = $_SERVER['argc'];
$argv = $_SERVER['argv'];

$input = '';
$base = '';
$recommendation = '';

if ($argc >= 2)
{
	$input = $argv[1];
	$base = getBase($input);
	$recommendation = recommendUsername($input, $base);

	print('Input: ' . $input . "\n");
	print('Recommendation: ' . $recommendation);
}
else
{
	print('No input.');
}

function recommendUsername($username, $base)
{
	$flag = true;
	$ctr = 1;
	$usernames = array();

	$users_file = fopen("usernames.txt", "r") or die('Unable to open file.');
	while (!feof($users_file))
	{
		$old_user = fgets($users_file);
		$old_user = preg_replace("/[^A-Za-z0-9]/", '', $old_user);
		$usernames[] = $old_user;
	}
	fclose($users_file);

	while($flag)
	{
		$isFound = false;

		for ($i = 0; $i < count($usernames); $i++)
		{
			if ($username == $usernames[$i])
			{
				$username = $base;
				$username .= $ctr;
				$ctr++;
				$isFound = true;
				break;
			}
		}

		if (!$isFound)
		{
			$flag = false;
		}
	}

	/*while ($flag)
	{
		$isFound = false;

		$users_file = fopen("usernames.txt", "r") or die('Unable to open file.');
		while (!feof($users_file) && !$isFound)
		{
			$old_user = fgets($users_file);
			$old_user = preg_replace("/[^A-Za-z0-9]/", '', $old_user);
			if ($username == $old_user)
			{
				$username = $base;
				$username .= $ctr;
				$ctr++;
				$isFound = true;
				break;
			}
		}
		fclose($users_file);

		if (!$isFound)
		{
			$flag = false;
		}
	}*/

	return $username;
}

function getBase($username)
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
?>