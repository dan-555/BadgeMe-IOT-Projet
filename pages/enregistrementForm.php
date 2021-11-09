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


$sql="INSERT INTO etudiant (lastname, firstname, id, genre, email, mobile) VALUES ('$nom','$prenom','$id','$genre','$email','$numero')";

$result = $mysqli->query($sql);

echo   "Etudiant enregistré";

				

$mysqli->close();

?>