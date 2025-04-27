<?php
include_once "connection.php";
require_once "includes/session_check.php";

requireLogin();

$user_name = getUserName();
$user_email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

$agent_name = $_GET['agent'] ?? '';
$property_title = $_GET['property'] ?? '';

$pre_filled_subject = '';
$pre_filled_message = '';

if (!empty($agent_name) && !empty($property_title)) {
    $pre_filled_subject = 'Property Inquiry';
    $pre_filled_message = "Hello $agent_name,\n\nI am interested in the property: \"$property_title\". I would like to get more information about this property.\n\nPlease contact me at your earliest convenience.\n\nThank you.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    if (empty($name) || empty($email) || empty($message)) {
        $error = "Please fill in all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } else {
        $query = "INSERT INTO contact_messages (name, email, phone, subject, message, created_at) 
                 VALUES (?, ?, ?, ?, ?, NOW())";
        
        $stmt = mysqli_prepare($conn, $query);
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $phone, $subject, $message);
            
            if (mysqli_stmt_execute($stmt)) {
                $success = "Thank you for your message. We'll get back to you soon!";
                
                $name = $email = $phone = $message = $subject = "";
            } else {
                $error = "Unable to send message. Please try again later. Error: " . mysqli_error($conn);
            }
            
            mysqli_stmt_close($stmt);
        } else {
            $error = "Unable to prepare statement. Error: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Contact Us - Real Estate Management System</title>
<?php include 'includes/header.php'; ?>

<div class="inside-banner">
  <div class="container">
    <h2 class="text-center">Contact Us</h2>
    <p class="text-center text-light">Get in touch with our Real Easted team of experts</p>
  </div>
</div>

<div class="container">
<div class="spacer">
<div class="row">
  <div class="col-lg-8 col-sm-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fas fa-paper-plane"></i> Send us a Message</h3>
      </div>
      <div class="panel-body">
        <?php if (isset($error)): ?>
          <div class="alert alert-danger">
            <?php echo $error; ?>
          </div>
        <?php elseif (isset($success)): ?>
          <div class="alert alert-success">
            <?php echo $success; ?>
          </div>
        <?php endif; ?>
        <form class="contact-form" action="" method="post">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Name *</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fas fa-user"></i></span>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" value="<?php echo htmlspecialchars($name ?? $user_name); ?>" required>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="email">Email *</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fas fa-envelope"></i></span>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="<?php echo htmlspecialchars($email ?? $user_email); ?>" required>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="phone">Phone</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fas fa-phone"></i></span>
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="<?php echo htmlspecialchars($phone ?? ''); ?>">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="subject">Subject *</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fas fa-tag"></i></span>
                  <select class="form-control" id="subject" name="subject" required>
                    <option value="">Select Subject</option>
                    <option value="Property Inquiry" <?php echo (isset($subject) && $subject === 'Property Inquiry') || $pre_filled_subject === 'Property Inquiry' ? 'selected' : ''; ?>>Property Inquiry</option>
                    <option value="Price Negotiation" <?php echo (isset($subject) && $subject === 'Price Negotiation') ? 'selected' : ''; ?>>Price Negotiation</option>
                    <option value="Schedule a Visit" <?php echo (isset($subject) && $subject === 'Schedule a Visit') ? 'selected' : ''; ?>>Schedule a Visit</option>
                    <option value="Other Questions" <?php echo (isset($subject) && $subject === 'Other Questions') ? 'selected' : ''; ?>>Other Questions</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="message">Message *</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fas fa-comment"></i></span>
              <textarea class="form-control" id="message" name="message" rows="6" placeholder="Your Message" required><?php echo htmlspecialchars($message ?? $pre_filled_message); ?></textarea>
            </div>
          </div>
          <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Send Message</button>
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-4 col-sm-4">
    <div class="contact-info">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><i class="fas fa-info-circle"></i> Office Information</h3>
        </div>
        <div class="panel-body">
          <div class="info-item">
            <h4><i class="fas fa-map-marker-alt"></i> Address</h4>
            <address>
              123 Real Estate Street<br>
              Business Park, Suite 300<br>
              Metro City, ST 12345
            </address>
          </div>

          <div class="info-item">
            <h4><i class="fas fa-phone"></i> Phone Numbers</h4>
            <p><strong>Main:</strong> +1 (123) 456-7890</p>
            <p><strong>Sales:</strong> +1 (123) 456-7891</p>
            <p><strong>Support:</strong> +1 (123) 456-7892</p>
          </div>

          <div class="info-item">
            <h4><i class="fas fa-envelope"></i> Email</h4>
            <p><a href="mailto:info@realeasted.com">info@realeasted.com</a></p>
            <p><a href="mailto:sales@realeasted.com">sales@realeasted.com</a></p>
          </div>

          <div class="info-item">
            <h4><i class="far fa-clock"></i> Business Hours</h4>
            <p>Monday - Friday: 9 AM - 6 PM</p>
            <p>Saturday: 10 AM - 4 PM</p>
            <p>Sunday: Closed</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row map-section">
  <div class="col-lg-12">
    <h3 class="section-title"><i class="fas fa-map-marked-alt"></i> Our Location</h3>
    <div class="map-container">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.7236616031887!2d-73.9888197843807!3d40.74844197932799!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a662d3de71%3A0x14f56db8b5fec3ae!2sEmpire%20State%20Building!5e0!3m2!1sen!2sus!4v1619864523257!5m2!1sen!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
  </div>
</div>

</div>
</div>

<?php include 'includes/footer.php'; ?>

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>

</body>
</html>