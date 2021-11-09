<?php 
require_once('../includes/connexion.php');
?>


<?php
$id = isset($_POST["id"])? $_POST["id"] : "";

$sql="DELETE from etudiant WHERE id='$id'";
$result = $mysqli->query($sql);

echo  "Etudiant supprimé";

$mysqli->close();

?>