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

<div class="w3-padding-16"></div>

<div class="" >

	<div class="w3-container w3-padding" id="contact">
		<div class="w3-content w3-container " style="max-width:1200px">

			<div class="w3-row">
				
				<div class="w3-col m6">
					<div class="w3-padding">
					<img src="images/about-us.png" class="w3-image">
					</div>
				</div>
				
				
				<div class="w3-col m6">
					<div class="w3-margin w3-padding ">
						<div style="font-size: 50px;" class="w3-animate-right"><b>ABOUT US</b></div>
						<div class="w3-padding-16">
<p><b>CTZBAKERY</b> Welcome to CTZ Bakery, where passion meets talent and every bite is a labor of love. 
Founded by Mr. Faris Izzat, a talented culinary enthusiast, our bakery is the culmination of years of dedication and a deep-rooted passion for baking.</p>

<p>After graduating from high school, Faris Izzat embarked on a journey to turn his culinary talents into something extraordinary. 
	Fueled by his love for cooking and baking, he decided to channel his skills into a side hustle - selling homemade bakery goods. 
	What started as a simple idea quickly evolved into CTZ Bakery, a haven for delicious treats and warm memories.</p>

<p>We invite you to explore our menu and experience the magic of CTZ Bakery for yourself. 
	From our kitchen to your home, let us share our passion for baking and create moments of happiness, one delicious treat at a time. 
	Thank you for choosing us – where every bite is made with love and talent.</p>
						</div>
					</div>
				</div>
				
				
			</div>
		  
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