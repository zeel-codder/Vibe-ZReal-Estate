<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function getUserName() {
    return isset($_SESSION['username']) ? $_SESSION['username'] : '';
}

function getUserId() {
    return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: index.php?login=required');
        exit;
    }
}

function getLoginLogoutButton() {
    if (isLoggedIn()) {
        return '<li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout (' . getUserName() . ')</a></li>';
    } else {
        return '<li><a href="#" data-toggle="modal" data-target="#loginpop"><i class="fas fa-sign-in-alt"></i> Login</a></li>';
    }
}
?>