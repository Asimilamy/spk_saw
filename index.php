<?php
session_start();

if (!isset($_SESSION['user'])) {
    include 'views/auth/login.php';
} else {
    include 'views/template/admin.php';
}
