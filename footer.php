<?PHP 
$dat_set 	= GetSetting($con);
$whatsapp 	= $dat_set["whatsapp"];
$email 		= $dat_set["email"];
$fb 		= $dat_set["fb"];
$twitter 	= $dat_set["twitter"];
$insta 		= $dat_set["insta"];
$insta 		= $dat_set["insta"];
$theme 		= $dat_set["theme"];
?>
<div class="w3-container w3-<?PHP echo $theme;?>" id="contact">
	<div class="w3-content w3-container " style="max-width:1200px">
		
		<!--<div class="w3-center"><img src="images/footer_be.png" class="w3-image"></div>-->
		<div class="w3-row ">
			
			<div class="w3-col m4 w3-padding-16">
				<h3><b>Menu</b></h3>
				<a href="index.php" class="w3-padding-16 ">Home</a><br>
				<a href="about.php" class="w3-padding-16 ">About</a><br>
				<?PHP if(!isset($_SESSION["id_admin"])) { ?>
				<a href="admin.php" class="w3-padding-16 ">Administrator</a><br>
				<?PHP } else { ?>
				<a href="logout.php" class="w3-padding-16 ">Logout</a><br>
				<?PHP } ?>
			</div>
			
			
			<div class="w3-col m4 w3-padding-16">
				<h3><b>Shop</b></h3>
				<a href="index.php" class="w3-padding-16 ">Our product</a><br>
			</div>
			
			<div class="w3-col m4 w3-padding-16">
				<h3><b>Follow Us</b></h3>
				<a href="<?PHP echo $fb;?>"><i class="fa fa-facebook-square fa-2x w3-paddingx"></i></a>&nbsp;&nbsp;
						<a href="<?PHP echo $twitter;?>"><i class="fa fa-twitter-square fa-2x w3-paddingx"></i></a>&nbsp;&nbsp;
						<a href="<?PHP echo $insta;?>"><i class="fa fa-instagram fa-2x w3-paddingx"></i></a><br>
				<i class="fa fa-fw fa-phone"></i> <?PHP echo $whatsapp;?><br>
				<i class="fa fa-fw fa-envelope"></i> <?PHP echo $email; ?>
			</div>
			
		</div>
	
	
	</div>
</div>