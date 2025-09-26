<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استلام البيانات من النموذج
    $first_name = $_POST['first_name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // إعدادات البريد الإلكتروني
    $to = "shahd.227.almasri@gmail.com, asmarsamia2003@gmail.com";  // البريد الذي سترسل إليه الرسالة
    $subject = "New Message from " . $first_name;
    $body = "Name: $first_name\nEmail: $email\nMessage: $message";

    // إعدادات البريد
    $headers = "From: $email" . "\r\n" .
        "Reply-To: $email" . "\r\n" .
        "X-Mailer: PHP/" . phpversion();

    // إرسال البريد
    if (mail($to, $subject, $body, $headers)) {
        echo "تم إرسال الرسالة بنجاح!";
    } else {
        echo "فشل في إرسال الرسالة.";
    }
}
?>
