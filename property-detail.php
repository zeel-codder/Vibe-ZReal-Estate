<?php
include_once "connection.php";
require_once "includes/session_check.php";

requireLogin();

$pageid = $_GET['id'];

$query = "select * from properties where property_id = '$pageid'";
$result = mysqli_query($conn, $query);

if(!$result){
	echo "Error Found!!!";
}

while($property_result = mysqli_fetch_assoc($result)){
			$property_title = $property_result['property_title'];
			$property_details = $property_result['property_details'];
			$delivery_type = $property_result['delivery_type'];
			$availablility = $property_result['availablility'];
			$price = $property_result['price'];
			$property_address = $property_result['property_address'];
			$property_img = $property_result['property_img'];
			$bed_room = $property_result['bed_room'];
			$liv_room = $property_result['liv_room'];
			$parking = $property_result['parking'];
			$kitchen = $property_result['kitchen'];
			$utility = $property_result['utility'];
			$property_type = $property_result['property_type'];
			$floor_space = $property_result['floor_space'];

			$agent_name = $property_result['agent_name'];
			$agent_address = $property_result['agent_address'];
			$agent_contact = $property_result['agent_contact'];
			$agent_email = $property_result['agent_email'];
}

$imgquery = "select * from property_image where property_id = '$pageid'";
$imgresult = mysqli_query($conn, $imgquery);

if(!$imgresult){
	echo "Error Found!!!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $property_title; ?> - Real Estate Management System</title>
<?php include 'includes/header.php'; ?>

<div class="inside-banner">
  <div class="container">
    <h2 class="text-center">Property Details</h2>
    <p class="text-center text-light">View complete information about this property</p>
  </div>
</div>

<div class="container">
<div class="properties-listing spacer">

<div class="row">
<div class="col-lg-3 col-sm-4 hidden-xs">

<div class="search-form"><h4><span class="glyphicon glyphicon-search"></span> Search for</h4>
  <form action="search.php" method="post" name="search">
    <input type="text" class="form-control" name="search" placeholder="Search of Properties">
    <div class="row">
            <div class="col-lg-5">
              <select name="delivery_type" class="form-control">
                <option value="Rent">Rent</option>
                <option value="Sale">Sale</option>
              </select>
            </div>
            <div class="col-lg-7">
              <select name="price" class="form-control">
                <option value="">Select Price</option>
                <option value="below-100k">Below ₹100,000</option>
                <option value="100k-200k">₹100,000 - ₹200,000</option>
                <option value="200k-500k">₹200,000 - ₹500,000</option>
                <option value="above-500k">Above ₹500,000</option>
              </select>
            </div>
          </div>

          <div class="row">
          <div class="col-lg-12">
              <select name="property_type" class="form-control">
                <option>Property Type</option>
                <option value="Apartment">Apartment</option>
                <option value="Building">Building</option>
                <option value="Office-Space">Office-Space</option>
              </select>
              </div>
          </div>
          <button name="submit" class="btn btn-primary">Find Now</button>
</form>
  </div>

  <div class="hot-properties hidden-xs">
<h4 class="section-title">Similar Properties</h4>
<?php
$query = "select * from properties where delivery_type = 'Sale' and property_id != '$pageid' limit 5";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_assoc($result)){
$id = $row['property_id'];
$property_title = $row['property_title'];
$delivery_type = $row['delivery_type'];
$availablility = $row['availablility'];
$price = $row['price'];
$property_img = $row['property_img'];
$bed_room = $row['bed_room'];
$liv_room = $row['liv_room'];
$parking = $row['parking'];
$kitchen = $row['kitchen'];
$utility = $row['utility'];
?>
<div class="similar-property mb-3">
                <div class="row">
                    <div class="col-lg-4 col-sm-5">
                        <div class="similar-property-img">
                            <img src="<?php echo $property_img; ?>" class="img-responsive img-thumbnail" alt="properties"/>
                        </div>
                    </div>
                    <div class="col-lg-8 col-sm-7">
                        <h5><a href="property-detail.php?id=<?php echo $id; ?>"><?php echo $property_title; ?></a></h5>
                        <p class="property-price">₹<?php echo number_format($price); ?></p>
                    </div>
                </div>
</div>
<?php } ?>

</div>

</div>

<div class="col-lg-9 col-sm-8">
<div class="property-detail-header mb-4 p-3 bg-white rounded shadow-sm">
    <h2 class="property-title mb-3"><?php echo $property_title; ?></h2>
  
</div>

<div class="row">
  <div class="col-lg-8">
  <div class="property-images mb-4 bg-white rounded shadow-sm p-2">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators hidden-xs">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <?php 
        $i = 1;
        $img_count = mysqli_num_rows($imgresult);
        while($i <= $img_count) {
          echo '<li data-target="#myCarousel" data-slide-to="'.$i.'" class=""></li>';
          $i++;
        }
        ?>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
          <img src="<?php echo $property_img; ?>" class="properties img-responsive w-100" alt="properties" />
        </div>
        <?php
			while($imageresult = mysqli_fetch_assoc($imgresult)){
				$image = $imageresult['property_images'];

		?>
        <div class="item">
          <img src="<?php echo $image; ?>" class="properties img-responsive" alt="properties" />
        </div>
        <?php } ?>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div>

  </div>

  <div class="property-section mb-4 bg-white p-3 rounded shadow-sm">
    <h4 class="section-title border-bottom pb-2 mb-3"><i class="fas fa-info-circle"></i> Property Details</h4>
    <div class="property-description">
        <p><?php echo $property_details; ?></p>
        
        <div class="row property-specs mt-4">
            <div class="col-md-6">
                <div class="specs-item mb-3">
                    <i class="fas fa-building text-primary mr-2"></i> 
                    <span class="specs-label">Property Type:</span> 
                    <span class="specs-value"><?php echo $property_type; ?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="specs-item mb-3">
                    <i class="fas fa-ruler-combined text-primary mr-2"></i> 
                    <span class="specs-label">Floor Space:</span> 
                    <span class="specs-value"><?php echo $floor_space; ?> sqft</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="specs-item mb-3">
                    <i class="fas fa-bolt text-primary mr-2"></i> 
                    <span class="specs-label">Utilities:</span> 
                    <span class="specs-value"><?php echo $utility; ?></span>
                </div>
            </div>
        </div>
        
        <div class="property-features-list mt-4">
            <div class="row">
                <?php if($bed_room > 0): ?>
                <div class="col-6 col-md-3 mb-3">
                    <div class="feature-box text-center p-2 rounded bg-light">
                        <i class="fas fa-bed text-primary mb-2"></i>
                        <h5 class="feature-count"><?php echo $bed_room; ?></h5>
                        <span class="feature-name small">Bedrooms</span>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if($liv_room > 0): ?>
                <div class="col-6 col-md-3 mb-3">
                    <div class="feature-box text-center p-2 rounded bg-light">
                        <i class="fas fa-couch text-primary mb-2"></i>
                        <h5 class="feature-count"><?php echo $liv_room; ?></h5>
                        <span class="feature-name small">Living Rooms</span>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if($parking > 0): ?>
                <div class="col-6 col-md-3 mb-3">
                    <div class="feature-box text-center p-2 rounded bg-light">
                        <i class="fas fa-car text-primary mb-2"></i>
                        <h5 class="feature-count"><?php echo $parking; ?></h5>
                        <span class="feature-name small">Parking</span>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if($kitchen > 0): ?>
                <div class="col-6 col-md-3 mb-3">
                    <div class="feature-box text-center p-2 rounded bg-light">
                        <i class="fas fa-utensils text-primary mb-2"></i>
                        <h5 class="feature-count"><?php echo $kitchen; ?></h5>
                        <span class="feature-name small">Kitchens</span>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="property-section mb-4 bg-white p-3 rounded shadow-sm">
    <h4 class="section-title border-bottom pb-2 mb-3"><i class="fas fa-map-marked-alt"></i> Location</h4>
    <div class="property-map">
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo urlencode($property_address); ?>&output=embed"></iframe>
        </div>
    </div>
</div>

  </div>
  <div class="col-lg-4">
    <div class="property-sidebar">
      <div class="property-price-card bg-white p-3 rounded shadow-sm mb-4">
        <h3 class="property-price text-success font-weight-bold">₹<?php echo number_format($price); ?></h3>
        <div class="property-type-badge mb-3">
          <span class="badge badge-pill <?php echo ($delivery_type == 'Sale') ? 'badge-primary' : 'badge-info'; ?> py-2 px-3"><?php echo $delivery_type; ?></span>
          <span class="badge badge-pill <?php echo ($availablility == 0) ? 'badge-success' : 'badge-danger'; ?> py-2 px-3">
            <?php echo ($availablility == 0) ? 'Available' : 'Not Available'; ?>
          </span>
        </div>
       
      </div>
      
      <div class="property-features-card bg-white p-3 rounded shadow-sm mb-4">
        <h4 class="sidebar-title border-bottom pb-2 mb-3"><i class="fas fa-home text-primary"></i> Property Features</h4>
        <ul class="property-features-list list-unstyled">
          <?php if($bed_room > 0): ?>
          <li class="d-flex align-items-center mb-2 pb-2 border-bottom">
            <i class="fas fa-bed text-primary mr-3"></i> 
            <strong class="ml-2"><?php echo $bed_room; ?></strong>
          </li>
          <?php endif; ?>
          <?php if($liv_room > 0): ?>
          <li class="d-flex align-items-center mb-2 pb-2 border-bottom">
            <i class="fas fa-couch text-primary mr-3"></i> 
            <strong class="ml-auto"><?php echo $liv_room; ?></strong>
          </li>
          <?php endif; ?>
          <?php if($parking > 0): ?>
          <li class="d-flex align-items-center mb-2 pb-2 border-bottom">
            <i class="fas fa-car text-primary mr-3"></i> 
            <strong class="ml-auto"><?php echo $parking; ?></strong>
          </li>
          <?php endif; ?>
          <?php if($kitchen > 0): ?>
          <li class="d-flex align-items-center mb-2 pb-2">
            <i class="fas fa-utensils text-primary mr-3"></i>
            <strong class="ml-auto"><?php echo $kitchen; ?></strong>
          </li>
          <?php endif; ?>
        </ul>
      </div>
      
      <div class="agent-card bg-white p-3 rounded shadow-sm mb-4">
        <h4 class="sidebar-title border-bottom pb-2 mb-3"><i class="fas fa-user text-primary"></i> Agent Details</h4>
        <div class="agent-info">
          <h5 class="agent-name font-weight-bold mb-3"><?php echo $agent_name; ?></h5>
         
          <a href="contact.php?agent=<?php echo urlencode($agent_name); ?>&property=<?php echo urlencode($property_title); ?>" class="btn btn-primary btn-block mt-3">
            <i class="fas fa-envelope mr-2"></i> Contact Agent
          </a>
        </div>
      </div>
      
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<?php include 'includes/footer.php'; ?>
<?php include 'includes/login-modal.php'; ?>

</body>
</html>
