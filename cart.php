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
$id_customer= $_SESSION["id_customer"];
$total = 0;

$success = "";

$SQL_view 	= " SELECT * FROM `customer` WHERE `email` =  '". $_SESSION["email"] ."'";
$result 	= mysqli_query($con, $SQL_view);
$data		= mysqli_fetch_array($result);
$name 		= $data["name"];
$address	= $data["address"];
$phone		= $data["phone"];

$bil=0;


$rst = mysqli_query($con , "SELECT * FROM `product`  ");
while ($dat = mysqli_fetch_array($rst) )
{
	$products[$bil] = $dat["product"];
	$amounts[$bil] = $dat["price"];
	$bil++;
}


//Define the products and cost
//$products = array("product A", "product B", "product C");
//$amounts = array("19.99", "10.99", "2.99");

//Load up session
 if ( !isset($_SESSION["total"]) ) {
   $_SESSION["total"] = 0;
   for ($i=0; $i< count($products); $i++) {
    $_SESSION["qty"][$i] = 0;
   $_SESSION["amounts"][$i] = 0;
  }
 }

 //---------------------------
 //Reset
 if ( isset($_GET['reset']) )
 {
 if ($_GET["reset"] == 'true')
   {
   unset($_SESSION["qty"]); //The quantity for each product
   unset($_SESSION["amounts"]); //The amount from each product
   unset($_SESSION["total"]); //The total cost
   unset($_SESSION["cart"]); //Which item has been chosen
   }
 }

 //---------------------------
 //Add
 if ( isset($_GET["add"]) )
   {
   $i = $_GET["add"];
   $qty = $_SESSION["qty"][$i] + 1;
   $_SESSION["amounts"][$i] = $amounts[$i] * $qty;
   $_SESSION["cart"][$i] = $i;
   $_SESSION["qty"][$i] = $qty;
 }

  //---------------------------
  //Delete
  if ( isset($_GET["delete"]) )
   {
   $i = $_GET["delete"];
   $qty = $_SESSION["qty"][$i];
   $qty--;
   $_SESSION["qty"][$i] = $qty;
   //remove item if quantity is zero
   if ($qty == 0) {
    $_SESSION["amounts"][$i] = 0;
    unset($_SESSION["cart"][$i]);
  }
 else
  {
   $_SESSION["amounts"][$i] = $amounts[$i] * $qty;
  }
 }
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
			
			
			<form action="buy-complete.php" method="post" enctype="multipart/form-data" >
			<div class="w3-row">
				
				
				<div class="w3-col m12 w3-card w3-white w3-padding w3-padding-16 w3-round">
				
				<div class="w3-xlarge"><b>CART</b></div>
					<hr>
	

				<?PHP
				 if ( isset($_SESSION["cart"]) ) {
				 ?>
				<a href="?reset=true" class="w3-right w3-text-<?PHP echo $theme;?>">Reset Cart</a>	
				 <table class="w3-table w3-table-all">
					 <tr>
						 <th>Item</th>
						 <th>Qty</th>
						 <th>Amount</th>
						 <th>Action</th>
					 </tr>
				 <?php
				 $total = 0;
				 foreach ( $_SESSION["cart"] as $i ) {
				 ?>
					 <tr>
						 <td><?php echo( $products[$_SESSION["cart"][$i]] ); ?></td>
						 <td><?php echo( $_SESSION["qty"][$i] ); ?></td>
						 <td>RM <?php echo( $_SESSION["amounts"][$i] ); ?></td>
						 <td>
						 <a href="?delete=<?php echo($i); ?>" class="w3-tag w3-round w3-<?PHP echo $theme;?>"><i class="fa fa-minus"></i></a>
						 <a href="?add=<?php echo($i); ?>" class="w3-tag w3-round w3-<?PHP echo $theme;?>"><i class="fa fa-plus"></i></a>						 
						 </td>
					 </tr>
				 <?php
				 $total = $total + $_SESSION["amounts"][$i];
				 }
				 $_SESSION["total"] = $total;
				 ?>
					 <tr>
						<th colspan="2">Total : </th>
						<th colspan="2">RM <?php echo($total); ?></th>
					 </tr>
				 </table>
				 <?php
				 } else { echo "<div class='w3-center'>Your cart is empty</div>";}
				 ?>
				 
				 
				</div>			
			</div>
			<a href="product.php" class="w3-button w3-padding-16"><i class="fa fa-fw fa-chevron-left"></i> Continue Shopping </a>
			
			<div class="w3-padding-16"></div>
			
			<div class="w3-row">
				<?PHP
				 if ( isset($_SESSION["cart"]) ) {
				 ?>
				<div class="w3-col m6 w3-card w3-white w3-padding w3-padding-16 w3-round">
					<div class="w3-padding">
						<p>Delivery Address</p>
						<div class="w3-border w3-padding w3-round">
						<p><?PHP echo $data["name"]; ?></p>
						<p><?PHP echo $data["address"]; ?></p>
						<p>Phone : <?PHP echo $data["phone"]; ?></p>
						</div>
						<a href="profile.php" class="w3-button w3-padding-16"><i class="fa fa-fw fa-user-secret"></i> Update profile </a>
					</div>					
				</div>
				
				
				<div class="w3-col m6 w3-card w3-white w3-padding w3-padding-16 w3-round">
					<div class="w3-padding">  
						<p>Please make payment to the following account:</p>
						<div class="w3-sand">
						<table class="w3-table w3-bordered w3-border">
							<tr>
								<td>Bank</td>
								<td>Maybank</td>
							</tr>
							<tr>
								<td>Acc No</td>
								<td>164584127305</td>
							</tr>
							<tr>
								<td>Acc Holder</td>
								<td>Faris Izzat Bin Mohd Fauzi</td>
							</tr>
						</table>
						</div>
						<hr>
						
						<div class="w3-section" >
							Payment Date *
							<input class="w3-input w3-border w3-round" type="date" name="pay_date" value="" required>
						</div>
						
						<div class="w3-section" >
							Payment Time *
							<input class="w3-input w3-border w3-round" type="time" name="pay_time" value="" required>
						</div>
						
						<div class="w3-section" >
							Total Amount (RM)*
							<input class="w3-input w3-border w3-round" type="text" name="total" value="<?PHP echo $total;?>" required>
						</div>
						
						<div class="w3-section" >
							Payment Slip *
							<input class="w3-input w3-border w3-round" type="file" name="pay_slip" required >
							<small>  only JPEG, JPG, PNG or GIF allowed </small>
						</div>
						
						<hr>
							  
						<div class="w3-section" >
							<input name="act" type="hidden" value="add">
							<button type="submit" class="w3-button w3-black w3-text-white w3-round"><i class="fa fa-fw fa-shopping-cart"></i> SUBMIT PAYMENT APPROVAL</button>
						</div>
					</div> 
				</div>
				
				 <?PHP } ?>
			</div>
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