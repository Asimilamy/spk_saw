<?php
session_start();
include 'helpers/function.php';
include 'config/Database.php';

$database = new Database();
$db = $database->getKoneksi();

if (!isset($_SESSION['user'])) {
    include 'views/auth/login.php';
} else {
    include 'views/template/admin.php';
}
