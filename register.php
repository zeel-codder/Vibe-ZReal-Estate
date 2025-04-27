<?php
session_start();
include_once "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')) {
    header('Content-Type: application/json');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (!$name || !$email || !$password || !$confirm_password) {
        echo json_encode(['success' => false, 'message' => 'All fields are required. Please fill out all fields.']);
        exit;
    }

    if ($password !== $confirm_password) {
        echo json_encode(['success' => false, 'message' => 'Passwords do not match. Please re-enter your passwords.']);
        exit;
    }

    if (strlen($password) < 6) {
        echo json_encode(['success' => false, 'message' => 'Password must be at least 6 characters long.']);
        exit;
    }

    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) > 0) {
        echo json_encode(['success' => false, 'message' => 'Email address is already registered. Please use a different email or login.']);
        exit;
    }
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $query = "INSERT INTO users (username, email, password, created_at) VALUES (?, ?, ?, NOW())";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashed_password);
    
    if (mysqli_stmt_execute($stmt)) {
        $user_id = mysqli_insert_id($conn);
        
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $name;
        $_SESSION['email'] = $email;
        
        echo json_encode(['success' => true, 'message' => 'Registration successful! You are now logged in.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Registration failed. Please try again later. Error: ' . mysqli_error($conn)]);
    }
    
    mysqli_stmt_close($stmt);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Register - Real Estate Management System</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="description" content="Register to access our premium real estate services">

<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css" />
<link rel="stylesheet" href="assets/style.css"/>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/footer.css">
<link rel="stylesheet" href="css/navbar.css">
<link rel="stylesheet" href="css/notifications.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

<script src="assets/jquery-1.9.1.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.js"></script>
<script src="assets/script.js"></script>
<script src="js/auth.js"></script>
</head>

<body>

<?php include 'includes/header.php'; ?>

<div class="inside-banner">
  <div class="container">
    <h2 class="text-center">Create an Account</h2>
    <p class="text-center text-light">Join us today and get access to premium property listings</p>
  </div>
</div>

<div class="container">
<div class="spacer">
<div class="row register">
  <div class="col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 ">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4><i class="fas fa-user-plus"></i> New User Registration</h4>
      </div>
      <div class="panel-body">
      <form id="register-form" method="post">
        <div class="form-group">
          <label>Full Name</label>
          <input type="text" class="form-control" name="name" placeholder="Your full name">
        </div>
        <div class="form-group">
          <label>Email Address</label>
          <input type="email" class="form-control" name="email" placeholder="Your email address">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Choose a password (min 6 characters)">
        </div>
        <div class="form-group">
          <label>Confirm Password</label>
          <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password">
        </div>
        <div class="form-group checkbox">
          <label>
            <input type="checkbox" name="terms" required> I accept the <a href="#">Terms and Conditions</a>
          </label>
        </div>
        <button type="submit" class="btn btn-success" name="register"><i class="fas fa-user-plus"></i> Register</button>
      </form>
      <div class="text-center" style="margin-top: 20px;">
        <p>Already have an account? <a href="#" data-toggle="modal" data-target="#loginpop">Sign in here</a></p>
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