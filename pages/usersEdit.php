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
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>		
		<link href="../css/pages/usersEdit.css" rel="stylesheet">
		<title>Edit</title>
		
	</head>
	
	<body>
<div class="container-fluid">
    <?php require '../includes/header.php'; ?>
		<h2>Modifier l'étudiant</h2>
		
		<div class="container" style="width:70%">
      	
				<?php  
				
				$idStudent=$_GET['id'];
				
				$sql = "SELECT * FROM etudiant WHERE id='{$idStudent}'";
				$result = $mysqli->query($sql);				
                 
				if ($result->num_rows > 0) { //trouve l'etudiant

                    while($row = $result->fetch_assoc()) { //Donnees de l'etudiant

						$nom=$row['lastname'];
						$prenom=$row['firstname'];
						$email=$row['email'];
						$genre=$row['genre'];
						$mobile=$row['mobile'];

                   ?>
					
				    <label style="color:white;" class="form-label">ID</label>
					<div class="input-group" style="margin-bottom: 15px;"> 
						<span class="input-group-text" id="basic-addon1" for="id">#</span>
						<input name="id" readonly value="<?php echo $idStudent ?>" id="id" type="text" class="form-control">
					</div >

					<div class="row">
							<div class="col-md-6">
								<div class="form-group" style="margin-bottom: 15px;">
									<label style="color:white;" class="form-label">Nom</label>
									<input name="nom" value="<?php echo $nom ?>" id="nom" type="text" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group" style="margin-bottom: 15px;">
									<label style="color:white;" class="form-label">Prenom</label>
									<input name="prenom" value="<?php echo $prenom ?>" id="prenom" type="text" class="form-control" >
								</div>
							</div>
					</div>

					<label style="color:white;" class="form-label">Email</label>
					<div class="input-group" style="margin-bottom: 15px;">
						<span class="input-group-text" id="basic-addon1" for="email">@</span>
						<input name="email" value="<?php echo $email ?>" id="email" type="text" class="form-control" aria-label="email" aria-describedby="basic-addon1">
					</div>
					
					
					<label style="color:white;" class="form-label">Genre</label>
					
					<span id="defaultGender" style="display:none"><?php echo $genre ?></span>
					<select name="genre" class="form-select" style="margin-bottom: 15px;" id="mySelect">
							<option value="M">Masculin</option>
							<option value="F">Feminin</option>
					</select>

					<label style="color:white;" class="form-label">Numéro</label>
					<div class="input-group" style="margin-bottom: 20px;">
						<span class="input-group-text" id="basic-addon1" for="email">📞</span>
						<input name="numero" value="<?php echo $mobile ?>" id="num" type="text" class="form-control" aria-label="num" aria-describedby="basic-addon1">
					</div>

				<div class="row">
    					<div class="col text-center">
							<button onclick='usersEdit()' style="background-color:white;" name="button1" class="btn" style="text-align:center;">Modifier</button>
							<button style="background-color:white;" type="button" class="btn" style="text-align:center;">Retour</button>
   						 </div>
 				</div>
			
                  
	<?php	
					
					}
                 
                 }
                 else { //Pas d'etudiant
                 }
                 $mysqli->close();				
				
				?>
				
		</div> <!-- /container -->	
        </div>

		<script>
			var g = document.getElementById("defaultGender").innerHTML;
		
			if(g=="M") {
				document.getElementById("mySelect").selectedIndex = "0";
			} else {
				document.getElementById("mySelect").selectedIndex = "1";
			}


function usersEdit()
{
	var id=document.getElementsByName("id")[0].value;
	var nom=document.getElementsByName("nom")[0].value;
	var prenom=document.getElementsByName("prenom")[0].value;
	var email=document.getElementsByName("email")[0].value;
	var genre=document.getElementsByName("genre")[0].value;
	var numero=document.getElementsByName("numero")[0].value;

	console.log(id);
	console.log(nom);
	console.log(prenom);
	console.log(email);
	console.log(genre);
	console.log(numero);


var url= 'usersEditForm.php';
$.ajax({

        type:"POST",
        url:url,
        data: {id: id,nom: nom,prenom: prenom,email: email,genre: genre, numero: numero},
        success: function(response){
      		  alert(response);
			  window.location.href = 'usersList.php';

        }
        });
}








		</script>
	</body>
</html>