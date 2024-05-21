<?PHP
session_start();
include("database.php");
if( !verifyCustomer($con) ) 
{
	header( "Location: index.php" );
	return false;
}
?>
<?PHP
$act 		= (isset($_REQUEST['act'])) ? trim($_REQUEST['act']) : '';	
$id_customer= (isset($_REQUEST['id_customer'])) ? trim($_REQUEST['id_customer']) : '';	

$name 		= (isset($_POST['name'])) ? trim($_POST['name']) : '';
$email		= (isset($_POST['email'])) ? trim($_POST['email']) : '';
$phone 		= (isset($_POST['phone'])) ? trim($_POST['phone']) : '';
$password 	= (isset($_POST['password'])) ? trim($_POST['password']) : '';
$address 	= (isset($_POST['address'])) ? trim($_POST['address']) : '';
$dob 	= (isset($_POST['dob'])) ? trim($_POST['dob']) : '';
$gender 		= (isset($_POST['gender'])) ? trim($_POST['gender']) : '';

$success = "";

if($act == "edit")
{	
	$SQL_update = " UPDATE `customer` SET 
						`name` = '$name',
						`email` = '$email',
						`password` = '$password',
						`phone` = '$phone',
						`address` = '$address',
						`dob` = '$dob',
						`gender` = '$gender'
					WHERE `email` =  '". $_SESSION["email"] ."'";	
										
	$result = mysqli_query($con, $SQL_update) or die("Error in query: ".$SQL_update."<br />".mysqli_error($con));
	
	$success = "Successfully Update";
}

if($act == "del")
{
	$SQL_delete = " DELETE FROM `customer` WHERE `id_customer` =  '$id_customer' ";
	$result = mysqli_query($con, $SQL_delete);
	
	//$success = "Successfully Delete";
	print "<script>self.location='logout.php';</script>";
}

$SQL_view 	= " SELECT * FROM `customer` WHERE `email` =  '". $_SESSION["email"] ."'";
$result 	= mysqli_query($con, $SQL_view);
$data		= mysqli_fetch_array($result);
$name 		= $data["name"];
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
		<div class="w3-content w3-container" style="max-width:600px">
		
		
			<div class="w3-center">
			<div class="w3-xlarge"><b>MY PROFILE</b></div>
			</div>
			<div class="w3-padding-16"></div>
			
		<div class="w3-card w3-white w3-padding w3-padding-16 w3-round">	
			<div class="w3-row">
				
			<form action="" method="post">
				<div class="w3-padding">
				<b class="w3-large">Update Profile</b>
				<hr>

				  <div class="w3-section " >
					Full Name
					<input class="w3-input w3-border w3-round" type="text" name="name" value="<?PHP echo $data["name"];?>" placeholder="First Name" required>
				  </div>
				  
				  <div class="w3-section " >
					Password
					<input class="w3-input w3-border w3-round" type="password" name="password" value="<?PHP echo $data["password"];?>" placeholder="Password" required>
				  </div>
				  
				   <div class="w3-section " >
					Email
					<input class="w3-input w3-border w3-round" type="email" name="email" value="<?PHP echo $data["email"];?>" placeholder="Email" required>
				  </div>

				  <div class="w3-section " >
					Mobile Phone
					<input class="w3-input w3-border w3-round" type="text" name="phone" value="<?PHP echo $data["phone"];?>" placeholder="Contact No" required>
				  </div>
				  
				  <div class="w3-section " >
					Date of Birth
					<input class="w3-input w3-border w3-round" type="text" name="dob" value="<?PHP echo $data["dob"];?>" placeholder="" required>
				  </div>
				  
				  <div class="w3-section " >
					Gender
					<select class="w3-select w3-border w3-round" name="gender" required>
						<option value="Male" <?PHP  if($data["gender"] == "Male") echo "selected";?>>Male</option>
						<option value="Female" <?PHP  if($data["gender"] == "Female") echo "selected";?>>Female</option>
					</select>
				  </div>
				  
				  <div class="w3-section " >
					Address
					<textarea class="w3-input w3-border w3-round" rows="2" name="address" required><?PHP echo $data["address"];?></textarea>
				  </div>
					

				<hr class="w3-clear">

				<input type="hidden" name="act" value="edit" >
				<button type="submit" class="w3-button w3-black w3-text-white w3-margin-bottom w3-round">SAVE CHANGES</button>

			  </div>
			</form>	
				
				
			</div>
		
		</div>		
		
		</div>
		
		
	</div>

<div class="w3-center w3-text-red"><a href="#" onclick="document.getElementById('idDelete').style.display='block'">Remove my account</a></div>

<div class="w3-padding-64"></div>	
</div>


<div id="idDelete" class="w3-modal" style="z-index:10;">
	<div class="w3-modal-content w3-round-large w3-customerd-4 w3-animate-zoom" style="max-width:500px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('idDelete').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>

		<div class="w3-container w3-padding">
		
		<form action="" method="post">
			<div class="w3-padding"></div>
			<b class="w3-large">Confirmation</b>
			  
			<hr class="w3-clear">			
			Are you sure to delete your account ?
			<div class="w3-padding-16"></div>
			
			<input type="hidden" name="id_customer" value="<?PHP echo $data["id_customer"];?>" >
			<input type="hidden" name="act" value="del" >
			<button type="button" onclick="document.getElementById('idDelete').style.display='none'"  class="w3-button w3-gray w3-text-white w3-margin-bottom w3-round">CANCEL</button>
			
			<button type="submit" class="w3-right w3-button w3-<?PHP echo $theme;?> w3-text-white w3-margin-bottom w3-round">YES, CONFIRM</button>
		</form>
		</div>
	</div>
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