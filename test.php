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
				$username = $base;
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