<?PHP
session_start();
?>
<?PHP
require_once("database.php");
$act = (isset($_POST['act'])) ? trim($_POST['act']) : '';

$error = "";

if($act == "login") 
{
	$username 	= (isset($_POST['username'])) ? trim($_POST['username']) : '';
	$password 	= (isset($_POST['password'])) ? trim($_POST['password']) : '';

	
	$SQL_login = " SELECT * FROM `admin` WHERE `username` = '$username' AND `password` = '$password'  ";

	$result = mysqli_query($con, $SQL_login);
	$data	= mysqli_fetch_array($result);

	$valid = mysqli_num_rows($result);

	if($valid > 0)
	{
		$_SESSION["password"] = $password;
		$_SESSION["username"] = $username;
		$_SESSION["id_admin"] = $data["id_admin"];
		
		header("Location:a-main.php");
	}else{
		$error = "Invalid";
		header( "refresh:1;url=admin.php" );
		//print "<script>alert('Login tidak sah!'); self.location='index.php';</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<title>CTZBAKERY</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Poppins", sans-serif}

body, html {
  height: 100%;
  line-height: 1.8;
}

a:link {
  text-decoration: none;
}

.w3-bar .w3-button {
  padding: 16px;
}
</style>

<body class="w3-light-gray">

<?PHP include("menu-top.php");?>

<div class="w3-padding-16"></div>

<div class="" >

	<div class="w3-container w3-padding" id="contact">
		<div class="w3-content w3-container w3-white w3-round w3-card" style="max-width:500px">

			<div class="w3-row">
				
					<div class="w3-margin w3-padding " >
						<h3><b>Administrator</b></h3>
						<div class="w3-padding-16">
						<form action="" method="post">
						<?PHP if($error) { ?>			
						<div class="w3-container w3-padding-32" id="contact">
							<div class="w3-content w3-container w3-<?PHP echo $theme;?> w3-round w3-card" style="max-width:600px">
								<div class="w3-padding w3-center">
								<h3>Error! Invalid login</h3>
								<p>Please try again...</p>
								</div>
							</div>
						</div>	
						<?PHP } ?>
						
						
						  <div class="w3-section" >
							<label>Username *</label>
							<input class="w3-input w3-border w3-round" type="text" name="username"  required>
						  </div>
						  <div class="w3-section">
							<label>Password *</label>
							<input class="w3-input w3-border w3-round" type="password" name="password" required>
						  </div>
				
						  <input name="act" type="hidden" value="login">
						  <button type="submit" class="w3-button w3-block w3-padding-large w3-<?PHP echo $theme;?> w3-margin-bottom w3-round">LOGIN</button>
						</form>
						</div>
					</div>
				
				
			</div>
		  
		</div>
	</div>

<div class="w3-padding-64"></div>	
</div>

<?PHP include("footer.php");?>	


 
<script>

// Toggle between showing and hiding the sidebar when clicking the menu icon
var mySidebar = document.getElementById("mySidebar");

function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
  } else {
    mySidebar.style.display = 'block';
  }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
}
</script>

</body>
</html>