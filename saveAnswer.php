<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'error_log.txt');

session_start();

if (!isset($_SESSION['ismember']) || $_SESSION['ismember'] != 1) {
    echo json_encode(["success" => false, "message" => "Unauthorized access"]);
    exit();
}

if (!isset($_SESSION['user_email'])) {
    echo json_encode(['success' => false, 'message' => 'User email not found in session.']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['questionId']) || !isset($_POST['answerType'])) {
        echo json_encode(['success' => false, 'message' => 'Missing required data.']);
        exit();
    }

    $questionId = $_POST['questionId'];
    $userEmail = $_SESSION['user_email'];
    $answerType = $_POST['answerType'];
    $answerText = isset($_POST['answer']) ? $_POST['answer'] : '';
    $selectedOptions = isset($_POST['selectedOptions']) ? json_decode($_POST['selectedOptions'], true) : null;
    $filePath = null;

    if (!filter_var($questionId, FILTER_VALIDATE_INT)) {
        echo json_encode(['success' => false, 'message' => 'Invalid question ID.']);
        exit();
    }

    $allowedAnswerTypes = ['text', 'multiple-choice', 'check-box', 'file'];
    if (!in_array($answerType, $allowedAnswerTypes)) {
        echo json_encode(['success' => false, 'message' => 'Invalid answer type.']);
        exit();
    }

    if ($answerType === 'file' && isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $fileName = uniqid() . '.' . $fileExtension;
        $filePath = $uploadDir . $fileName;

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            echo json_encode(['success' => false, 'message' => 'Invalid file type.']);
            exit();
        }

        if (!move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
            echo json_encode(['success' => false, 'message' => 'Failed to upload file.']);
            exit();
        }
    }

    $conn = new mysqli("localhost", "root", "", "Question_Post");

    if ($conn->connect_error) {
        error_log('Connection failed: ' . $conn->connect_error);
        echo json_encode(['success' => false, 'message' => 'Connection failed.']);
        exit();
    }

    try {
        $conn->begin_transaction();

        // جلب نوع السؤال من جدول Post_Q
        $query = "SELECT question_type FROM post_q WHERE Q_Id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $questionId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {
            throw new Exception('Question not found.');
        }

        $questionType = $row['question_type'];

        // التحقق من وجود تصويت سابق فقط إذا كان السؤال من نوع multiple-choice أو check-box
        if ($questionType === 'multiple-choice' || $questionType === 'check-box') {
            $query = "SELECT * FROM Answer_Q WHERE Email = ? AND question_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $userEmail, $questionId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                throw new Exception('You have already voted on this question.');
            }
        }

        if ($answerType === 'multiple-choice' || $answerType === 'check-box') {
            if (empty($selectedOptions)) {
                throw new Exception('No options selected.');
            }

            $query = "SELECT options FROM Post_Q WHERE Q_Id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $questionId);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if (!$row || empty($row['options'])) {
                throw new Exception('No options found for this question.');
            }

            $options = json_decode($row['options'], true);

            foreach ($selectedOptions as $selectedOption) {
                foreach ($options as &$option) {
                    if ($option['text'] === $selectedOption) {
                        $option['votes'] = ($option['votes'] ?? 0) + 1;
                    }
                }
            }

            $updatedOptions = json_encode($options);
            $query = "UPDATE Post_Q SET options = ? WHERE Q_Id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $updatedOptions, $questionId);
            if (!$stmt->execute()) {
                throw new Exception('Failed to update options.');
            }
        }

        $selectedOptionsString = json_encode($selectedOptions);
        $query = "INSERT INTO Answer_Q (Answer, Time_A, file_path, Email, question_id, selected_options, Votes) VALUES (?, NOW(), ?, ?, ?, ?, 1)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $answerText, $filePath, $userEmail, $questionId, $selectedOptionsString);

        if (!$stmt->execute()) {
            throw new Exception('Failed to save answer.');
        }

        $conn->commit();
        echo json_encode(['success' => true, 'message' => 'Answer saved successfully.', 'filePath' => $filePath]);
    } catch (Exception $e) {
        $conn->rollback();
        error_log('Error: ' . $e->getMessage());
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        $conn->close();
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>