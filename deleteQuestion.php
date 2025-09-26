<?php
session_start();

if (!isset($_SESSION['ismember']) || $_SESSION['ismember'] != 1) {
    echo json_encode(["success" => false, "message" => "Unauthorized access"]);
    exit();
}

if (!isset($_GET['id'])) {
    echo json_encode(["success" => false, "message" => "Question ID is missing"]);
    exit();
}

$questionId = $_GET['id'];

$conn = new mysqli("localhost", "root", "", "Question_Post");
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]);
    exit();
}

$allowedAdminEmails = ["asmarsamai2003@gmail.com", "shahd.227.almasri@gmail.com"];

$sqlCheckQuestion = "SELECT Email FROM Post_Q WHERE Q_Id = ?";
$stmtCheckQuestion = $conn->prepare($sqlCheckQuestion);
$stmtCheckQuestion->bind_param("i", $questionId);
$stmtCheckQuestion->execute();
$resultCheckQuestion = $stmtCheckQuestion->get_result();
$question = $resultCheckQuestion->fetch_assoc();

if (!$question) {
    echo json_encode(["success" => false, "message" => "Question not found"]);
    exit();
}

if (trim($question['Email']) !== trim($_SESSION['user_email']) && !in_array($_SESSION['user_email'], $allowedAdminEmails)) {
    echo json_encode(['success' => false, 'message' => 'You are not authorized to delete this Question.']);
    exit();
}

$sqlDeleteAnswers = "DELETE FROM Answer_Q WHERE question_id = ?";
$stmtDeleteAnswers = $conn->prepare($sqlDeleteAnswers);
$stmtDeleteAnswers->bind_param("i", $questionId);

if (!$stmtDeleteAnswers->execute()) {
    echo json_encode(["success" => false, "message" => "Error deleting answers: " . $stmtDeleteAnswers->error]);
    exit();
}

$sqlDeleteQuestion = "DELETE FROM Post_Q WHERE Q_Id = ?";
$stmtDeleteQuestion = $conn->prepare($sqlDeleteQuestion);
$stmtDeleteQuestion->bind_param("i", $questionId);

if ($stmtDeleteQuestion->execute()) {
    echo json_encode(["success" => true, "message" => "Question and related answers deleted successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Error deleting question: " . $stmtDeleteQuestion->error]);
}

$stmtCheckQuestion->close();
$stmtDeleteAnswers->close();
$stmtDeleteQuestion->close();
$conn->close();
?>