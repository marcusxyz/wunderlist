<?php

$message = $_SESSION['message'] ?? '';
$error = $_SESSION['error'] ?? '';

$errorMail = $_SESSION['error-email'] ?? '';
$errorPassword = $_SESSION['error-password'] ?? '';

unset($_SESSION['message'], $_SESSION['error']);
