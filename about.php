<?php

session_start();
include_once "connection.php";
require_once "includes/session_check.php";

requireLogin();

?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>About us - Real Easted</title>
<?php include 'includes/header.php'; ?>

<div class="inside-banner">
  <div class="container">
    <h2 class="text-center">About Us</h2>
    <p class="text-center text-light">Learn about Real Easted and our premium services</p>
  </div>
</div>

<div class="container">
<div class="spacer">
<div class="row">
  <div class="col-lg-8">
    <div class="about-info">
      <h3>Welcome to Real Easted</h3>
      <p>Real Easted stands as your premier destination for all real estate needs, distinguishing itself through a team of dedicated professionals committed to making your property journey seamless and satisfying.</p>
      
      <div class="about-section">
        <h4><i class="fas fa-history"></i> Our Story</h4>
        <p>Founded in 2010, Real Easted began with a simple mission: to transform the complex process of buying, selling, and renting properties into a seamless experience. What started as a small team of passionate real estate enthusiasts has now grown into a network of professionals serving multiple regions.</p>
        
        <p>Over the years, we have helped thousands of clients find their dream homes, sell properties at optimal prices, and make sound investment decisions. Our growth is a testament to our unwavering commitment to client satisfaction and professional excellence.</p>
      </div>
      
      <div class="about-section">
        <h4><i class="fas fa-star"></i> Our Mission</h4>
        <p>At Real Easted, we are driven by our mission to empower people to make confident real estate decisions. We believe that everyone deserves a place they can call home, and we work tirelessly to match our clients with properties that align with their lifestyles, preferences, and financial goals.</p>
        
        <p>We strive to be more than just a real estate agency – we aim to be your trusted advisor throughout your property journey, providing personalized guidance, market insights, and exceptional service every step of the way.</p>
      </div>
      
      <div class="about-section">
        <h4><i class="fas fa-handshake"></i> Our Values</h4>
        <ul>
          <li><strong>Integrity:</strong> We conduct our business with honesty and transparency, ensuring that our clients' interests are always prioritized.</li>
          <li><strong>Excellence:</strong> We are committed to delivering exceptional service and continuously improving our processes and offerings.</li>
          <li><strong>Client-Centricity:</strong> We place our clients at the heart of everything we do, tailoring our services to meet their unique needs.</li>
          <li><strong>Innovation:</strong> We leverage technology and stay updated with market trends to provide cutting-edge solutions.</li>
          <li><strong>Community:</strong> We believe in giving back to the communities we operate in and contributing to their growth and development.</li>
        </ul>
      </div>
    </div>
  </div>
  
  <div class="col-lg-4">
    <div class="panel panel-default sidebar">
      <div class="panel-heading">
        <h4><i class="fas fa-users"></i> Our Team</h4>
      </div>
      <div class="panel-body">
        <div class="team-member">
          <img src="https://randomuser.me/api/portraits/men/44.jpg" alt="John Smith" class="img-circle">
          <h5>John Smith</h5>
          <p class="text-muted">Chief Executive Officer</p>
          <p>With over 20 years in real estate, John brings unparalleled expertise to our leadership.</p>
        </div>
        
        <div class="team-member">
          <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Sarah Johnson" class="img-circle">
          <h5>Sarah Johnson</h5>
          <p class="text-muted">Head of Sales</p>
          <p>Sarah's negotiation skills and market knowledge drive exceptional results for our clients.</p>
        </div>
        
        <div class="team-member">
          <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Michael Chen" class="img-circle">
          <h5>Michael Chen</h5>
          <p class="text-muted">Property Consultant</p>
          <p>Michael specializes in luxury properties and investment opportunities.</p>
        </div>
      </div>
    </div>
    
    <div class="panel panel-default sidebar">
      <div class="panel-heading">
        <h4><i class="fas fa-certificate"></i> Our Achievements</h4>
      </div>
      <div class="panel-body">
        <ul class="list-unstyled achievement-list">
          <li><i class="fas fa-trophy"></i> Best Real Estate Agency 2023</li>
          <li><i class="fas fa-award"></i> Excellence in Customer Service 2022</li>
          <li><i class="fas fa-medal"></i> Top Selling Agency 2021</li>
          <li><i class="fas fa-certificate"></i> Innovative Property Solutions 2020</li>
        </ul>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<?php include 'includes/footer.php'; ?>

<script>
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