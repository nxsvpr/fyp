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
$id_order	= (isset($_REQUEST['id_order'])) ? trim($_REQUEST['id_order']) : '0';
$act 		= (isset($_REQUEST['act'])) ? trim($_REQUEST['act']) : '';	

$status		= (isset($_POST['status'])) ? trim($_POST['status']) : '';
$remark		= (isset($_POST['remark'])) ? trim($_POST['remark']) : 'Your order is received, shipping no is ';

$success = "";


if($act == "edit")
{	
	$SQL_update = " UPDATE `orders` SET `status` = '$status', `remark` = '$remark'  WHERE `id_order` =  '$id_order'";	
										
	$result = mysqli_query($con, $SQL_update) or die("Error in query: ".$SQL_update."<br />".mysqli_error($con));
		
	$success = "Successfully Update";
	//print "<script>alert('Successfully Update'); self.location='a-order.php';</script>";
}

if($act == "del")
{
	$SQL_delete = " DELETE FROM `orders` WHERE `id_order` =  '$id_order' ";
	$result = mysqli_query($con, $SQL_delete);
	
	$success = "Successfully Delete";
	//print "<script>self.location='a-order.php';</script>";
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

<link href="css/table.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Poppins", sans-serif}

body, html {
  height: 100%;
  line-height: 1.8;
}

a:link {
  text-decoration: none;
}

.w3-beige {background-color: rgba(237, 205, 172, 100); }

.w3-bar .w3-button {
  padding: 16px;
}
</style>

<body class="w3-light-gray">

<?PHP include("menu-top-admin.php");?>

<div class="" >

<div class="w3-padding-16"></div>

<!--- Toast Notification -->
<?PHP 
if($success) { Notify("success", $success, "a-order.php"); }
?>	

<div class="" >

	
	<div class=" w3-center w3-text-blank w3-padding-32">
		<span class="w3-xlarge"><b>ORDER LIST</b></span><br>
	</div>


	<!-- Page Container -->
	<div class="w3-container w3-content" style="max-width:1400px;">    
	  <!-- The Grid -->
	  <div class="w3-row w3-white w3-card w3-padding">
	  		
		<div class="w3-row w3-margin ">
		<div class="table-responsive">
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>#</th>
					<th>Pay Date</th>
					<th>Pay Slip</th>
					<th>Customer</th>
					<th>Order No</th>
					<th>Order Detail</th>
					<th>Total (RM)</th>
					<th>Status</th>
					<th>Remark</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?PHP
			$bil = 0;
			$SQL_list = "SELECT * FROM `orders`,`customer` WHERE orders.id_customer = customer.id_customer ";
			$result = mysqli_query($con, $SQL_list) ;
			while ( $data	= mysqli_fetch_array($result) )
			{
				$bil++;
				$pay_slip	= $data["pay_slip"];
				if(!$pay_slip) $pay_slip = "noimage.jpg";
				$id_order	= $data["id_order"];
			?>			
			<tr>
				<td><?PHP echo $bil ;?></td>
				<td><?PHP echo $data["pay_date"];?><br><?PHP echo $data["pay_time"];?></td>
				<td><a target="_blank" href="pay_slip/<?PHP echo $pay_slip; ?>"><img src="pay_slip/<?PHP echo $pay_slip; ?>" class="w3-round-large w3-image" alt="image" style="width:100%;max-width:60px"></a></td>
				<td>
				<?PHP 
					echo  
					$data['name'] . "<br>" .
					$data['phone'] . "<br>" .
					$data['email'] . "<br>" .
					$data['address'] . "<br>";
				?>
				</td>
				<td><?PHP echo $data["order_no"];?></td>
				<td><?PHP echo $data["order_detail"];?></td>
				<td><?PHP echo $data["total"];?></td>
				<td><?PHP echo $data["status"];?></td>
				<td><?PHP echo $data["remark"];?></td>
				<td>
				<a href="#" onclick="document.getElementById('idEdit<?PHP echo $bil;?>').style.display='block'" class=""><i class="fa fa-fw fa-edit fa-lg"></i></a>
				
				<a title="Delete" onclick="document.getElementById('idDelete<?PHP echo $bil;?>').style.display='block'" class="w3-text-<?PHP echo $theme;?>"><i class="fa fa-fw fa-trash fa-lg"></i></a>
				</td>
			</tr>
			
<div id="idEdit<?PHP echo $bil; ?>" class="w3-modal" style="z-index:10;">
	<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:600px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('idEdit<?PHP echo $bil; ?>').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>

		<div class="w3-container w3-padding">
		
		<form action="" method="post" >
			<div class="w3-padding"></div>
			<b class="w3-large">Update</b>
			<hr>
	
				<div class="w3-section " >
					<label>Status *</label>
					<select class="w3-input w3-border w3-round" name="status" required>
						<option value="Pending" <?PHP if($data["status"] == "Pending") echo "selected";?> >Pending</option>
						<option value="Paid" <?PHP if($data["status"] == "Paid") echo "selected";?> >Paid</option>
						<option value="Unpaid" <?PHP if($data["status"] == "Unpaid") echo "selected";?> >Unpaid</option>
						<option value="Preparing" <?PHP if($data["status"] == "Preparing") echo "selected";?> >Preparing</option>
						<option value="Delivered" <?PHP if($data["status"] == "Delivered") echo "selected";?> >Delivered</option>
						<option value="Refund" <?PHP if($data["status"] == "Refund") echo "selected";?> >Refund</option>
						<option value="Cancel" <?PHP if($data["status"] == "Cancel") echo "selected";?> >Cancel</option>
					</select>
				</div>
				
				<div class="w3-section " >
					Remark
					<textarea class="w3-input w3-border w3-round" rows="2" name="remark" placeholder="Tracking no"><?PHP echo $data["remark"];?></textarea>
				</div>
			  
			<hr class="w3-clear">
			<input type="hidden" name="id_order" value="<?PHP echo $data["id_order"];?>" >
			<input type="hidden" name="act" value="edit" >
			<button type="submit" class="w3-button w3-black w3-text-white w3-margin-bottom w3-round">SAVE CHANGES</button>

		</form>
		</div>
	</div>
<div class="w3-padding-24"></div>
</div>

<div id="idDelete<?PHP echo $bil; ?>" class="w3-modal" style="z-index:10;">
	<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('idDelete<?PHP echo $bil; ?>').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>

		<div class="w3-container w3-padding">
		
		<form action="" method="post">
			<div class="w3-padding"></div>
			<b class="w3-large">Confirmation</b>
			  
			<hr class="w3-clear">			
			Are you sure to delete this record ?
			<div class="w3-padding-16"></div>
			
			<input type="hidden" name="id_order" value="<?PHP echo $data["id_order"];?>" >
			<input type="hidden" name="act" value="del" >
			<button type="button" onclick="document.getElementById('idDelete<?PHP echo $bil; ?>').style.display='none'"  class="w3-button w3-gray w3-text-white w3-margin-bottom w3-round">CANCEL</button>
			
			<button type="submit" class="w3-right w3-button w3-<?PHP echo $theme;?> w3-text-white w3-margin-bottom w3-round">YES, CONFIRM</button>
		</form>
		</div>
	</div>
</div>				
			<?PHP } ?>
			</tbody>
		</table>
		</div>
		</div>

		
	  <!-- End Grid -->
	  </div>
	  
	<!-- End Page Container -->
	</div>
	
	<div class="w3-padding-24"></div>
	
</div>



<?PHP include("footer.php");?>	


<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<!--<script src="assets/demo/datatables-demo.js"></script>-->


<script>
$(document).ready(function() {

  
	$('#dataTable').DataTable( {
		paging: true,
		
		searching: true
	} );
		
	
});
</script>

 
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
