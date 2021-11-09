<?php
	$Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
	file_put_contents('../UIDContainer.php',$Write);
?>
<?php
require_once('../includes/connexion.php');
?>


<!DOCTYPE html>
<html lang="en">
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<link href="../css/pages/usersList.css" rel="stylesheet">    		
			       
</head>
	<body>
    <div class="container-fluid">
    <?php require '../includes/header.php'; ?>
    <h2 style="color:white;">Etudiants</h3>

		<div class="container">

			<br>
            <div class="row">
                <table style="background-color: white;" class="table table-bordered table-hover table-striped" >
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nom</th>
                      <th>Prénom</th>
					            <th>Sexe</th>
					            <th>Email</th>
                      <th>Numéro</th>
					            <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                
                 $sql = "SELECT * FROM `etudiant`";
                 $result = $mysqli->query($sql);
                 
                 if ($result->num_rows > 0) {

                    while($row = $result->fetch_assoc()) {

                        echo '<tr>';
                        echo '<td>'. $row['id'] . '</td>';
                        echo '<td>'. $row['lastname'] . '</td>';
                        echo '<td>'. $row['firstname'] . '</td>';
                        echo '<td>'. $row['genre'] . '</td>';
                        echo '<td>'. $row['email'] . '</td>';
                        echo '<td>'. $row['mobile'] . '</td>';
                        echo '<td><a class="btn btn-success" href="usersEdit.php?id='.$row['id'].'">Modifier</a>';
                        echo ' ';
                        echo '<a class="btn btn-danger" href="usersDelete.php?id='.$row['id'].'">Supprimer</a>';
                        echo '</td>';
                        echo '</tr>';

                    }
                 
                 }
                 else { //Pas d'etudiant
                 }
                 $mysqli->close();


            
                  ?>
                  </tbody>
				</table>
			</div>


			
		</div> <!-- /container -->
        </div>

	</body>
</html>