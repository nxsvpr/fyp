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
$order_no 	= (isset($_GET['order_no'])) ? trim($_GET['order_no']) : '';

$bil=0;

$rst = mysqli_query($con , "SELECT * FROM `product`");
while ($dat = mysqli_fetch_array($rst) )
{
	$products[$bil] = $dat["product"];
	$amounts[$bil] = $dat["price"];
	$bil++;
}


$success = "";

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>CTZBAKERY</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="css/table.css" rel="stylesheet" />

<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
.w3-bar-block .w3-bar-item {padding: 16px}

a:link {
  text-decoration: none;
}
</style>
</head>
<body class="w3-light-gray">

<!-- Side Navigation -->
<?PHP include("menu-top.php");?>


<div class="w3-padding-16"></div>

<div class="w3-container w3-content w3-xlarge " style="max-width:1200px;"> Order Complete</div>
<div class="w3-container w3-content " style="max-width:1200px;"> 
Thank you for your purchase.
</div>

	
<div class="w3-container">

	<!-- Page Container -->
	<div class="w3-container w3-content  w3-padding-16 " style="max-width:1200px;">    
		<!-- The Grid -->
		<div class="w3-row ">
	  
			<div class="w3-col m8 w3-card w3-white w3-padding w3-padding-16">
				
				
				<div class="w3-xlarge">Order No : <b><?PHP echo $order_no;?></b></div>
					<hr>

				<?PHP
				 if ( isset($_SESSION["cart"]) ) {
				 ?>
				 <table class="w3-table w3-table-all">
					 <tr>
						 <th>Item</th>
						 <th width="10px">&nbsp;</th>
						 <th>Qty</th>
						 <th width="10px">&nbsp;</th>
						 <th>Amount</th>
					 </tr>
				 <?php
				 $total = 0;
				 foreach ( $_SESSION["cart"] as $i ) {
				 ?>
					 <tr>
						 <td><?php echo( $products[$_SESSION["cart"][$i]] ); ?></td>
						 <td width="10px">&nbsp;</td>
						 <td><?php echo( $_SESSION["qty"][$i] ); ?></td>
						 <td width="10px">&nbsp;</td>
						 <td>RM <?php echo( $_SESSION["amounts"][$i] ); ?></td>
					 </tr>
				 <?php
				 $total = $total + $_SESSION["amounts"][$i];
				 }
				 $_SESSION["total"] = $total;
				 ?>
					 <tr>
						<td colspan="4">Total :</td>
						<td colspan="3">RM <?php echo($total); ?></td>
					 </tr>
				 </table>
				 <?php
				 }
				 ?>
				 
				 
			</div>
			
			<div class="w3-col m4 ">
				
			</div>

		<!-- End Grid -->
		</div>
	  
	<!-- End Page Container -->
	</div>
	
	
	

</div>
<!-- container end -->
	

<div class="w3-padding-24"></div>
     
</div>
<!-- Page content -->

<?PHP
	unset($_SESSION["cart"]); 
	unset($_SESSION["qty"]); //The quantity for each product
	unset($_SESSION["amounts"]); //The amount from each product
	unset($_SESSION["total"]); //The total cost
	unset($_SESSION["cart"]); //Which item has been chosen
?>

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