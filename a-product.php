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
$id_product	= (isset($_REQUEST['id_product'])) ? trim($_REQUEST['id_product']) : '0';
$act 		= (isset($_REQUEST['act'])) ? trim($_REQUEST['act']) : '';	

$product	= (isset($_POST['product'])) ? trim($_POST['product']) : '';
$category	= (isset($_POST['category'])) ? trim($_POST['category']) : '';
$description= (isset($_POST['description'])) ? trim($_POST['description']) : '';
$price		= (isset($_POST['price'])) ? trim($_POST['price']) : '';

$product	=	mysqli_real_escape_string($con, $product);
$description=	mysqli_real_escape_string($con, $description);

$success = "";

if($act == "add")
{	
	$SQL_insert = " 
	INSERT INTO `product`(`id_product`, `product`, `category`, `description`, `price`,  `photo`) 
	VALUES (NULL, '$product', '$category', '$description', '$price', '')";		
										
	$result = mysqli_query($con, $SQL_insert);
	
	$id_product = mysqli_insert_id($con);
	
	// -------- Photo -----------------
	if(isset($_FILES['photo'])){
		 
		  $file_name = $_FILES['photo']['name'];
		  $file_size = $_FILES['photo']['size'];
		  $file_tmp = $_FILES['photo']['tmp_name'];
		  $file_type = $_FILES['photo']['type'];
		  
		  $fileNameCmps = explode(".", $file_name);
		  $file_ext = strtolower(end($fileNameCmps));
		  $new_file	= rand() . "." . $file_ext;
		  
		  if(empty($errors)==true) {
			 move_uploaded_file($file_tmp,"upload/".$new_file);
			 
			$query = "UPDATE `product` SET `photo`='$new_file' WHERE `id_product` = '$id_product'";			
			$result = mysqli_query($con, $query) or die("Error in query: ".$query."<br />".mysqli_error($con));
		  }else{
			 print_r($errors);
		  }  
	}
	// -------- End Photo -----------------
	
	$success = "Successfully Add";
	
	//print "<script>self.location='a-package.php';</script>";
}
if($act == "edit")
{	
	$SQL_update = " UPDATE
						`product`
					SET
						`product` = '$product',
						`category` = '$category',
						`description` = '$description',
						`price` = '$price'
					WHERE `id_product` =  '$id_product'";	
										
	$result = mysqli_query($con, $SQL_update) or die("Error in query: ".$SQL_update."<br />".mysqli_error($con));
	
	// -------- Photo -----------------
	if(isset($_FILES['photo'])){
		 
		  $file_name = $_FILES['photo']['name'];
		  $file_size = $_FILES['photo']['size'];
		  $file_tmp = $_FILES['photo']['tmp_name'];
		  $file_type = $_FILES['photo']['type'];
		  
		  $fileNameCmps = explode(".", $file_name);
		  $file_ext = strtolower(end($fileNameCmps));
		  $new_file	= rand() . "." . $file_ext;
		  
		  if(empty($errors)==true) {
			 move_uploaded_file($file_tmp,"upload/".$new_file);
			
			$query = "UPDATE `product` SET `photo`='$new_file' WHERE `id_product` = '$id_product'";		
			$result = mysqli_query($con, $query) or die("Error in query: ".$query."<br />".mysqli_error($con));
		  }else{
			 print_r($errors);
		  }  
	}
	// -------- End Photo -----------------
	
	$success = "Successfully Update";
	//print "<script>alert('Successfully Update'); self.location='a-product.php';</script>";
}

if($act == "del_photo")
{
	$dat	= mysqli_fetch_array(mysqli_query($con, "SELECT `photo` FROM `product` WHERE `id_product`= '$id_product'"));

	unlink("upload/" .$dat['photo']);

	$rst_d = mysqli_query( $con, "UPDATE `product` SET `photo`='' WHERE `id_product` = '$id_product' " );
	print "<script>self.location='a-product.php';</script>";
}

if($act == "del")
{
	$SQL_delete = " DELETE FROM `product` WHERE `id_product` =  '$id_product' ";
	$result = mysqli_query($con, $SQL_delete);
	
	$success = "Successfully Delete";
	//print "<script>self.location='a-product.php';</script>";
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

<!-- include summernote css-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- include summernote js-->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

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

<!--- Toast Notification -->
<?PHP 
if($success) { Notify("success", $success, "a-product.php"); }
?>	

<div class="" >

	
	<div class=" w3-center w3-text-blank w3-padding-32">
		<span class="w3-xlarge"><b>PRODUCT LIST</b></span><br>
	</div>


	<!-- Page Container -->
	<div class="w3-container w3-content" style="max-width:1400px;">    
	  <!-- The Grid -->
	  <div class="w3-row w3-white w3-card w3-padding">
	  
		<a onclick="document.getElementById('add01').style.display='block'; " class="w3-margin-bottom w3-right w3-button w3-black w3-round "><i class="fa fa-fw fa-lg fa-plus"></i> Add Product</a>
		
		<div class="w3-row w3-margin ">
		<div class="table-responsive">
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>#</th>
					<th>Photo</th>
					<th>Product Name</th>
					<th>Category</th>
					<th>Price(RM)</th>
					<th>Description</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?PHP
			$bil = 0;
			$SQL_list = "SELECT * FROM `product` ";
			$result = mysqli_query($con, $SQL_list) ;
			while ( $data	= mysqli_fetch_array($result) )
			{
				$bil++;
				$photo	= $data["photo"];
				if(!$photo) $photo = "noimage.jpg";
				$id_product= $data["id_product"];
				$product= $data["product"];
				$description = $data["description"];
			?>			
			<tr>
				<td><?PHP echo $bil ;?></td>
				<td><img src="upload/<?PHP echo $photo; ?>" class="w3-round-large w3-image" alt="image" style="width:100%;max-width:60px"></td>
				<td><?PHP echo $data["product"] ;?></td>
				<td><?PHP echo $data["category"] ;?></td>
				<td><?PHP echo $data["price"] ;?></td>
				<td><?PHP echo substrwords($description, 50,'...'); ?></td>
				<td>
				<a href="#" onclick="document.getElementById('idEdit<?PHP echo $bil;?>').style.display='block'" class=""><i class="fa fa-fw fa-edit fa-lg"></i></a>
				
				<a title="Delete" onclick="document.getElementById('idDelete<?PHP echo $bil;?>').style.display='block'" class="w3-text-red"><i class="fa fa-fw fa-trash fa-lg"></i></a>
				</td>
			</tr>
			
<div id="idEdit<?PHP echo $bil; ?>" class="w3-modal" style="z-index:10;">
	<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:800px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('idEdit<?PHP echo $bil; ?>').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>

		<div class="w3-container w3-padding">
		
		<form action="" method="post" enctype="multipart/form-data" >
			<div class="w3-padding"></div>
			<b class="w3-large">Update Product</b>
			<hr>

				<div class="w3-section" >
					Photo (500 x 500 pxl)<br>
					<?PHP if($data["photo"] =="") { ?>
					<div class="custom-file">
						<input type="file" class="w3-input w3-border w3-round" name="photo" id="photo" accept=".jpeg, .jpg,.png,.gif">
					</div>
					<p></p>
					<?PHP } ?>
										
					<?PHP if($data["photo"] <>"") { ?>
					<a class="w3-tag w3-green w3-round" target="_BLANK" href="upload/<?PHP echo $data["photo"]; ?>"><small>View</small></a>

					<a class="w3-tag w3-<?PHP echo $theme;?> w3-round" href="?act=del_photo&id_product=<?PHP echo $data["id_product"];?>"><small>Remove</small></a>
					
					<?PHP } else { ?><span class="w3-tag w3-round"> <small>None</small></span><?PHP } ?>
					<small>  only JPEG, JPG, PNG or GIF allowed </small>
				</div>
			  
				<div class="w3-section" >
					Category *
					<select class="w3-select w3-border w3-round w3-padding" name="category" required>
						<option value="">- Select category - </option>
					<?PHP 
					$rst = mysqli_query($con , "SELECT * FROM `category`");
					while ($dat = mysqli_fetch_array($rst) )
					{
					?>
						<option value="<?PHP echo $dat["category"];?>" <?PHP if($data["category"] == $dat["category"]) echo "selected";?>><?PHP echo $dat["category"];?></option>
					<?PHP } ?>
					</select>
				</div>
				
				<div class="w3-section" >
					Product Name *
					<input class="w3-input w3-border w3-round" type="text" name="product" value="<?PHP echo $data["product"]; ?>" required>
				</div>

				<div class="w3-row">
					
					<div class="w3-col s6" >
						Price (RM) *
						<input class="w3-input w3-border w3-round" type="text" name="price" value="<?PHP echo $data["price"]; ?>" required>
					</div>
					
				</div>
				
				<div class="w3-section" >
					Description *
					<textarea class="w3-input w3-border w3-round" name="description" id="makeMeSummernote" rows="5" required><?PHP echo $data["description"]; ?></textarea>
				</div>
				
			  
			<hr class="w3-clear">
			<input type="hidden" name="id_product" value="<?PHP echo $data["id_product"];?>" >
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
			
			<input type="hidden" name="id_product" value="<?PHP echo $data["id_product"];?>" >
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



<div id="add01" class="w3-modal" >
    <div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:800px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('add01').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>
	  
      <div class="w3-container w3-padding">
		
		<form action="" method="post" enctype="multipart/form-data" >
			<div class="w3-padding"></div>
			<b class="w3-large">Add Product</b>
			<hr>
			  
				
				<div class="w3-section" >
					Photo * (500 x 500 pxl)
					<input class="w3-input w3-border w3-round" type="file" name="photo" required >
					<small>  only JPEG, JPG, PNG or GIF allowed </small>
				</div>
				
				<div class="w3-section" >
					Category *
					<select class="w3-select w3-border w3-round w3-padding" name="category" required>
						<option value="">- Select category - </option>
					<?PHP 
					$rst = mysqli_query($con , "SELECT * FROM `category`");
					while ($dat = mysqli_fetch_array($rst) )
					{
					?>
						<option value="<?PHP echo $dat["category"];?>"><?PHP echo $dat["category"];?></option>
					<?PHP } ?>
					</select>
				</div>
				
				<div class="w3-section" >
					Product Name *
					<input class="w3-input w3-border w3-round" type="text" name="product"  required>
				</div>
				
				<div class="w3-row">
					
					<div class="w3-col s6" >
						Price (RM) *
						<input class="w3-input w3-border w3-round" type="text" name="price"  required>
					</div>

				</div>
				
				<div class="w3-section" >
					Decsription *
					<textarea class="w3-input w3-border w3-round" name="description" id="makeMeSummernote2" rows="5"  required></textarea>
				</div>
			  
			  
			  <hr class="w3-clear">
			  
			  <div class="w3-section" >
				<input name="act" type="hidden" value="add">
				<button type="submit" class="w3-button w3-black w3-text-white w3-margin-bottom w3-round">SUBMIT</button>
			  </div>
			</div>  
		</form> 
         
      </div>
<div class="w3-padding-24"></div>
</div>

<?PHP include("footer.php");?>	

<!-- Script -->
<script type="text/javascript">
	$('#makeMeSummernote,#makeMeSummernote2').summernote({
		height:200,
	});
</script>

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
