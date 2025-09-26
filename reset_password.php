<?php
session_start();
$error_message = "";

// التأكد من أن البريد الإلكتروني محفوظ في الجلسة
if (!isset($_SESSION['reset_email'])) {
    header("location: forgot_password.php");
    exit();
}

if (isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password === $confirm_password) {
        // الاتصال بقاعدة البيانات
        $db = new mysqli("localhost", "root", "", "signup");
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }

        // تشفير كلمة المرور
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        // تحديث كلمة المرور في قاعدة البيانات
        $stmt = $db->prepare("UPDATE userinfo SET Pass = ? WHERE Email = ?");
        $stmt->bind_param("ss", $hashed_password, $_SESSION['reset_email']);
        $stmt->execute();

        // إعادة التوجيه إلى صفحة الدخول بعد التحديث
        session_unset();
        session_destroy();
        header("location: slideLogin.php?password_reset=success");
        exit();
    } else {
        $error_message = "Passwords do not match.";
    }
}
?>