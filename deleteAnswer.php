<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['ismember']) || $_SESSION['ismember'] != 1) {
    echo json_encode(["success" => false, "message" => "Unauthorized access"]);
    exit();
}

if (!isset($_SESSION['user_email'])) {
    echo json_encode(['success' => false, 'message' => 'User email not found in session.']);
    exit();
}

// التحقق من وجود معرّف الإجابة
if (!isset($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'Answer ID not provided.']);
    exit();
}

// قائمة بريدية للإدمن المسموح لهم بالحذف
$allowedAdminEmails = ["asmarsamai2003@gmail.com", "shahd.227.almasri@gmail.com"];

// الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "Question_Post");

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit();
}

$answerId = intval($_GET['id']);

try {
    // جلب البريد الإلكتروني المرتبط بالإجابة
    $query = "SELECT Email FROM Answer_Q WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $answerId);
    $stmt->execute();
    $result = $stmt->get_result();
    $answer = $result->fetch_assoc();

    if (!$answer) {
        echo json_encode(['success' => false, 'message' => 'Answer not found.']);
        exit();
    }

    // التحقق من أن المستخدم هو صاحب الإجابة أو إدمن
    if (trim($answer['Email']) !== trim($_SESSION['user_email']) && !in_array($_SESSION['user_email'], $allowedAdminEmails)) {
        echo json_encode(['success' => false, 'message' => 'You are not authorized to delete this answer.']);
        exit();
    }

    // حذف الإجابة
    $query = "DELETE FROM Answer_Q WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $answerId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete answer.']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
} finally {
    $conn->close();
}
?>