<?PHP
session_start();
require_once("database.php");
?>
<?PHP
$id_customer = (isset($_SESSION['id_customer'])) ? trim($_SESSION['id_customer']) : '0';
$id_product	= (isset($_REQUEST['id_product'])) ? trim($_REQUEST['id_product']) : '0';

$SQL_list = "SELECT * FROM `product` WHERE `id_product` = $id_product";
$result = mysqli_query($con, $SQL_list) ;
$data	= mysqli_fetch_array($result);

$photo	= $data["photo"];
if(!$photo) $photo = "noimage.jpg";


$SQL_arr = "SELECT * FROM `product` ";
$rst_arr = mysqli_query($con, $SQL_arr) ;
$i =0;
while ($dt_arr	 = mysqli_fetch_array($rst_arr))
{
	if($dt_arr["id_product"] == $id_product) $id_this = $i;
	$i++;
}


$act 		= (isset($_REQUEST['act'])) ? trim($_REQUEST['act']) : '';	
$name		= (isset($_POST['name'])) ? trim($_POST['name']) : '';
$rating		= (isset($_POST['rating'])) ? trim($_POST['rating']) : '';
$review		= (isset($_POST['review'])) ? trim($_POST['review']) : '';

$review		=	mysqli_real_escape_string($con, $review);

if($act == "addReview")
{	
	$SQL_insert = " 
	INSERT INTO `review`(`id_review`, `id_product` ,`name`, `rating`, `review`, `id_customer`, `created_date`) 
					VALUES (NULL, $id_product, '$name','$rating','$review', $id_customer, NOW()) ";
										
	$result = mysqli_query($con, $SQL_insert);
	
	//print "<script>self.location='review.php?id_agent=$id_agent';</script>";
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
  /*height: 100%;*/
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
				
				<div class="w3-col m5">
					<div class="w3-padding">
					<div class="w3-card w3-white w3-padding-16 w3-padding w3-round-large">
					<img src="upload/<?PHP echo $photo;?>" class="w3-image">
					</div>
					</div>
				</div>
				
				
				<div class="w3-col m7">
					<div class="w3-padding">
						<div class="w3-card w3-white w3-padding-16 w3-padding w3-round-large">
						<div class="w3-large"><b><?PHP echo $data["product"];?></b></div>
						<b class="w3-tag w3-<?PHP echo $theme;?>"><?PHP echo $data["category"];?></b>
						<p>Price : RM <?PHP echo $data["price"];?></b></p>
						
						<p><?PHP echo $data["description"];?></b></p>

						<?PHP if(!isset($_SESSION["id_customer"])) { ?>
							<a  onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-black w3-padding-16">ORDER NOW <i class="fa fa-fw fa-shopping-cart"></i></a>
						<?PHP } else { ?>						
							<a href="cart.php?add=<?PHP echo $id_this;?>" class="w3-button w3-black w3-padding-16">ORDER NOW <i class="fa fa-fw fa-shopping-cart"></i></a>
						<?PHP } ?>
						
						<hr>
					
						<!-- review -->
						<div class="w3-containerx w3-paddingx" id="contact">
							<div class="w3-content w3-containerx " style="max-width:800px">		
								
								<div class="w3-center w3-large"><b>REVIEWS</b></div>
								<center class="w3-animate-zoom"><hr style="width:200px"></center>
								
								<?PHP
								$SQL_list = "SELECT * FROM `review` WHERE `id_product` = $id_product";
								$result = mysqli_query($con, $SQL_list) ;
								while ( $data	= mysqli_fetch_array($result) )
								{
									$id_review	= $data["id_review"];
									$name		= $data["name"];
									$rating		= $data["rating"];
									$review		= $data["review"];
									$created_date= $data["created_date"];
								?>
								<div class="w3-round w3-border" style="width:100%">
								<div class="w3-row w3-padding">
									<div class="w3-col s12">
										<b><?PHP echo $name; ?></b><span class="w3-right w3-small"><?PHP echo $created_date; ?></span><br>
										<?PHP 
										for($i = 1; $i <=5; $i++) { 
											if($rating >= $i) echo '<i class="fa fa-star w3-text-amber"></i>';
										} ?>
										
										<div class="w3-small">
										<?PHP echo $review; ?>
										</div>
									</div>
								</div>
								</div>
								
								<div class="w3-padding"></div>

								<?PHP } ?>
								
							
							</div>
						</div>	
						<!-- review -->		

						<div class="w3-padding-16"></div>

						<?PHP if(isset($_SESSION["id_customer"])) { ?>
						<!-- review form -->
						<div class="w3-containerx" id="contact">
							<div class="w3-content w3-container w3-cardx w3-border w3-round w3-padding-16" style="max-width:800px">
							Leave a review
							
							<form action="" method="post" class="">
								<input class="w3-input w3-border w3-round" type="text" name="name" value="" placeholder="Enter your name">
								
								<textarea class="w3-input w3-border w3-round" rows="3" name="review" placeholder="Add a review here.." required></textarea>
								
								<style>
								.rate {
									float: left;
									height: 12px;
									padding: 0 0px;
								}
								.rate:not(:checked) > input {
									position:absolute;
									top:-9999px;
								}
								.rate:not(:checked) > label {
									float:right;
									width:1em;
									overflow:hidden;
									white-space:nowrap;
									cursor:pointer;
									font-size:30px;
									color:#ccc;
								}
								.rate:not(:checked) > label:before {
									content: '★ ';
								}
								.rate > input:checked ~ label {
									color: #ffc700;    
								}
								.rate:not(:checked) > label:hover,
								.rate:not(:checked) > label:hover ~ label {
									color: #deb217;  
								}
								.rate > input:checked + label:hover,
								.rate > input:checked + label:hover ~ label,
								.rate > input:checked ~ label:hover,
								.rate > input:checked ~ label:hover ~ label,
								.rate > label:hover ~ input:checked ~ label {
									color: #c59b08;
								}
								</style>
								
								<div class="rate">
									<input type="radio" id="star5" name="rating" value="5" />
									<label for="star5" title="text">5 stars</label>
									<input type="radio" id="star4" name="rating" value="4"  />
									<label for="star4" title="text">4 stars</label>
									<input type="radio" id="star3" name="rating" value="3"  />
									<label for="star3" title="text">3 stars</label>
									<input type="radio" id="star2" name="rating" value="2"  />
									<label for="star2" title="text">2 stars</label>
									<input type="radio" id="star1" name="rating" value="1"  />
									<label for="star1" title="text">1 star</label>
								</div>
								
								<div class="w3-section">
									<input name="id_product" type="hidden" value="<?PHP echo $id_product;?>">
									<input name="act" type="hidden" value="addReview">
									<button type="submit" class="w3-padding-large w3-button w3-right w3-round-large w3-black"><b>SUBMIT</b></button>		
								</div>
							</form>

							</div>
						</div>
						<!-- review form -->
						<?PHP } ?>
					
							</div>
					</div>
					
					
				</div>
				
				
			</div>
		  
		</div>
	</div>

<div class="w3-padding-48"></div>
	
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