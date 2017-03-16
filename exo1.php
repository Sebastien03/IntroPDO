<?php

$pdo = new PDO("mysql:dbname=colyseum;host=localhost;charset=utf8", "root", "Zekras03");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

$statement = $pdo->query("SELECT * FROM clients");
$resultatExo1 = $statement->fetchAll();

$statement = $pdo->query("SELECT showTypes.type, genres.genre AS firstGenre, secGenres.genre AS secGenre
						FROM showTypes, genres, genres AS secGenres
						WHERE showTypes.id = genres.showTypesId AND showTypes.id = secGenres.showTypesId
						ORDER BY genres.id");
$resultatExo2 = $statement->fetchAll();

$statement = $pdo->query("SELECT * FROM clients LIMIT 20");
$resultatExo3 = $statement->fetchAll();

$statement = $pdo->query("SELECT * FROM clients WHERE card=1");
$resultatExo4 = $statement->fetchAll();

$statement = $pdo->query("SELECT lastName, firstName FROM clients WHERE lastName LIKE 'M%' ORDER BY lastName");
$resultatExo5 = $statement->fetchAll();

$statement = $pdo->query("SELECT title, performer, date, startTime FROM shows ORDER BY title");
$resultatExo6 = $statement->fetchAll();

$statement = $pdo->query("SELECT lastName, firstName, birthDate, card, cardNumber FROM clients");
$resultatExo7 = $statement->fetchAll();


$pdo= null;
################################################################################################################################################################################################ VIEW ####################################################################################################################################################################################################################################
?>

<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<link rel="stylesheet" type="text/css" href="style/css/styleExo1.css">
			<title> PDO </title>
		</head>
		<body>
			<h2> Exo 1 : </h2> </br>

			<!-- Afficher tout les clients -->

			<table>
				<thead>	
					<tr>
						<th> ID </th>
						<th> Nom </th>
						<th> Prenom </th>
						<th> Date de naissance </th>
						<th> Card </th>
						<th> Numéro de carte </th>
					</tr>
				</thead>
					<?php foreach ($resultatExo1 as $value) : ?> 
				<tbody>
					<tr>
						<td> <?php echo $value->id; ?> </td>
						<td> <?php echo $value->firstName; ?></td>
						<td> <?php echo $value->lastName; ?></td>
						<td> <?php echo $value->birthDate; ?></td>
						<td> <?php echo $value->card; ?></td>
						<td> <?php echo $value->cardNumber; ?> </td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

			<h2> Exo 2 : </h2> </br>

			<!-- Afficher tout les types de spectacle possible -->

			<table>
				<thead>
					<tr>
						<th> Types </th>
						<th> Genre </th>
						<th> Genre 2 </th>
					</tr>
				</thead>
					<?php foreach ($resultatExo2 as $value) : ?> 
				<tbody>
					<tr>
						<td> <?php echo $value->type;  ?> </td>
						<td> <?php echo $value->firstGenre; ?> </td>
						<td> <?php echo $value->secGenre; ?> </td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

			<h2> Exo 3 : </h2> </br>

			<!-- Afficher les 20 premiers clients -->

			<table>
				<thead>	
					<tr>
						<th> ID </th>
						<th> Nom </th>
						<th> Prenom </th>
						<th> Date de naissance </th>
						<th> Card </th>
						<th> Numéro de carte </th>
					</tr>
				</thead>
					<?php foreach ($resultatExo3 as $value) : ?> 
				<tbody>
					<tr>
						<td> <?php echo $value->id; ?> </td>
						<td> <?php echo $value->firstName; ?></td>
						<td> <?php echo $value->lastName; ?></td>
						<td> <?php echo $value->birthDate; ?></td>
						<td> <?php echo $value->card; ?></td>
						<td> <?php echo $value->cardNumber; ?> </td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

			<h2> Exo 4 : </h2> </br>

			<!-- Afficher que les clients possédant une carte de fidelité -->

			<table>
				<thead>	
					<tr>
						<th> ID </th>
						<th> Nom </th>
						<th> Prenom </th>
						<th> Date de naissance </th>
						<th> Card </th>
						<th> Numéro de carte </th>
					</tr>
				</thead>
					<?php foreach ($resultatExo4 as $value) : ?> 
				<tbody>
					<tr>
						<td> <?php echo $value->id; ?> </td>
						<td> <?php echo $value->firstName; ?></td>
						<td> <?php echo $value->lastName; ?></td>
						<td> <?php echo $value->birthDate; ?></td>
						<td> <?php echo $value->card; ?></td>
						<td> <?php echo $value->cardNumber; ?> </td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

			<h2> Exercice 5 : </h2> </br>

			<!-- Afficher uniquement les nom des clients commencant par la lettre "M" et trier les noms par ordre alphabetique -->

			
					<?php foreach ($resultatExo5 as $value) : ?> 
						<p> Nom : <?php echo $value->lastName; ?></br>  
						 Prenom : <?php echo $value->firstName; ?> </p>
					<?php endforeach; ?>

			<h2> Exercice 6 : </h2> </br>

			<!-- Afficher le titre de tous les spectable ainsi que l'artiste et l'heure, trier par ordre alphabetique et afficher sous forme spectacle"TITRE" par "ARTISTE" le "DATE" à "HEURE" -->


			<?php foreach ($resultatExo6 as $value) : ?>
				<p> Spectacle : <?php echo $value->title; ?> </br>
					Artiste : <?php echo $value->performer; ?> </br>
					Le : <?php echo $value->date; ?> </br>
					A : <?php echo $value->startTime; ?> </br>
					</p>
				<?php endforeach; ?>

			<h2> Exercice 7 : </h2> </br>

			<!-- Afficher les noms du clients, prénom, date de naissance, carte de fidélité(oui si il en possede une, non si non), numerot de la carte(si il en possede une) -->

			<?php foreach ($resultatExo7 as $value) : ?>
				<p> Nom : <?php echo $value->lastName; ?></br>
					Prenom : <?php echo $value->firstName; ?></br>
					Date de naissance : <?php echo $value->birthDate; ?></br>
					Carte de fidélité : <?php if ($value->card == 1) {
						echo "oui";
					}else{
						echo "non";
						}; ?></br>
					Numérot carte : <?php if ($value->card == 1) {
						echo  $value->cardNumber;
					}; ?> </p></br>
			<?php endforeach; ?>
		</body>
	</html