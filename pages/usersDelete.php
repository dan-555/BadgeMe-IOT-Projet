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
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>		<link href="../css/pages/usersEdit.css" rel="stylesheet">
		<title>Edit</title>
		
	</head>
	
	<body>
<div class="container-fluid">
    <?php require '../includes/header.php'; ?>
		<h2>Supprimer l'étudiant</h2>
        
        <?php $idStudent=$_GET['id']; ?>

	<div class="container">
        <div class="alert alert-danger" role="alert">
        Etes-vous sur de vouloir supprimer l'étudiant ?</div>
    </div>
    <div class="row">
    					<div class="col text-center">
							<button onclick='usersDelete("<?php echo $idStudent;?>")' name="button1" class="btn btn-danger" style="text-align:center;">Oui</button>
							<a href="usersList.php">
                                <button style="background-color:white;" type="button" class="btn" style="text-align:center;">Non</button>
                            </a>
   						 </div>
 	</div>

</div>














<script>


function usersDelete(idStudent)
{
	
var url= 'usersDeleteForm.php';
$.ajax({

        type:"POST",
        url:url,
        data: {id: idStudent},
        success: function(response){
             alert(response);
             window.location.href = 'usersList.php';
        }
        });
}








		</script>
	</body>
</html>