<?php
require_once('includes/connexion.php');
?>

<?php

	@$UIDresult=$_POST["UIDresult"];

	$Write="<?php $" . "UIDresult='" . $UIDresult . "'; " . "echo $" . "UIDresult;" . " ?>";
	file_put_contents('UIDContainer.php',$Write);


	if(!empty($_POST['UIDresult']))
{

	$sql = "SELECT * FROM `etudiant` WHERE id='$UIDresult'";
	$result = $mysqli->query($sql);
	
	if ($result->num_rows > 0) {

	   while($row = $result->fetch_assoc()) { //Si l'etudiant est dans la bdd

		echo "Porte ouverte";
	   }
	
	}
	else { //Pas d'etudiant
		echo "Pas enregistré";
	}
	$mysqli->close();
}
?>