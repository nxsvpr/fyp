<?PHP
session_start();

include("database.php");
if( !verifyCustomer($con) ) 
{
	header( "Location: index.php" );
	return false;
}
?>
<script type="text/javascript">
window.history.forward();
function noBack() {
	window.history.forward();
}
</script>
<?PHP
$id_customer= (isset($_SESSION['id_customer'])) ? trim($_SESSION['id_customer']) : '0';
$act 		= (isset($_POST['act'])) ? trim($_POST['act']) : '';	

$pay_date 	= (isset($_POST['pay_date'])) ? trim($_POST['pay_date']) : '';
$pay_time	= (isset($_POST['pay_time'])) ? trim($_POST['pay_time']) : '';
$total		= (isset($_POST['total'])) ? trim($_POST['total']) : '';

$bil=0;

$rst = mysqli_query($con , "SELECT * FROM `product`");
while ($dat = mysqli_fetch_array($rst) )
{
	$products[$bil] = $dat["product"];
	$amounts[$bil] = $dat["price"];
	$bil++;
}

$success = "";

if($act == "add")
{	
	$act = "";
	$order_detail = "";
	if ( isset($_SESSION["cart"]) ) {
		foreach ( $_SESSION["cart"] as $i ) {
			$order_detail .= $products[$_SESSION["cart"][$i]] . " x " .$_SESSION["qty"][$i]  . "<br>";
		}
	}
	
	$order_no = rand(10000, 99999);
	
	$SQL_insert = " 
	INSERT INTO `orders`(`id_order`, `id_customer`, `order_no`, `order_detail`, `total`, `pay_date`, `pay_time`, `pay_slip`, `status`, `remark`) 
	VALUES (NULL,'$id_customer','$order_no','$order_detail','$total','$pay_date','$pay_time','','Pending' , '') ";
								
	$result = mysqli_query($con, $SQL_insert);
	
	$id_order = mysqli_insert_id($con);
	
	// -------- Photo -----------------
	if(isset($_FILES['pay_slip'])){
		if($_FILES["pay_slip"]["error"] == 4) {
				//means there is no file uploaded
		} else { 

			$file_name = $_FILES['pay_slip']['name'];
			$file_size = $_FILES['pay_slip']['size'];
			$file_tmp = $_FILES['pay_slip']['tmp_name'];
			$file_type = $_FILES['pay_slip']['type'];

			$fileNameCmps = explode(".", $file_name);
			$file_ext = strtolower(end($fileNameCmps));
			$new_file	= rand() . "." . $file_ext;

			if(empty($errors)==true) {
				move_uploaded_file($file_tmp,"pay_slip/".$new_file);
			 
				$query = "UPDATE `orders` SET `pay_slip`='$new_file' WHERE `id_order` = '$id_order'";			
				$result = mysqli_query($con, $query) or die("Error in query: ".$query."<br />".mysqli_error($con));
			}else{
				print_r($errors);
			}  
		  
		}
	}
	// -------- End Photo -----------------

	$success = "Successfully Paid";
	
	print "<script>self.location='buy-completed.php?order_no=".$order_no."';</script>";
}
?>