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
	<span class=" w3-hide-large  w3-hide-medium">
	&nbsp;<a href="a-main.php" class="w3-bar-item"><img src="images/logo.png" style="height:40px"></a>
    </span>
    <!-- Right-sided navbar links -->
    <div class=" w3-hide-small">   
		&nbsp;<a href="a-main.php" class="w3-bar-item"><img src="images/logo.png" style="height:40px"></a>
		
		<?PHP if(isset($_SESSION["id_admin"])) { ?>
		<a href="a-main.php" class="w3-bar-item1 w3-button w3-padding-16 w3-hover-<?PHP echo $theme;?>"><b>DASHBOARD</b></a>
		<a href="a-order.php" class="w3-bar-item1 w3-button w3-padding-16 w3-hover-<?PHP echo $theme;?>"><b> ORDER</b></a>  
		<a href="a-product.php" class="w3-bar-item1 w3-button w3-padding-16 w3-hover-<?PHP echo $theme;?>"><b> PRODUCT</b></a>  
		<a href="a-customer.php" class="w3-bar-item1 w3-button w3-padding-16 w3-hover-<?PHP echo $theme;?>"><b> CUSTOMER</b></a>  
		<a href="a-category.php" class="w3-bar-item1 w3-button w3-padding-16 w3-hover-<?PHP echo $theme;?>"><b> CATEGORY</b></a>  
		<a href="a-profile.php" class="w3-bar-item1 w3-button w3-padding-16 w3-hover-<?PHP echo $theme;?>"><b> PROFILE</b></a>
		<a href="a-setting.php" class="w3-bar-item1 w3-button w3-padding-16 w3-hover-<?PHP echo $theme;?>"><b> SETTING</b></a>
		<a href="logout.php" class="w3-bar-item1 w3-button w3-padding-16 w3-hover-<?PHP echo $theme;?>"><b>LOGOUT</b></a>
		<?PHP } ?>

		<?PHP if(!isset($_SESSION["id_admin"])) { ?>
		<span class="w3-right w3-bar-item w3-buttonx w3-padding-16">&nbsp;</span>
		<span class="w3-right w3-bar-item w3-buttonx w3-padding-16"><b><i class="fa fa-fw fa-envelope-o"></i> ctzbakery@gmail.com</b></span>
		<span class="w3-right w3-bar-item w3-buttonx w3-padding-16"><b><i class="fa fa-fw fa-phone"></i> 013 12345678</b></span>
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

	<?PHP if(isset($_SESSION["id_admin"])) { ?>
	<a href="a-main.php" class="w3-bar-item w3-button">DASHBOARD</a>
	<a href="a-order.php" class="w3-bar-item w3-button">ORDER</a>  
	<a href="a-product.php" class="w3-bar-item w3-button">PRODUCT</a>  
	<a href="a-category.php" class="w3-bar-item w3-button">CATEGORY</a>  
	<a href="a-customer.php" class="w3-bar-item w3-button">CUSTOMER</a>  
	<a href="a-profile.php" class="w3-bar-item w3-button">PROFILE</a>
	<a href="a-setting.php" class="w3-bar-item w3-button">SETTING</a>
	<a href="logout.php" class="w3-bar-item w3-button">LOGOUT</a>
	<?PHP } ?>
</nav>
<!-- Menu top -->