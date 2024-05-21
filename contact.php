<?PHP
session_start();
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
<?PHP 
$data 		= GetSetting($con);
$whatsapp 	= $data["whatsapp"];
$email 		= $data["email"];
$fb 		= $data["fb"];
$twitter 	= $data["twitter"];
$insta 		= $data["insta"];
?>

<div class="w3-padding-16"></div>

<div class="" >

	<div class="w3-container w3-padding" id="contact">
		<div class="w3-content w3-container " style="max-width:1200px">

			<div class="w3-row">
				
				<div class="w3-col m6">
					<img src="images/contact-us.png" class="w3-image">
				</div>
				
				
				<div class="w3-col m6">
					<div class="w3-margin w3-padding ">
						<div style="font-size: 50px;" class="w3-animate-right"><b>CONTACT US</b></div>
						<div class="w3-padding-16">
						<a href="<?PHP echo $fb;?>"><i class="fa fa-facebook-square fa-2x w3-paddingx"></i></a>&nbsp;&nbsp;
						<a href="<?PHP echo $twitter;?>"><i class="fa fa-twitter-square fa-2x w3-paddingx"></i></a>&nbsp;&nbsp;
						<a href="<?PHP echo $insta;?>"><i class="fa fa-instagram fa-2x w3-paddingx"></i></a><br>
						<br>
						<i class="fa fa-fw fa-phone"></i> <?PHP echo $whatsapp;?><br>
						<i class="fa fa-fw fa-envelope"></i> <?PHP echo $email; ?>

						</div>
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