<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="NBA Player Search">
    <meta name="author" content="Harpreet Singh">
	<title>NBA Player Search</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
	<h1 id="title">NBA Player Search</h1>
	<img src="http://www.godermag.com/wp-content/uploads/2014/07/NBA.jpg" alt="NBA logo" id="img1">
	<form name="search" method="POST" action="index.php" class="form-horizontal" id="search-form" role="form">
       	<input type="text" name="playerName" class="form-control" placeholder="Search for a player">
       	<input type="submit" name="search" value="Search" />
    </form>

	<?php 

	require('nba.php');

	if($_SERVER['REQUEST_METHOD'] == "POST") { 
		echo "<h1>Results:</h1><br/>";
		$playerChoice = $_REQUEST['playerName'];
		$playerName = strtoupper($playerChoice);
		$playerName = strip_tags($playerName);
		$playerName = trim($playerName);

		if ($playerName == "") {
			echo "<h2>You forgot to enter a name!</h2>";
		} else {
			try {
				$conn = new PDO('mysql:host=rds-instance1.cj452vffhhvw.us-west-2.rds.amazonaws.com;dbname=nbaSearch', $username='info344user', $password='swaggyp24');
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$stmt = $conn->prepare("SELECT * FROM nba WHERE PlayerName LIKE '%$playerName%'");

				$stmt->execute();
				$result = $stmt->fetchAll();

				if ( count($result) ) { 
					foreach($result as $row) {

						$player = new Player($row['PlayerName'], $row['GP'], $row['FGP'], $row['TPP'], $row['FTP'], $row['PPG']);

						echo "<section class=\"box\">
							<div class=\"name\">
								{$player->getName()}
							</div>
							<div id=\"tableBox\">
								<table align=\"center\" class=\"info table\">
									<thead>
										<tr>
											<th>PPG</td>
											<th>GP</td>
											<th>FGP</td>
											<th>TPP</td>
											<th>FTP</td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>{$player->getPPG()}</td>
											<td>{$player->getGP()}</td>
											<td>{$player->getFGP()}</td>
											<td>{$player->getTPP()}</td>
											<td>{$player->getFTP()}</td>
										</tr>
									</tbody>	
								</table>
							</div>
						</section>";
					}
				} else {
					echo "<h2>No players found. <br /><br /></h2>";
					echo "<h2>Searched for: ".$playerChoice."</h2>";
				}
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}
		}
	}
	?>
</body>
</html>