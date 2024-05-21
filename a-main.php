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
$tot_category 	= numRows($con, "SELECT * FROM `category`");
$tot_product = numRows($con, "SELECT * FROM `product`");
$tot_order 	= numRows($con, "SELECT * FROM `orders`");

$data		= mysqli_fetch_array(mysqli_query($con, "SELECT SUM(total) as Total FROM `orders`"));
$Total 		= $data["Total"] + 0;

$dat_set 	= GetSetting($con);
$theme 		= $dat_set["theme"];
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

<?PHP include("menu-top-admin.php");?>

<div class="" >

<div class="w3-padding-16"></div>

	<div class=" w3-center w3-text-blank w3-padding-32">
		<span class="w3-xlarge"><b>WELCOME, ADMIN</b></span><br>
	</div>
	
	<div class="w3-container w3-padding" id="contact">
		<div class="w3-content w3-container " style="max-width:1200px">

			<div class="w3-row w3-large">
				
				<div class="w3-padding ">
					<div class="w3-card w3-padding w3-round w3-white">
						
						<div class="w3-row w3-padding-24">

							<div class="w3-col m3 w3-padding">
								<div class=" w3-card w3-<?PHP echo $theme;?> w3-round w3-padding-16">
									<div class="w3-container w3-large">
										Product <i class="fa fa-cube fa-lg w3-right"></i> 
										<hr style="border-top: 1px dashed; margin: 1px 0 15px !important;">
										<h2 class="w3-center"><?PHP echo $tot_product;?></h2>
									</div>
								</div>
							</div>
							
							<div class="w3-col m3 w3-padding">
								<div class=" w3-card w3-<?PHP echo $theme;?> w3-round w3-padding-16">
									<div class="w3-container w3-large">
										Category <i class="fa fa-list fa-lg w3-right"></i> 
										<hr style="border-top: 1px dashed; margin: 1px 0 15px !important;">
										<h2 class="w3-center"><?PHP echo $tot_category;?></h2>
									</div>
								</div>
							</div>
				
							
							<div class="w3-col m3 w3-padding">
								<div class=" w3-card w3-<?PHP echo $theme;?> w3-round w3-padding-16">
									<div class="w3-container w3-large">
										Order <i class="fa fa-list-ol fa-lg w3-right"></i> 
										<hr style="border-top: 1px dashed; margin: 1px 0 15px !important;">
										<h2 class="w3-center"><?PHP echo $tot_order;?></h2>
									</div>
								</div>
							</div>
							
							<div class="w3-col m3 w3-padding">
								<div class=" w3-card w3-<?PHP echo $theme;?> w3-round w3-padding-16">
									<div class="w3-container w3-large">
										All Sales <i class="fa fa-usd fa-lg w3-right"></i> 
										<hr style="border-top: 1px dashed; margin: 1px 0 15px !important;">
										<h2 class="w3-center"><?PHP echo $Total;?></h2>
									</div>
								</div>
							</div>
							
								
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