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

// تحقق من وجود معرف المنشور
if (!isset($data['post_id'])) {
    echo json_encode(['success' => false, 'message' => 'Missing post ID.']);
    exit();
}

$postId = $data['post_id'];
$userEmail = $_SESSION['user_email'];

// التحقق من أن المستخدم هو صاحب المنشور
$stmt = $conn->prepare("SELECT Email FROM post_b WHERE Post_Id = ?");
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $conn->error]);
    exit();
}

$stmt->bind_param("i", $postId);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($postEmail);
$stmt->fetch();

if ($stmt->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Post not found.']);
    exit();
}

// إذا لم يكن المستخدم هو صاحب المنشور أو ليس من المستخدمين المميزين
if ($userEmail !== $postEmail && $userEmail !== 'asmarsamia2003@gmail.com' && $userEmail !== 'shahd.227.almasri@gmail.com') {
    echo json_encode(['success' => false, 'message' => 'You are not authorized to delete this post.']);
    exit();
}

// حذف التعليقات المرتبطة بالمنشور أولاً
$stmt = $conn->prepare("DELETE FROM comment_b WHERE Post_Id = ?");
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $conn->error]);
    exit();
}

$stmt->bind_param("i", $postId);

if ($stmt->execute()) {
    // بعد حذف التعليقات، احذف المنشور
    $stmt = $conn->prepare("DELETE FROM post_b WHERE Post_Id = ?");
    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $conn->error]);
        exit();
    }

    $stmt->bind_param("i", $postId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Post and associated comments deleted successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting post: ' . $stmt->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Error deleting comments: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>