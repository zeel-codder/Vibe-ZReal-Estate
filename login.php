<?php
session_start();
include_once "connection.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    
    if (!$email || !$password) {
        echo json_encode(['success' => false, 'message' => 'Please enter both email and password']);
        exit;
    }
    
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            
            if (isset($_POST['remember']) && $_POST['remember'] == 'on') {
                $expiry = time() + (30 * 24 * 60 * 60);
                
                setcookie('user_id', $user['user_id'], $expiry, '/');
            }
            
            echo json_encode(['success' => true, 'message' => 'Login successful!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
    }
    
    mysqli_stmt_close($stmt);
    exit;
}

header('Location: index.php');
exit;
?>