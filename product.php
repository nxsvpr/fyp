<?PHP
session_start();
require_once("database.php");
?>
<?PHP
$search		= (isset($_REQUEST['search'])) ? trim($_REQUEST['search']) : '';
$category	= (isset($_REQUEST['category'])) ? trim($_REQUEST['category']) : '';

$SQL_carian = "";
if($search) $SQL_carian = "AND `product` LIKE '%$search%' ";

$SQL_kategori = "";
if($category) $SQL_kategori = "AND `category` = '$category' ";
?>
<!DOCTYPE html>
<html>
<title><?PHP echo $SHOP_NAME;?></title>
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


<div class="" >

	<div class="w3-container w3-padding" id="contact">
		<div class="w3-content w3-container " style="max-width:1200px">

			<div class="w3-center">
			<div class="w3-xxlarge"><b>OUR PRODUCTS</b></div>
			Indulge in Delicious Delights: Explore Our Mouthwatering Creations!
			</div>
			<div class="w3-padding-16"></div>
			
			<div class="w3-row w3-center w3-margin">
				<form action="product.php" method="get" class="w3-center">
					<div class="w3-col m6 w3-padding" >
						<input class="w3-input w3-border w3-round-large" type="text" name="search" value="<?PHP echo $search;?>" placeholder="Search item..." >
					</div>
					
					<div class="w3-col m3 w3-padding" >
						<select class="w3-padding w3-block w3-border w3-round-large" name="category" >
							<option value="" class="w3-text-merah">All Category</option>
						<?PHP 
						$rst = mysqli_query($con , "SELECT * FROM `category`");
						while ($dat = mysqli_fetch_array($rst) )
						{
						?>
							<option value="<?PHP echo $dat["category"];?>" <?PHP if($category == $dat["category"]) echo "selected";?>><?PHP echo $dat["category"];?></option>
						<?PHP } ?>
						</select>
					</div>
					
					<div class="w3-col m3 w3-padding" >
						<button type="submit" class="w3-button w3-block w3-<?PHP echo $theme;?> w3-text-white w3-margin-bottom w3-round">SEARCH <i class="fa fa-fw fa-search"></i></button>
					</div>
				</form>
			</div>
			
			<div class="w3-row">
				
				<?PHP
				$bil = 0;
				
				$SQL_list = "SELECT * FROM `product` WHERE 1 $SQL_carian $SQL_kategori ";
				$result = mysqli_query($con, $SQL_list) ;
				while ( $data	= mysqli_fetch_array($result) )
				{
					$bil++;
					$photo	= $data["photo"];
					if(!$photo) $photo = "noimage.jpg";
					$id_product= $data["id_product"];
					$product= $data["product"];
				?>	
			
				<div class="w3-col m3 w3-center ">
					<a href="item-detail.php?id_product=<?PHP echo $id_product;?>">
					<div class="w3-padding">
						<div class="w3-card w3-white w3-round-large w3-hover-light-gray">
							<div class=""></div>
							<img src="upload/<?PHP echo $photo; ?>" class="w3-image  w3-round-large">

							<div class="w3-padding-16"><b class="w3-medium"><?PHP echo substrwords($product, 30,'...'); ?></b><br>
							<div class="w3-tag w3-<?PHP echo $theme;?>"><?PHP echo $data["category"]; ?></div>
							</div>
						</div>
					</div>
					</a>
				</div>
				
				<?PHP } ?>
				
				
			</div>
		  
		</div>	
		
	</div>


<div class="w3-padding-32"></div>	
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