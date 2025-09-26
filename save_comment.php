<?php
session_start();
if (!isset($_SESSION['ismember']) || $_SESSION['ismember'] != 1) {
    echo json_encode(["success" => false, "message" => "Unauthorized access"]);
    exit();
}

$conn = new mysqli("localhost", "root", "", "borrow_post");

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]);
    exit();
}

$postId = $_POST['post_id'];
$commentText = $_POST['comment-text'];
$email = $_SESSION['user_email'];

// Handle file upload
$imagePath = null;
if (isset($_FILES['file-upload']) && $_FILES['file-upload']['error'] == 0) {
    $targetDir = "uploads/comments/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    $fileName = basename($_FILES["file-upload"]["name"]);
    $targetFilePath = $targetDir . uniqid() . "_" . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Allow certain file formats
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx'];
    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES["file-upload"]["tmp_name"], $targetFilePath)) {
            $imagePath = $targetFilePath;
        } else {
            echo json_encode(["success" => false, "message" => "Error uploading file."]);
            exit();
        }
    } else {
        echo json_encode(["success" => false, "message" => "Invalid file type."]);
        exit();
    }
}

// Insert comment into database
$sql = "INSERT INTO comment_b (Post_Id, Email, Text_Comment, image_Path_C) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isss", $postId, $email, $commentText, $imagePath);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Comment saved successfully."]);
} else {
    echo json_encode(["success" => false, "message" => "Error saving comment: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>