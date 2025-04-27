<?php
include_once "connection.php";
require_once "includes/session_check.php";

// Require login to access property listings
requireLogin();

$query = "select * from properties";
$result = mysqli_query($conn, $query);

if(!$result){
	echo "Error Found!!!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>List Properties - Real Estate Management System</title>
<?php include 'includes/header.php'; ?>

<div class="inside-banner">
  <div class="container">
    <h2 class="text-center">All Properties</h2>
    <p class="text-center text-light">Browse our collection of premium properties</p>
  </div>
</div>

<div class="container">
<div class="properties-listing spacer">

<div class="row">
<div class="col-lg-3 col-sm-4 ">

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
              <select name="search_price" class="form-control">
                <option>Price</option>
                <option value="1">$5000 - $50,000</option>
                <option value="2">$50,000 - $100,000</option>
                <option value="3">$100,000 - $200,000</option>
                <option value="4">$200,000 - above</option>
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

</div>

<div class="col-lg-9 col-sm-8">
<div class="sortby clearfix mb-4">
  <div class="row">
    <div class="col-md-6">
      <div class="result"><i class="fas fa-list"></i> Showing: All Properties</div>
    </div>
  </div>
</div>

<div class="property-grid-container">
  <!-- properties -->
  <?php
    while($property_result = mysqli_fetch_assoc($result)){
      $id = $property_result['property_id'];
      $property_title = $property_result['property_title'];
      $delivery_type = $property_result['delivery_type'];
      $availablility = $property_result['availablility'];
      $price = $property_result['price'];
      $property_img = $property_result['property_img'];
      $bed_room = $property_result['bed_room'];
      $liv_room = $property_result['liv_room'];
      $parking = $property_result['parking'];
      $kitchen = $property_result['kitchen'];
      $utility = $property_result['utility'];
      $property_address = $property_result['property_address'];
  ?>
    <div class="property-card-wrapper">
      <div class="properties fade-in">
        <div class="image-holder">
          <img src="<?php echo $property_img; ?>" class="img-responsive" alt="properties">
        </div>
        <div class="property-info">
          <h4><a href="property-detail.php?id=<?php echo $id; ?>"><?php echo $property_title; ?></a></h4>
          <p class="price"><i class="fas fa-tag"></i> ₹<?php echo number_format($price); ?></p>
          <p class="location"><i class="fas fa-map-marker-alt"></i> <?php echo $property_address; ?></p>
          <div class="listing-detail">
              <div>
                <span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room"><i class="fas fa-bed"></i></span>
                <div><?php echo $bed_room; ?></div>
              </div>
              <div>
                <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room"><i class="fas fa-couch"></i></span>
                <div><?php echo $liv_room; ?></div>
              </div>
              <div>
                <span data-toggle="tooltip" data-placement="bottom" data-original-title="Parking"><i class="fas fa-car"></i></span>
                <div><?php echo $parking; ?></div>
              </div>
              <div>
                <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen"><i class="fas fa-utensils"></i></span>
                <div><?php echo $kitchen; ?></div>
              </div>
          </div>
          <div class="btn-container">
            <a class="btn btn-primary" href="property-detail.php?id=<?php echo $id; ?>"><i class="fas fa-info-circle"></i> View Details</a>
          </div>
        </div>
        <?php
          $propertyTypeLabel = "";
          if(stripos($property_title, "apartment") !== false) {
              $propertyTypeLabel = "Apartment";
          } elseif(stripos($property_title, "villa") !== false) {
              $propertyTypeLabel = "Villa";
          } elseif(stripos($property_title, "house") !== false) {
              $propertyTypeLabel = "House";
          } elseif(stripos($property_title, "penthouse") !== false) {
              $propertyTypeLabel = "Penthouse";
          } elseif(stripos($property_title, "office") !== false) {
              $propertyTypeLabel = "Office";
          }
          
          if(!empty($propertyTypeLabel)) {
              echo '<div class="property-label">' . $propertyTypeLabel . '</div>';
          }
        ?>
      </div>
    </div>
  <?php } ?>
</div>
</div>
</div>
</div>
</div>

<div style="background-color: #0BE0FD">

<div class="container">

<div class="row">
            <div class="col-lg-3 col-sm-3">
                   <h4>Information</h4>
                   <ul class="row">
                <li class="col-lg-12 col-sm-12 col-xs-3"><a href="index.php">Home</a></li>
                <li class="col-lg-12 col-sm-12 col-xs-3"><a href="about.html">About</a></li>
                <li class="col-lg-12 col-sm-12 col-xs-3"><a href="contact.html">Contact</a></li>
              </ul>
            </div>

            <div class="col-lg-3 col-sm-3">
                    <h4>Newsletter</h4>
                    <p>Get notified about the latest properties in our marketplace.</p>
                    <form class="form-inline" role="form">
                            <input type="text" placeholder="Enter Your email address" class="form-control">
                                <button class="btn btn-success" type="button">Notify Me!</button></form>
            </div>

            <div class="col-lg-3 col-sm-3">
                    <h4>Follow us</h4>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
            </div>

             <div class="col-lg-3 col-sm-3">
                    <h4>Contact us</h4>
                    <p><b>IT SOURCECODE</b><br>
<span class="glyphicon glyphicon-map-marker"></span>Brgy. Enclaro , Binalbagan Negros Occidental Philippines<br>
<span class="glyphicon glyphicon-envelope"></span>www.itsourcecode.com<br>
<span class="glyphicon glyphicon-earphone"></span> +639272777334</p>
            </div>
        </div>
<p class="copyright">Copyright 2021. All rights reserved. </p>

</div></div>

<!-- Modal -->
<div id="loginpop" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="row">
        <div class="col-sm-6 login">
        <h4>Login</h4>
          <form action="login.php" method="post">
        <div class="form-group">
          <label class="sr-only" for="email">Email address</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label class="sr-only" for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox"> Remember me
          </label>
        </div>
        <button type="submit" class="btn btn-success">Sign in</button>
      </form>
        </div>
        <div class="col-sm-6">
          <h4>New User Sign Up</h4>
          <p>Join today and get updated with all the properties deal happening around.</p>
          <button type="button" class="btn btn-info" onclick="window.location.href='register.html'">Join Now</button>
        </div>

      </div>
    </div>
  </div>
</div>
<!-- /.modal -->

<footer class="footer">
    <div class="footer-content">
        <div class="footer-section">
            <h3>About Us</h3>
            <p>We are dedicated to providing the best real estate services. Our team of experts helps you find your perfect property, whether you're looking to rent or buy.</p>
        </div>
        
        <div class="footer-section">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="rent.php"><i class="fas fa-key"></i> Rent</a></li>
                <li><a href="sale.php"><i class="fas fa-shopping-cart"></i> Buy</a></li>
                <li><a href="contact.html"><i class="fas fa-envelope"></i> Contact</a></li>
            </ul>
        </div>
        
        <div class="footer-section">
            <h3>Newsletter</h3>
            <form class="newsletter-form">
                <input type="email" placeholder="Enter your email" required>
                <button type="submit"><i class="fas fa-paper-plane"></i></button>
            </form>
        </div>
        
        <div class="footer-section">
            <h3>Contact Info</h3>
            <ul class="contact-info">
                <li><i class="fas fa-map-marker-alt"></i> 123 Real Estate Street, City</li>
                <li><i class="fas fa-phone"></i> +1 234 567 8900</li>
                <li><i class="fas fa-envelope"></i> info@realestate.com</li>
            </ul>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>&copy; 2024 Real Estate Website. All rights reserved.</p>
    </div>
</footer>

</body>

<!-- Mirrored from thebootstrapthemes.com/live/thebootstrapthemes-realestate/buysalerent.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 11 Apr 2017 02:45:10 GMT -->
</html>
