<?php
require_once('../includes/connexion.php');
?>

<?php

$id = null;
if ( !empty($_GET['id'])) {
	$id = $_REQUEST['id'];
}
 
$sql = "SELECT * FROM etudiant where id = '$id'";
$result = $mysqli->query($sql);	

$msg = null;
$msg2 = "La porte est verrouillée";

if ( !empty($result->num_rows) && $result->num_rows > 0) { //trouve l'etudiant

	while($row = $result->fetch_assoc()) { //Donnees de l'etudiant

		$nom=$row['lastname'];
		$prenom=$row['firstname'];
		$email=$row['email'];
		$genre=$row['genre'];
		$mobile=$row['mobile'];
		$msg = null;
		$msg2 = "La porte est ouverte !";

	}
}

else { //etudiant pas enregistré
	
	$msg = "L'etudiant n'est pas enregistré !!!";
	$id="--------";
	$nom="--------";;
	$prenom="--------";
	$email="--------";
	$genre="--------";
	$mobile="--------";
}
$mysqli->close();				



 ?>
 
 
 <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
	<body>	
		<div>
		<form>
				<table style="border-collapse: collapse" width="452" border="1" bordercolor="black" align="center"  cellpadding="0" cellspacing="1"  bgcolor="#000" style="padding: 2px">
					<tr style="border-bottom: 1pt solid black">
						<td  height="40" align="center"  bgcolor="white"><font  color="black">
							<b>Etudiant</b>
							</font>
						</td>
					</tr>
					<tr>
						<td  bgcolor="#f9f9f9">
							<table width="452"  border="0" align="center" cellpadding="5"  cellspacing="0">
								
                                 <tr>
									<td width="113" align="left" class="lf">ID</td>
									
                                    <td style="font-weight:bold">:</td>
									<td align="left" class="getUID" ><?php echo $id;?></td>
								</tr>

								<tr bgcolor="#f2f2f2">
									<td width="113" align="left" class="lf">Prénom</td>
									<td style="font-weight:bold">:</td>
									<td align="left"><?php echo $prenom;?></td>
								</tr>

								<tr >
									<td align="left" class="lf">Nom</td>
									<td style="font-weight:bold">:</td>
									<td align="left"><?php echo $nom;?></td>
								</tr>
								<tr bgcolor="#f2f2f2">
									<td align="left" class="lf">Genre</td>
									<td style="font-weight:bold">:</td>
									<td align="left"><?php echo $genre;?></td>
								</tr>
								<tr>
									<td align="left" class="lf">Email</td>
									<td style="font-weight:bold">:</td>
									<td align="left"><?php echo $email;?></td>
								</tr>
								<tr bgcolor="#f2f2f2">
									<td align="left" class="lf">Numéro</td>
									<td style="font-weight:bold">:</td>
									<td align="left"><?php echo $mobile;?></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</form>
		</div>
		<p style="color:red;"><?php echo $msg;?></p>
		<p style="color:white;"><?php echo $msg2;?></p>

	</body>
</html>