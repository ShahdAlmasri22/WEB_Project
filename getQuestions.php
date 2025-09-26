<?php
session_start();
header('Content-Type: application/json');

// التحقق من أن المستخدم مسجل دخوله وله صلاحية
if (!isset($_SESSION['ismember']) || $_SESSION['ismember'] != 1) {
    echo json_encode(["success" => false, "message" => "Unauthorized access"]);
    exit();
}

// الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "Question_Post");

// التحقق من نجاح الاتصال
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit();
}

try {
    // جلب الأسئلة
    $query = "SELECT Q_Id AS id, Text_Q AS text, Time_Q AS time, Email AS email, question_type AS type FROM Post_Q";
    $result = $conn->query($query);

    if ($result) {
        $questions = [];
        while ($row = $result->fetch_assoc()) {
            $question = [
                'id' => $row['id'],
                'text' => $row['text'],
                'time' => $row['time'],
                'email' => $row['email'],
                'type' => $row['type'],
                'answers' => [] // إضافة مصفوفة لتخزين الإجابات
            ];

            // جلب الإجابات المرتبطة بهذا السؤال
            $answerQuery = "SELECT Id AS id, Answer AS text, Time_A AS time, file_path AS filePath, Email AS email FROM Answer_Q WHERE question_id = ?";
            $stmt = $conn->prepare($answerQuery);
            $stmt->bind_param("i", $row['id']);
            $stmt->execute();
            $answerResult = $stmt->get_result();

            while ($answerRow = $answerResult->fetch_assoc()) {
                $question['answers'][] = [
                    'id' => $answerRow['id'],
                    'text' => $answerRow['text'],
                    'time' => $answerRow['time'],
                    'filePath' => $answerRow['filePath'],
                    'email' => $answerRow['email']
                ];
            }

            $questions[] = $question;
        }

        echo json_encode(['success' => true, 'questions' => $questions]);
    } else {
        throw new Exception('Error fetching questions: ' . $conn->error);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
} finally {
    $conn->close();
}
?>