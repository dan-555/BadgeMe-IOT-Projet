<?php
require_once('../includes/connexion.php');
?>
<?php
	$Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
	file_put_contents('../UIDContainer.php','');
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
		
        <link href="../css/pages/porte.css" rel="stylesheet">    		
		<script>
			$(document).ready(function(){
				 $("#getUID").load("../UIDContainer.php");
				setInterval(function() {
					$("#getUID").load("../UIDContainer.php");	
				}, 500);
			});
		</script>      
</head>
<body>
    <div class="container-fluid">
        <?php require '../includes/header.php'; ?>
        <h2 style="color:white;">Porte Principale</h3>
        <p id="getUID" hidden></p>

                <div id="show_user_data">
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
                                            <td align="left" class="getUID" >--------</td>
                                        </tr>

                                        <tr bgcolor="#f2f2f2">
                                            <td width="113" align="left" class="lf">Prénom</td>
                                            <td style="font-weight:bold">:</td>
                                            <td align="left">--------</td>
                                        </tr>

                                        <tr >
                                            <td align="left" class="lf">Nom</td>
                                            <td style="font-weight:bold">:</td>
                                            <td align="left">--------</td>
                                        </tr>
                                        <tr bgcolor="#f2f2f2">
                                            <td align="left" class="lf">Genre</td>
                                            <td style="font-weight:bold">:</td>
                                            <td align="left">--------</td>
                                        </tr>
                                        <tr>
                                            <td align="left" class="lf">Email</td>
                                            <td style="font-weight:bold">:</td>
                                            <td align="left">--------</td>
                                        </tr>
                                        <tr bgcolor="#f2f2f2">
                                            <td align="left" class="lf">Numéro</td>
                                            <td style="font-weight:bold">:</td>
                                            <td align="left">--------</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
				        </table>
		          </form>
	        	</div>
</div>
        <script>
			var myVar = setInterval(myTimer, 1000);
			var myVar1 = setInterval(myTimer1, 1000);
			var oldID="";
			clearInterval(myVar1);

			function myTimer() {
				var getID=document.getElementById("getUID").innerHTML;
				oldID=getID;
				if(getID!="") {
					myVar1 = setInterval(myTimer1, 500);
					showUser(getID);
					clearInterval(myVar);
				}
			}
			
			function myTimer1() {
				var getID=document.getElementById("getUID").innerHTML;
				if(oldID!=getID) {
					myVar = setInterval(myTimer, 500);
					clearInterval(myVar1);
				}
			}
			
			function showUser(str) {
				if (str == "") {
					document.getElementById("show_user_data").innerHTML = "";
					return;
				} else {
					if (window.XMLHttpRequest) {
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp = new XMLHttpRequest();
					} else {
						// code for IE6, IE5
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					}
					xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							document.getElementById("show_user_data").innerHTML = this.responseText;
						}
					};
					xmlhttp.open("GET","porteForm.php?id="+str,true);
					xmlhttp.send();
				}
			}
			
		/*	var blink = document.getElementById('blink');
			setInterval(function() {
				blink.style.opacity = (blink.style.opacity == 0 ? 1 : 0);
			}, 750); */
		</script>
	</body>

</html>