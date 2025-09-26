<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['ismember']) || $_SESSION['ismember'] != 1) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access.']);
    exit();
}

if (!isset($_SESSION['user_email'])) {
    echo json_encode(['success' => false, 'message' => 'User email not found in session.']);
    exit();
}

$conn = new mysqli("localhost", "root", "", "Question_Post");

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['questionText']) || !isset($_POST['questionType'])) {
        echo json_encode(['success' => false, 'message' => 'Missing required data.']);
        exit();
    }

    $questionText = $_POST['questionText'];
    $questionType = $_POST['questionType'];
    $userEmail = $_SESSION['user_email'];
    $options = null;

    // إذا كان نوع السؤال "Multiple Choice" أو "Check Box"، قم بجمع الخيارات
    if ($questionType === 'multiple-choice' || $questionType === 'check-box') {
        if (!isset($_POST['options'])) {
            echo json_encode(['success' => false, 'message' => 'Options are required for this question type.']);
            exit();
        }

        $options = json_decode($_POST['options'], true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(['success' => false, 'message' => 'Invalid JSON format for options.']);
            exit();
        }

        // التحقق من أن كل خيار يحتوي على نص
        foreach ($options as $option) {
            if (!isset($option['text']) || empty($option['text'])) {
                echo json_encode(['success' => false, 'message' => 'Option text is required.']);
                exit();
            }
        }
    }

    // تحويل الخيارات إلى JSON إذا كانت موجودة
    $optionsJson = $options ? json_encode($options) : null;

    // إدخال السؤال في قاعدة البيانات
    $stmt = $conn->prepare("INSERT INTO Post_Q (Text_Q, Time_Q, Email, question_type, options) VALUES (?, NOW(), ?, ?, ?)");
    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $conn->error]);
        exit();
    }

    $stmt->bind_param("ssss", $questionText, $userEmail, $questionType, $optionsJson);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Question added successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error executing statement: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>