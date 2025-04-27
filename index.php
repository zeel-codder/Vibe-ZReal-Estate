<?php
include_once "connection.php";
require_once "includes/session_check.php";

if(isset($_GET['login']) && $_GET['login'] == 'required') {
    $login_message = "Please log in to access this page.";
}

$query = "select * from properties";
$result = mysqli_query($conn, $query);

if(!$result){
	echo "Error Found: " . mysqli_error($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Real Easted - Premium Real Estate Platform</title>
<?php include 'includes/header.php'; ?>

<div>
<div class="">
            <div id="slider" class="sl-slider-wrapper">
        <div class="sl-slider">

          <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
            <div class="sl-slide-inner">
              <div class="bg-img bg-img-1" style="background-image: url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3')"></div>
              <h2><a href="#">Luxury 2 Bed Rooms and 1 Dining Room Apartment on Sale</a></h2>
              <blockquote>
              <p class="location"><span class="glyphicon glyphicon-map-marker"></span> Binalbagan, Negros Occidental</p>
              <p>Modern apartment with stunning views and premium amenities in a prime location.</p>
              <cite>₹ 20,000,000</cite>
              </blockquote>
            </div>
          </div>

          <div class="sl-slide" data-orientation="vertical" data-slice1-rotation="10" data-slice2-rotation="-15" data-slice1-scale="1.5" data-slice2-scale="1.5">
            <div class="sl-slide-inner">
              <div class="bg-img bg-img-2" style="background-image: url('https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-4.0.3')"></div>
              <h2><a href="#">Modern 3 Bed Room Villa with Pool</a></h2>
              <blockquote>
              <p class="location"><span class="glyphicon glyphicon-map-marker"></span> Himamaylan, Negros Occidental</p>
              <p>Spacious villa with private pool and garden in a quiet neighborhood.</p>
              <cite>₹ 25,000,000</cite>
              </blockquote>
            </div>
          </div>

          <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="3" data-slice2-rotation="3" data-slice1-scale="2" data-slice2-scale="1">
            <div class="sl-slide-inner">
              <div class="bg-img bg-img-3" style="background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3')"></div>
              <h2><a href="#">Contemporary Apartment in City Center</a></h2>
              <blockquote>
              <p class="location"><span class="glyphicon glyphicon-map-marker"></span> Kabankalan, Negros Occidental</p>
              <p>Stylish apartment with modern amenities in the heart of the city.</p>
              <cite>₹ 15,000,000</cite>
              </blockquote>
            </div>
          </div>

          <div class="sl-slide" data-orientation="vertical" data-slice1-rotation="-5" data-slice2-rotation="25" data-slice1-scale="2" data-slice2-scale="1">
            <div class="sl-slide-inner">
              <div class="bg-img bg-img-4" style="background-image: url('https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?ixlib=rb-4.0.3')"></div>
              <h2><a href="#">Luxury Penthouse with Sea View</a></h2>
              <blockquote>
              <p class="location"><span class="glyphicon glyphicon-map-marker"></span> Bacolod, Negros Occidental</p>
              <p>Exclusive penthouse with panoramic sea views and premium finishes.</p>
              <cite>₹ 30,000,000</cite>
              </blockquote>
            </div>
          </div>

          <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-5" data-slice2-rotation="10" data-slice1-scale="2" data-slice2-scale="1">
            <div class="sl-slide-inner">
              <div class="bg-img bg-img-5" style="background-image: url('https://images.unsplash.com/photo-1600566753376-12c8ab7fb75b?ixlib=rb-4.0.3')"></div>
              <h2><a href="#">Family Home with Garden</a></h2>
              <blockquote>
              <p class="location"><span class="glyphicon glyphicon-map-marker"></span> Hinigaran, Negros Occidental</p>
              <p>Beautiful family home with spacious garden and modern amenities.</p>
              <cite>₹ 18,000,000</cite>
              </blockquote>
            </div>
          </div>
        </div>

        <nav id="nav-dots" class="nav-dots">
          <span class="nav-dot-current"></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
        </nav>

      </div>
</div>


<div class="container">
  <div class="properties-listing spacer">
    <div class="section-header">
        <h2><i class="fas fa-star"></i> Featured Properties</h2>
        <a href="list-properties.php" class="btn btn-outline-primary viewall"><i class="fas fa-list"></i> View All Listings</a>
    </div>
    <div class="property-grid-container">
      <?php
      $count = 0;
      mysqli_data_seek($result, 0);
        while($property_result = mysqli_fetch_assoc($result) and $count < 6){
          $count++;
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
          $property_address = isset($property_result['property_address']) ? $property_result['property_address'] : '';
      ?>
        <div class="property-card-wrapper">
          <div class="properties fade-in">
            <div class="image-holder">
                <img src="<?php echo $property_img; ?>" class="img-responsive" alt="properties">
            </div>
            <div class="property-info">
                <h4><a href="property-detail.php?id=<?php echo $id; ?>"><?php echo $property_title; ?></a></h4>
                <?php if(!empty($property_address)): ?>
                <p class="location"><i class="fas fa-map-marker-alt"></i> <?php echo $property_address; ?></p>
                <?php endif; ?>
                <p class="price"><i class="fas fa-tag"></i> ₹<?php echo number_format($price); ?></p>
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
  <div class="spacer">
    <div class="row">
      <div class="col-lg-12 col-sm-12">
        <div class="about-section">
            <h3 class="section-title">About Us</h3>
            <p>At our Real Estate agency, you are number one. Whether you are a property owner, tenant, or buyer, we value your business and will provide you with the individual attention and service you deserve. We believe in a strict Code of Ethics. We believe in integrity, commitment to excellence, a professional attitude, and personalized care.</p>
            <p>With years of experience in the real estate market, our team of dedicated professionals is committed to helping you find the perfect property that meets your requirements and budget. We understand that buying or selling a property is a significant decision, and we are here to guide you through every step of the process.</p>
            <a href="about.php" class="btn btn-primary"><i class="fas fa-info-circle"></i> Learn More</a>
        </div>
      </div>
    </div>
  </div>
</div>



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
                <li><a href="contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
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
        <p>&copy; 2025 Real Estate Website. All rights reserved.</p>
    </div>
</footer>



<div id="loginpop" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fas fa-user"></i> Welcome Back</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 login">
                        <h4><i class="fas fa-sign-in-alt"></i> Login</h4>
                        <form action="login.php" method="post">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-envelope"></i></span>
                                    <input type="email" name="email" class="form-control" placeholder="Email address" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                            </div>
                          
                            <button type="submit" class="btn btn-success btn-block"><i class="fas fa-sign-in-alt"></i> Sign in</button>
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <h4><i class="fas fa-user-plus"></i> New User?</h4>
                        <p>Join today and get updated with all the properties deal happening around.</p>
                        <button type="button" class="btn btn-info btn-block" onclick="window.location.href='register.php'">
                            <i class="fas fa-user-plus"></i> Create Account
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  
  $("#owl-example").owlCarousel({
    items: 3,
    itemsDesktop: [1199, 3],
    itemsDesktopSmall: [979, 2],
    itemsTablet: [768, 2],
    itemsMobile: [479, 1],
    navigation: true,
    pagination: false,
    navigationText: ["<i class='fas fa-chevron-left'></i>","<i class='fas fa-chevron-right'></i>"],
    autoPlay: false,
    slideSpeed: 600,
    paginationSpeed: 400,
    autoHeight: false,
    itemsScaleUp: true,
    mouseDrag: true,
    touchDrag: true,
    responsiveBaseWidth: window
  });
  
  $('.properties').each(function() {
    var propertyType = $(this).find('.property-info h4 a').text().toLowerCase();
    
    if(propertyType.includes('apartment')) {
      $(this).append('<div class="property-label">Apartment</div>');
    } else if(propertyType.includes('villa')) {
      $(this).append('<div class="property-label">Villa</div>');
    } else if(propertyType.includes('house')) {
      $(this).append('<div class="property-label">House</div>');
    } else if(propertyType.includes('penthouse')) {
      $(this).append('<div class="property-label">Penthouse</div>');
    }
  });

  <?php if(isset($login_message)): ?>
    showNotification('<?php echo $login_message; ?>', 'error');
    $('#loginpop').modal('show');
  <?php endif; ?>
});

function showNotification(message, type = 'error') {
  const existingNotification = document.querySelector('.custom-notification');
  if (existingNotification) {
      existingNotification.remove();
  }

  const notification = document.createElement('div');
  notification.className = `custom-notification ${type}`;
  notification.innerHTML = `
      <div class="notification-content">
          <span class="notification-icon">
              ${type === 'success' ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-exclamation-circle"></i>'}
          </span>
          <span class="notification-message">${message}</span>
          <span class="notification-close"><i class="fas fa-times"></i></span>
      </div>
  `;
  
  document.body.appendChild(notification);
  
  notification.querySelector('.notification-close').addEventListener('click', function() {
      notification.remove();
  });
  
  if (type === 'success') {
      setTimeout(() => {
          notification.classList.add('notification-hide');
          setTimeout(() => notification.remove(), 500);
      }, 5000);
  }
}
</script>

</body>
</html>
