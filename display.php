<!DOCTYPE html>
<html>
	<head>
		<title>Recommendation in picking a username.</title>
	</head>
	<body>
		<form action="recommendation.php" method="GET">
			<input type="text" id="username" name="username" value="<?php if (isset($_GET['username'])) echo $_GET['username']; ?>" />
			<button type="submit">Pick Username</button>
		</form>
		<?php if (isset($_GET['username'])) : ?>
			<?php if ($this->recommendation != $_GET['username']) { ?>
				<label>Username is already taken.</label><br/>
				<label id="rec-user">Recommended Username: <?= $this->recommendation ?></label>
			<?php } else { ?>
				<label>Username is available.</label>
			<?php } ?>
		<?php endif ?>
	</body>
</html>