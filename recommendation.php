<?php
$orig_user = '';
$rec_user = '';

if (isset($_GET['username']))
{
	$username = $_GET['username'];
	$orig_user = $username;
	$flag = true;
	$isFound = false;
	$rec_ctr = 0;

	while ($flag)
	{
		$isFound = false;

		$users_file = fopen("usernames.txt", "r") or die('Unable to open file.');
		while (!feof($users_file))
		{
			$old_user = fgets($users_file);
			$old_user = substr($old_user, 0, -2);
			if ($username == $old_user)
			{
				if ($rec_ctr > 0)
				{
					$username = substr($username, 0, -1);
				}
				$username .= $rec_ctr;
				$rec_ctr++;
				$isFound = true;
			}
		}
		fclose($users_file);

		if (!$isFound)
		{
			$flag = false;
		}
	}

	$rec_user = $username;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Recommendation in picking a username.</title>
	</head>
	<body>
		<form action="recommendation.php" method="GET">
			<input type="text" id="username" name="username" value="<?php if ($rec_user != '') echo $orig_user; ?>" />
			<button type="submit">Pick Username</button>
		</form>
		<?php if ($rec_user != '') { ?>
			<label>Username is already taken.</label><br/>
			<label id="rec-user">Recommended Username: <?= $rec_user ?></label>
		<?php } else { ?>
			<label>Username is available.</label>
		<?php } ?>
	</body>
</html>