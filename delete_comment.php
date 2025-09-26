<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// تحقق من أن المستخدم مسجل دخوله
if (!isset($_SESSION['ismember']) || $_SESSION['ismember'] != 1) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

// تحقق من وجود البريد الإلكتروني في الجلسة
if (!isset($_SESSION['user_email'])) {
    echo json_encode(['success' => false, 'message' => 'User email not found in session.']);
    exit();
}

// الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "borrow_post");

// تحقق من وجود أخطاء في الاتصال
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit();
}

// قراءة البيانات المرسلة من JavaScript
$data = json_decode(file_get_contents('php://input'), true);

// تحقق من وجود معرف التعليق
if (!isset($data['comment_id'])) {
    echo json_encode(['success' => false, 'message' => 'Missing comment ID.']);
    exit();
}

$commentId = $data['comment_id'];
$userEmail = $_SESSION['user_email'];

// التحقق من أن المستخدم هو صاحب التعليق
$stmt = $conn->prepare("SELECT Email FROM comment_b WHERE Comment_Id = ?");
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $conn->error]);
    exit();
}

$stmt->bind_param("i", $commentId);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($commentEmail);
$stmt->fetch();

// إذا لم يكن المستخدم هو صاحب التعليق أو ليس من المستخدمين المميزين
if ($userEmail !== $commentEmail && $userEmail !== 'asmarsamia2003@gmail.com' && $userEmail !== 'shahd.227.almasri@gmail.com') {
    echo json_encode(['success' => false, 'message' => 'You are not authorized to delete this comment.']);
    exit();
}

// حذف التعليق
$stmt = $conn->prepare("DELETE FROM comment_b WHERE Comment_Id = ?");
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $conn->error]);
    exit();
}

$stmt->bind_param("i", $commentId);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Comment deleted successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error deleting comment: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>