<?php
session_start();
if (!isset($_SESSION['user_email'])) {
header("location: slideLogin.php");
exit();
}

$conn = new mysqli("localhost", "root", "", "signup");

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$email = $_SESSION['user_email'];

$stmt = $conn->prepare("DELETE FROM userinfo WHERE Email = ?");
$stmt->bind_param("s", $email);

if ($stmt->execute()) {
echo "Delete Successfully";
session_destroy();
header("Location: firstPage.php");
exit();
} else {
echo "There was an error when we deleted the account:" . $stmt->error;
}

$stmt->close();
$conn->close();
?>