<?PHP
session_start();

include("database.php");
if( !verifyAdmin($con) ) 
{
	header( "Location: index.php" );
	return false;
}
?>
<?PHP	
$act 	= (isset($_POST['act'])) ? trim($_POST['act']) : '';	

$whatsapp	= (isset($_POST['whatsapp'])) ? trim($_POST['whatsapp']) : '';
$email		= (isset($_POST['email'])) ? trim($_POST['email']) : '';
$fb			= (isset($_POST['fb'])) ? trim($_POST['fb']) : '';
$twitter	= (isset($_POST['twitter'])) ? trim($_POST['twitter']) : '';
$insta		= (isset($_POST['insta'])) ? trim($_POST['insta']) : '';
$theme		= (isset($_POST['theme'])) ? trim($_POST['theme']) : '';

$email	=	mysqli_real_escape_string($con, $email);

if($act == "edit")
{	
	$SQL_update = " UPDATE `setting` SET 
						`whatsapp` = '$whatsapp',
						`email` = '$email',
						`fb` = '$fb',
						`twitter` = '$twitter',
						`insta` = '$insta',
						`theme` = '$theme'
					";	
										
	$result = mysqli_query($con, $SQL_update) or die("Error in query: ".$SQL_update."<br />".mysqli_error($con));
	
	print "<script>alert('Successfully Updated');</script>";
}


$SQL_view 	= " SELECT * FROM `setting`  ";
$result 	= mysqli_query($con, $SQL_view) or die("Error in query: ".$SQL_view."<br />".mysqli_error($con));
$data		= mysqli_fetch_array($result);
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

.w3-beige {background-color: rgba(237, 205, 172, 100); }

.w3-bar .w3-button {
  padding: 16px;
}
</style>

<body class="w3-light-gray">

<?PHP include("menu-top-admin.php");?>

<div class="" >

<div class="w3-padding-16"></div>

	<div class=" w3-center w3-text-blank w3-padding-32">
		<span class="w3-xlarge"><b>SETTING</b></span><br>
	</div>
	
	<div class="w3-container w3-padding" id="contact">
		<div class="w3-content w3-container w3-card w3-white w3-padding w3-padding-16" style="max-width:500px">

			<form method="post" action="" >
				<div class="w3-section" >
					<label>WhatsApp *</label>
					<input class="w3-input w3-border w3-round" type="text" name="whatsapp" value="<?PHP echo $data["whatsapp"]; ?>"  required>
				</div>

				<div class="w3-section">
					<label>Email *</label>
					<input class="w3-input w3-border w3-round" type="email" name="email" value="<?PHP echo $data["email"]; ?>" required>
				</div>
				
				<div class="w3-section" >
					<label>Facebook </label>
					<input class="w3-input w3-border w3-round" type="text" name="fb" value="<?PHP echo $data["fb"]; ?>"  >
				</div>
				
				<div class="w3-section" >
					<label>Twitter </label>
					<input class="w3-input w3-border w3-round" type="text" name="twitter" value="<?PHP echo $data["twitter"]; ?>"  >
				</div>
				
				<div class="w3-section" >
					<label>Instagram </label>
					<input class="w3-input w3-border w3-round" type="text" name="insta" value="<?PHP echo $data["insta"]; ?>"  >
				</div>
				
				<div class="w3-section " >
					<label>Theme Colour *</label>
					<select class="w3-select w3-border w3-round" name="theme" required>
						<option value="red" <?PHP if($data["theme"] == "red") echo "selected";?> class="w3-red">Red</option>
						<option value="pink" <?PHP if($data["theme"] == "pink") echo "selected";?> class="w3-pink" >Pink</option>
						<option value="blue" <?PHP if($data["theme"] == "blue") echo "selected";?> class="w3-blue" >Blue</option>
						<option value="green" <?PHP if($data["theme"] == "green") echo "selected";?> class="w3-green" >Green</option>
						<option value="amber" <?PHP if($data["theme"] == "amber") echo "selected";?> class="w3-amber" >Amber</option>
						<option value="orange" <?PHP if($data["theme"] == "orange") echo "selected";?> class="w3-orange" >Orange</option>
						<option value="brown" <?PHP if($data["theme"] == "brown") echo "selected";?> class="w3-brown" >Brown</option>
						<option value="black" <?PHP if($data["theme"] == "black") echo "selected";?> class="w3-black" >Black</option>
					</select>
				</div>
				
				<hr class="w3-clear">
				<input type="hidden" name="act" value="edit" >
				<button type="submit" class="w3-button w3-wide w3-block w3-padding-large w3-black w3-margin-bottom w3-round">UPDATE</button>

			</form>
		  
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