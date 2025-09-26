<?php
session_start();
header('Content-Type: application/json'); // إرجاع البيانات بصيغة JSON

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // الاتصال بقاعدة البيانات
    $db = new mysqli("localhost", "root", "", "signup");
    if ($db->connect_error) {
        die(json_encode(["status" => "error", "message" => "Connection failed: " . $db->connect_error]));
    }

    // التحقق من وجود البريد الإلكتروني في قاعدة البيانات
    $stmt = $db->prepare("SELECT * FROM userinfo WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // البريد الإلكتروني موجود
        $_SESSION['reset_email'] = $email; // تخزين البريد الإلكتروني في الجلسة
        echo json_encode(["status" => "success"]);
    } else {
        // البريد الإلكتروني غير موجود
        echo json_encode(["status" => "error", "message" => "Email not found. Please check your email address."]);
    }

    $stmt->close();
    $db->close();
    exit();
}
?>