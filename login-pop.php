<div id="idSuccessLogin" class="w3-modal" style="z-index:10;">
	<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('idSuccessLogin').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>

		<div class="w3-container w3-padding">
		
		<form action="" method="post" >
			<div class="w3-padding"></div>
			<b class="w3-large">Success</b>
			  
			<hr class="w3-clear">
			
			Successfully login.
			
			<div class="w3-padding-16"></div>
			
			<a onclick="document.getElementById('idSuccessLogin').style.display='none'; " class="w3-button w3-block w3-padding-large w3-green w3-wide w3-margin-bottom w3-round">START SHOPPING <i class="fa fa-fw fa-lg fa-shopping-cart"></i></a>


		</form>
		</div>
	</div>
</div>
<?PHP 
$act 		= (isset($_REQUEST['act'])) ? trim($_REQUEST['act']) : '';	

$name 		= (isset($_POST['name'])) ? trim($_POST['name']) : '';
$email		= (isset($_POST['email'])) ? trim($_POST['email']) : '';
$phone 		= (isset($_POST['phone'])) ? trim($_POST['phone']) : '';
$gender 	= (isset($_POST['gender'])) ? trim($_POST['gender']) : '';
$dob 		= (isset($_POST['dob'])) ? trim($_POST['dob']) : '';
$password 	= (isset($_POST['passwordx'])) ? trim($_POST['passwordx']) : '';

$name	=	mysqli_real_escape_string($con, $name);

$success = "";
$error = "";

if($act == "login") 
{
	$SQL_login = " SELECT * FROM `customer` WHERE `email` = '$email' AND `password` = '$password'  ";

	$result = mysqli_query($con, $SQL_login);
	$data_login	= mysqli_fetch_array($result);

	$valid = mysqli_num_rows($result);

	if($valid > 0)
	{
		$_SESSION["email"] = $email;
		$_SESSION["password"] = $password;
		$_SESSION["id_customer"] = $data_login["id_customer"];
		
		//header("Location:main.php");
		//print "<script>self.location='order-add.php';</script>";
		print "<script>document.getElementById('idSuccessLogin').style.display='block';</script>";
	}else{
		$error = "Invalid";
		//header( "refresh:1;url=index.php" );
		print "<script>alert('Invalid!'); self.location='index.php';</script>";
	}
}

$dat_set 	= GetSetting($con);
$theme 		= $dat_set["theme"];
?>
<div id="id01" class="w3-modal" >
    <div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
      <header class="w3-container w3-center"> 
        <span onclick="document.getElementById('id01').style.display='none'" 
        class="w3-button w3-display-topright w3-circle">&times;</span>
        <h2><b><?PHP echo $SHOP_NAME;?></b></h2>
		Sign in to your account
      </header>
	  <hr>
      <div class="w3-container w3-padding w3-margin">

		 <form action="" method="post">
			  <div class="w3-section" >
				<label>Email *</label>
				<input class="w3-input w3-border w3-round" type="email" name="email"  required>
			  </div>
			  <div class="w3-section">
				<label>Password *</label>
				<input class="w3-input w3-border w3-round" type="password" name="passwordx" maxlength="20"  required>
			  </div>
			  <input name="act" type="hidden" value="login">
			  <button type="submit" class="w3-button w3-block w3-padding-large w3-<?PHP echo $theme;?> w3-wide w3-margin-bottom w3-round">Login</button>
			</form>  
		<div class="w3-center">Forgot Password? <a href="#" onclick="document.getElementById('id01').style.display='none';
		 document.getElementById('idReset').style.display='block';" class="w3-text-<?PHP echo $theme;?>">Reset Here</a></div>
		 
		<div class="w3-padding-16"></div>
		
		<div class="w3-center">Don't have an account yet? <a href="#" onclick="document.getElementById('id01').style.display='none';
		 document.getElementById('id02').style.display='block';" class="w3-text-<?PHP echo $theme;?>">REGISTER NOW!</a></div>
      </div>
		
      <div class="w3-padding-small"></div>
    </div>
</div>

<div id="idSuccessReset" class="w3-modal" style="z-index:10;">
	<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('idSuccessReset').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>

		<div class="w3-container w3-padding">
		
		<form action="" method="post" >
			<div class="w3-padding"></div>
			<b class="w3-large">Success</b>
			  
			<hr class="w3-clear">
			
			Successfully Reset.
			
			<div class="w3-padding-16"></div>
			
			<a onclick="document.getElementById('id01').style.display='block'; document.getElementById('idSuccessReset').style.display='none'" class="w3-button w3-block w3-padding-large w3-green w3-wide w3-margin-bottom w3-round">SIGN IN </a>


		</form>
		</div>
	</div>
</div>
<?PHP
$new_password 	= (isset($_POST['new_password'])) ? trim($_POST['new_password']) : '';

if($act == "reset")
{
	$found 	= numRows($con, "SELECT * FROM `customer` WHERE `email` = '$email' AND `phone` = '$phone'  ");
	if($found == 0) 
	{
		$error ="Email or Phone Number not found";
	}
}



?>

<div id="idReset" class="w3-modal" >
    <div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
      <header class="w3-container w3-center"> 
        <span onclick="document.getElementById('idReset').style.display='none'" 
        class="w3-button w3-display-topright w3-circle">&times;</span>
        <h2><b><?PHP echo $SHOP_NAME;?></b></h2>
		Reset Password
      </header>
	  <hr>
      <div class="w3-container w3-padding w3-margin">
		
		<div class="w3-center w3-text-red"><?PHP echo $error;?></div>
		
		<form action="" method="post">
			  <div class="w3-section" >
				<label>Mobile Phone *</label>
				<input class="w3-input w3-border w3-round" type="tel" name="phone"  required>
			  </div>
			  <div class="w3-section" >
				<label>Email *</label>
				<input class="w3-input w3-border w3-round" type="email" name="email"  required>
			  </div>
			  <div class="w3-section">
				<label>New Password *</label>
				<input class="w3-input w3-border w3-round" type="password" name="new_password" maxlength="20"  required>
			  </div>
			  <input name="act" type="hidden" value="reset">
			  <button type="submit" class="w3-button w3-block w3-padding-large w3-<?PHP echo $theme;?> w3-wide w3-margin-bottom w3-round">Reset Password</button>
			</form>  
		<div class="w3-center">Already registered? <a href="#" onclick="document.getElementById('id01').style.display='block';
		 document.getElementById('idReset').style.display='none'" class="w3-text-<?PHP echo $theme;?>">LOGIN HERE</a></div>
      </div>
		
      <footer class="w3-container ">
		&nbsp;
      </footer>
    </div>
</div>


<div id="id02" class="w3-modal" >
    <div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
      <header class="w3-container w3-center"> 
        <span onclick="document.getElementById('id02').style.display='none'" 
        class="w3-button w3-display-topright w3-circle">&times;</span>
        <h2><b><?PHP echo $SHOP_NAME;?></b></h2>
		Sign up new account
      </header>
	  <hr>
      <div class="w3-container w3-padding w3-margin">

		 <form action="" method="post">
			  <div class="w3-section" >
				<label>Name *</label>
				<input class="w3-input w3-border w3-round" type="text" name="name"  required>
			  </div>
			  <div class="w3-section" >
				<label>Mobile Phone *</label>
				<input class="w3-input w3-border w3-round" type="tel" name="phone" pattern="^(\+?6?01)[01-46-9]-*[0-9]{7}$|^(\+?6?01)[1]-*[0-9]{8}$" placeholder="e.g: 0191234567" required>
			  </div>
			  <div class="w3-section" >
				<label>Email *</label>
				<input class="w3-input w3-border w3-round" type="email" name="email"  required>
			  </div>
			  <div class="w3-section" >
				<label>Gender *</label>
				<select class="w3-select w3-border w3-round" name="gender"  required>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
				</select>
			  </div>
			  <div class="w3-section" >
				<label>Date of Birth *</label>
				<input class="w3-input w3-border w3-round" type="date" name="dob"  required>
			  </div>
			  <div class="w3-section">
				<label>Password *</label>
				<input class="w3-input w3-border w3-round" type="password" name="passwordx" maxlength="20"  required>
			  </div>
			  <input name="act" type="hidden" value="add">
			  <button type="submit" class="w3-button w3-block w3-padding-large w3-<?PHP echo $theme;?> w3-wide w3-margin-bottom w3-round">Register</button>
			</form>  
		<div class="w3-center">Already registered? <a href="#" onclick="document.getElementById('id01').style.display='block';
		 document.getElementById('id02').style.display='none'" class="w3-text-<?PHP echo $theme;?>">LOGIN HERE</a></div>
      </div>
		
      <footer class="w3-container ">
		&nbsp;
      </footer>
    </div>
</div>

<div id="idSuccess" class="w3-modal" style="z-index:10;">
	<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('idSuccess').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>

		<div class="w3-container w3-padding">
		
		<form action="" method="post" >
			<div class="w3-padding"></div>
			<b class="w3-large">Congratulation</b>
			  
			<hr class="w3-clear">
			
			Your account registered successfully! Please login.
			
			<div class="w3-padding-16"></div>
			
			<a onclick="document.getElementById('idSuccess').style.display='none'; document.getElementById('id01').style.display='block'" class="w3-button w3-block w3-padding-large w3-<?PHP echo $theme;?> w3-wide w3-margin-bottom w3-round"><i class="fa fa-fw fa-lg fa-lock"></i>   LOGIN</a>


		</form>
		</div>
	</div>
</div>



<?PHP
if($act == "reset")
{
	$found 	= numRows($con, "SELECT * FROM `customer` WHERE `email` = '$email' AND `phone` = '$phone'  ");
	if($found == 0) 
	{
		$error ="Email or Phone Number not found";
		print "<script>document.getElementById('idReset').style.display='block';</script>";
	}
}


if(($act == "reset") && (!$error))
{	
	$SQL_update = " 
		UPDATE
			`customer`
		SET
			`password` = '$new_password'
		WHERE 
			`email` = '$email' AND `phone` = '$phone' 
		";
	
	$result = mysqli_query($con, $SQL_update);

	$success = "Successfully Reset";
	print "<script>document.getElementById('idSuccessReset').style.display='block';</script>";
}


if($act == "add")
{	
	$SQL_insert = " 
	INSERT INTO `customer`(`name`,  `email`, `password`,  `phone`, `gender`, `dob`, `address`) 
				   VALUES ('$name', '$email', '$password', '$phone', '$gender', '$dob', '')";
										
	$result = mysqli_query($con, $SQL_insert);

	$success = "Successfully Registered";
	
	print "<script>document.getElementById('idSuccess').style.display='block';</script>";
}
?>