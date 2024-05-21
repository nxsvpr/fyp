<?PHP 
require_once("database.php");
include("login-pop.php");

$dat_set 	= GetSetting($con);
$whatsapp 	= $dat_set["whatsapp"];
$email 		= $dat_set["email"];
$theme 		= $dat_set["theme"];
?>	
<!-- Menu top -->
<div class="w3-topx w3-card">
  <div class="w3-bar" id="myNavbar">
	<span class=" w3-hide-large w3-hide-medium">
	&nbsp;<a href="index.php" class="w3-bar-item"><img src="images/logo.png" style="height:40px"></a>
    </span>
	<!-- Right-sided navbar links -->
    <div class=" w3-hide-small">   
		&nbsp;<a href="index.php" class="w3-bar-item"><img src="images/logo.png" style="height:40px"></a>
		<!--&nbsp;<a href="index.php" class="w3-xlarge w3-text-<?PHP echo $theme;?>-gray w3-bar-item1 w3-padding"><b><i>SIE-Shop</i></b></a>-->
		<a href="index.php" class="w3-bar-item w3-button w3-padding-16 w3-hover-<?PHP echo $theme;?>"><b>HOME</b></a>
		<a href="product.php" class="w3-bar-item w3-button w3-padding-16 w3-hover-<?PHP echo $theme;?>"><b>PRODUCT</b></a>
		<a href="about.php" class="w3-bar-item w3-button w3-padding-16 w3-hover-<?PHP echo $theme;?>"><b>ABOUT</b></a>
		<a href="contact.php" class="w3-bar-item w3-button w3-padding-16 w3-hover-<?PHP echo $theme;?>"><b>CONTACT US</b></a>
		<?PHP if(!isset($_SESSION["id_customer"])) { ?>
		<a href="#" onclick="document.getElementById('id01').style.display='block'" class="w3-bar-item1 w3-button w3-padding-16 w3-hover-<?PHP echo $theme;?>"><b>LOGIN</b></a>
		<?PHP } ?>
		
		<?PHP if(isset($_SESSION["id_customer"])) { ?>
		<a href="cart.php" class="w3-bar-item w3-button w3-padding-16 w3-text-<?PHP echo $theme;?> w3-hover-<?PHP echo $theme;?>"><b>CART <i class="fa fa-shopping-cart"></i></b></a>
		<a href="order.php" class="w3-bar-item w3-button w3-padding-16 w3-text-<?PHP echo $theme;?> w3-hover-<?PHP echo $theme;?>"><b>ORDER HISTORY</b></a>
		<a href="profile.php" class="w3-bar-item w3-button w3-padding-16 w3-text-<?PHP echo $theme;?> w3-hover-<?PHP echo $theme;?>"><b> PROFILE</b></a>
		<a href="logout.php" class="w3-bar-item w3-button w3-padding-16 w3-text-<?PHP echo $theme;?> w3-hover-<?PHP echo $theme;?>"><b>LOGOUT</b></a>
		<?PHP } ?>
		
		<?PHP if(!isset($_SESSION["id_customer"])) { ?>
		<span class="w3-right w3-bar-item w3-padding-16">&nbsp;</span>
		<span class="w3-right w3-bar-item w3-padding-16"><b><i class="fa fa-fw fa-envelope-o"></i> <?PHP echo $email;?></b></span>
		<span class="w3-right w3-bar-item w3-padding-16"><b><?PHP echo $whatsapp;?></b></span>
		<span class="w3-right w3-bar-item1 w3-padding-16"><b><a href="https://api.WhatsApp.com/send?phone=<?PHP echo $whatsapp;?>"><i class="fa fa-fw fa-whatsapp fa-lg w3-text-green"></i></a></b></span>
		<?PHP } ?>
    </div>
    <!-- Hide right-floated links on small screens and replace them with a menu icon -->
	<a href="javascript:void(0)" class="w3-bar-item1 w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
      <i class="fa fa-bars"></i>
    </a>

  </div>
</div>

<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-dark-gray w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
	<a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>

	<a href="index.php" onclick="w3_close()" class="w3-bar-item w3-button">HOME</a>
	<a href="product.php" onclick="w3_close()" class="w3-bar-item w3-button">PRODUCT</a>
	<a href="about.php" onclick="w3_close()" class="w3-bar-item w3-button">ABOUT</a>	
	<a href="contact.php" onclick="w3_close()" class="w3-bar-item w3-button">CONTACT</a>
	<?PHP if(!isset($_SESSION["id_customer"])) { ?>
	<a href="#" onclick="document.getElementById('id01').style.display='block'" class="w3-bar-item w3-button">LOGIN</a>
	<?PHP } ?>
		
	<?PHP if(isset($_SESSION["id_customer"])) { ?>
	<a href="cart.php" class="w3-bar-item w3-button">CART</a>
	<a href="order.php" class="w3-bar-item w3-button">ORDER HISTORY</a>
	<a href="profile.php" class="w3-bar-item w3-button">PROFILE</a>
	<a href="logout.php" class="w3-bar-item w3-button">LOGOUT</a>
	<?PHP } ?>
</nav>
<!-- Menu top -->