<?php 
require_once('../includes/connexion.php');
?>


<?php
$id = isset($_POST["id"])? $_POST["id"] : "";
$nom = isset($_POST["nom"])? $_POST["nom"] : "";
$prenom = isset($_POST["prenom"])? $_POST["prenom"] : "";
$email = isset($_POST["email"])? $_POST["email"] : "";
$genre = isset($_POST["genre"])? $_POST["genre"] : "";
$numero = isset($_POST["numero"])? $_POST["numero"] : "";


$sql="UPDATE etudiant SET lastname='$nom', firstname ='$prenom', email ='$email', genre ='$genre', mobile ='$numero' WHERE id='$id'";
$result = $mysqli->query($sql);

echo   "Etudiant modifié";

				

$mysqli->close();

?>