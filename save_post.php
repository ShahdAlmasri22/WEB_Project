<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['ismember']) || $_SESSION['ismember'] != 1) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

if (!isset($_SESSION['user_email'])) {
    echo json_encode(['success' => false, 'message' => 'User email not found in session.']);
    exit();
}

$conn = new mysqli("localhost", "root", "", "borrow_post");

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit();
}

if (!is_dir('uploads')) {
    mkdir('uploads', 0777, true);
}

$content = $_POST['post-text'] ?? null;
$user_email = $_SESSION['user_email'];

if (!$content) {
    echo json_encode(['success' => false, 'message' => 'Missing required data.']);
    exit();
}

$image_path = null;
if (isset($_FILES['file-upload']) && $_FILES['file-upload']['error'] == 0) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file-upload"]["name"]);

    if (move_uploaded_file($_FILES["file-upload"]["tmp_name"], $target_file)) {
        $image_path = $target_file;
    } else {
        echo json_encode(['success' => false, 'message' => 'Error uploading file.']);
        exit();
    }
}

$stmt = $conn->prepare("INSERT INTO post_b (Text_Contant, image_Path, Email) VALUES (?, ?, ?)");
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $conn->error]);
    exit();
}

$stmt->bind_param("sss", $content, $image_path, $user_email);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Post saved successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error saving post: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>