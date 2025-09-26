<?php
session_start();
$_SESSION['is_admin'] = in_array($_SESSION['user_email'], ["asmarsamai2003@gmail.com", "shahd.227.almasri@gmail.com"]);

if (!isset($_SESSION['ismember']) || $_SESSION['ismember'] != 1) {
    header("location: slideLogin.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDUHELP</title>
    <link rel="icon" type="image/png" href="img/book.png">
    <link rel="stylesheet" href="question.css">
    <style>
        #mynav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            height: 80px;
            background-color: #f5ede8;
            z-index: 999999999;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            width: 300px;
            text-align: center;
        }
        .modal-content input, .modal-content select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .modal-content button {
            padding: 10px 20px;
            margin: 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .modal-content button.confirm {
            background: #28a745;
            color: #fff;
        }
        .modal-content button.cancel {
            background: #dc3545;
            color: #fff;
        }
        .option-item button {
            background-color: #c6c0c1;
            color: white;
            border: none;
            padding: 0;
            width: 20px;
            height: 20px;
            cursor: pointer;
            display: flex;
            border-radius: 50%; /* استخدام 50% لإنشاء دائرة */
            align-items: center;
            justify-content: center;
            font-size: 10px;
            margin-left: 5px;
        }

        .delete-button {
            position: absolute;
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px;
            right: 20px;
            top: 0;
        }

        .delete-svgIcon {
            width: 20px;
            height: 20px;
            fill: #f5ede8;
            transition: fill 0.3s;
        }

        .delete-button:hover .delete-svgIcon {
            fill: #f5ede8;
        }

        .answer-container {
            display: flex;
            align-items: center;
            margin-top: 10px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .answerContainer{
            position: relative;
        }

        .answersDiv{
            position: absolute;
            margin-top: 100px;
        }

        .answers-count {
            cursor: pointer;
            color: #805436;
            text-decoration: underline;
            margin-right: 10px;
        }

        .question {
            position: relative;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #f5ede8;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .question h3 {
            margin-top: 0;
        }

        .question-actions {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .question-actions button {
            margin-right: 10px;
            padding: 5px 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            background-color: #805436;
            color: white;
            cursor: pointer;
        }

        .question-actions button:hover {
            background-color: #6a452c;
        }

        .answers {
            margin-top: 10px;
        }

        .answers p {
            margin: 0;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
            margin-bottom: 5px;
        }

        .vote-option {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .vote-option label {
            margin-left: 10px;
        }

        .vote-count {
            margin-left: auto;
            font-weight: bold;
        }
        .menu img{
            position: absolute;
            right: 50px;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 44px;
            top: 63px;
            background-color: #f5ede8;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.4);
            z-index: 1000;
            border-radius: 5px;
        }

        .dropdown-content a {
            color: #805436;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s ease;
            font-family: 'Poppins', sans-serif;

        }

        .dropdown-content a:hover {
            background-color: #805436;
            color: #f5ede8;
        }

        .dropdown-content.show {
            display: block;
        }
        .file-preview {
            margin-top: 10px;
            max-width: 100px;
            max-height: 100px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            background-color: #f9f9f9;
            cursor: pointer;
        }

        .file-preview img, .file-preview iframe {
            max-width: 100%;
            max-height: 100%;
        }

        .file-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .file-modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            max-width: 90%;
            max-height: 90%;
            overflow: auto;
        }

        .file-modal-content img, .file-modal-content iframe {
            max-width: 100%;
            max-height: 100%;
        }

        .close-modal {
            position: absolute;
            top: 20px;
            right: 20px;
            color: white;
            font-size: 30px;
            cursor: pointer;
        }

        .download-link {
            color: #805436;
            text-decoration: underline;
            cursor: pointer;
        }

        .download-link:hover {
            color: #6a452c;
        }
        .delete-answer-button {
            position: absolute ;
            right: 30px;
            background: none !important;
            border: none !important;
            cursor: pointer !important;
            padding: 5px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin-left: 10px !important;
        }

        .delete-answer-button svg {
            width: 20px !important;
            height: 20px !important;
            fill: #805436 !important;
            transition: fill 0.3s !important;
        }

        .delete-answer-button:hover svg {
            fill: #6a452c !important;
        }

    </style>
</head>
<body>
<nav id="mynav">
    <ul class="menu">
        <a href="firstPage.php"><button>Home</button></a>
        <a href="firstPage.php#divAbout"><button>About</button></a>
        <a href="firstPage.php#Ser"><button>Services</button></a>
        <a href="firstPage.php#Contact"><button>Contact us</button></a>
        <li>
            <img src="img/align-justify.png" alt="" id="dropdownBtn">
            <div class="dropdown-content" id="dropdownContent">
                <a style="font-weight: normal" href="courses.php">Go To Courses Page</a>
                <a style="font-weight: normal" href="question.php"> Go To Questions Page</a>
                <a style="font-weight: normal" href="Borrow.php">Go To Borrow Page</a>
                <a style="font-weight: normal" href="delete_account.php" onclick="return confirm('Are you sure you want to delete the account?')">Delete Account</a>
                <a style="font-weight: normal" href="logout.php">Log Out</a>
            </div>
        </li>
    </ul>
</nav>

<div class="div1">
    <div class="Question">
        <p> <b>Have a Questions ?</b> </p>
        <img src="img/question-and-answer.png" width="170px" height="170px">
        <pre>
   Have a question about courses?
   Share your post here and let others help with answers and recommendations!
            </pre>
    </div>
</div>
<div class="ButtonQ">
    <button class="cssbuttons-io-button" id="addQuestionBtn">
        Add Question
        <div class="icon">
            <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 5v14M5 12h14" fill="none" stroke="currentColor" stroke-width="2"></path>
            </svg>
        </div>
    </button>
</div>
<br>
<br>
<br>
<br>
<br>

<div id="questionsList"></div>

<div id="questionModal" class="modal">
    <div class="modal-content">
        <h3>Add Question</h3>
        <form id="questionForm" onsubmit="submitQuestion(event)"  method="post">
            <input type="text" id="questionInput" name="questionText" placeholder="Enter your question" required>
            <select id="questionType" name="questionType" onchange="toggleOptions()">
                <option value="text">Text</option>
                <option value="multiple-choice">Multiple Choice</option>
                <option value="check-box">Check Box</option>
                <option value="file">File</option>
            </select>
            <div id="optionsContainer" class="options-container" style="display: none;">
                <div id="optionsList"></div>
                <button type="button" onclick="addOption()">Add Option</button>
            </div>
            <button type="submit" class="confirm">Submit</button>
            <button type="button" class="cancel" onclick="closeModal('questionModal')">Cancel</button>
        </form>
    </div>
</div>

<!-- Modal for adding an answer -->
<div id="answerModal" class="modal">
    <div class="modal-content">
        <h3>Add Answer</h3>
        <form id="answerForm" onsubmit="submitAnswer(event)" enctype="multipart/form-data" method="post">
            <input type="hidden" id="answerType" name="answerType">
        </form>
        <button type="submit" form="answerForm" class="confirm">Submit</button>
        <button type="button" class="cancel" onclick="closeModal('answerModal')">Cancel</button>
    </div>
</div>
<div id="fileModal" class="file-modal">
    <span class="close-modal" onclick="closeFileModal()">×</span>
    <div class="file-modal-content" id="fileModalContent"></div>
</div>

<script>
    const currentUserEmail = "<?php echo $_SESSION['user_email']; ?>";
    console.log("Current User Email:", currentUserEmail); // للتحقق من القيمة

    const questionsList = document.getElementById('questionsList');
    let questions = [];
    let currentQuestionId = null;
    let Votes = 0 ;
    let options = [];

    // Function to open a modal
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = 'flex'; // عرض المودال
        } else {
            console.error('Modal element not found!');
        }
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = 'none'; // إخفاء المودال
        } else {
            console.error('Modal element not found!');
        }
    }

    // Function to open file modal
    function openFileModal(fileUrl, fileType) {
        const fileModalContent = document.getElementById('fileModalContent');
        if (fileType.startsWith('image/')) {
            fileModalContent.innerHTML = `<img src="${fileUrl}" alt="Image">`;
        } else if (fileType === 'application/pdf') {
            fileModalContent.innerHTML = `<iframe src="${fileUrl}" style="width: 80vw; height: 80vh;"></iframe>`;
        } else {
            fileModalContent.innerHTML = `<a href="${fileUrl}" download>Download File</a>`;
        }
        openModal('fileModal');
    }

    // Function to close file modal
    function closeFileModal() {
        closeModal('fileModal');
    }

    // Function to toggle options container
    function toggleOptions() {
        const questionType = document.getElementById('questionType').value;
        const optionsContainer = document.getElementById('optionsContainer');
        if (questionType === 'multiple-choice' || questionType === 'check-box') {
            optionsContainer.style.display = 'block';
        } else {
            optionsContainer.style.display = 'none';
        }
    }


    function addOption() {
        const optionsList = document.getElementById('optionsList');
        const optionId = options.length + 1;

        const optionItem = document.createElement('div');
        optionItem.className = 'option-item';
        optionItem.innerHTML = `
        <input type="text" id="optionInput${optionId}" placeholder="Option ${optionId}">
        <button onclick="removeOption(${optionId})">X</button>
    `;

        optionsList.appendChild(optionItem);

        const newOption = { id: optionId, text: '', votes: 0 };
        options.push(newOption);

        const inputElement = document.getElementById(`optionInput${optionId}`);
        inputElement.addEventListener('input', (event) => {
            newOption.text = event.target.value;
            console.log("Updated option:", newOption);
        });
    }

    function removeOption(optionId) {
        const optionItem = document.getElementById(`optionInput${optionId}`).parentElement;
        optionItem.remove();
        options = options.filter(option => option.id !== optionId);

        console.log("Option removed:", optionId);
    }

    function addQuestion() {
        options = [];
        document.getElementById('optionsList').innerHTML = '';

        document.getElementById('questionInput').value = '';

        document.getElementById('optionsContainer').style.display = 'none';

        openModal('questionModal');
    }

    function submitQuestion(event) {
        event.preventDefault();
        const questionText = document.getElementById('questionInput').value;
        const questionType = document.getElementById('questionType').value;

        if (!questionText || !questionType) {
            alert("Please fill all fields!");
            return;
        }

        if (questionType === 'multiple-choice' || questionType === 'check-box') {
            const optionInputs = document.querySelectorAll('#optionsList input');
            if (optionInputs.length === 0) {
                alert("Please add at least one option!");
                return;
            }

            let allOptionsFilled = true;
            optionInputs.forEach(input => {
                if (!input.value.trim()) {
                    allOptionsFilled = false;
                }
            });

            if (!allOptionsFilled) {
                alert("Please fill all option labels!");
                return;
            }
        }

        const formData = new FormData();
        formData.append('questionText', questionText);
        formData.append('questionType', questionType);

        if (questionType === 'multiple-choice' || questionType === 'check-box') {
            const options = [];
            const optionInputs = document.querySelectorAll('#optionsList input');
            optionInputs.forEach((input, index) => {
                options.push({ id: index + 1, text: input.value }); // إضافة الخيارات إلى المصفوفة
            });
            formData.append('options', JSON.stringify(options)); // إرسال الخيارات كـ JSON
        }

        console.log("Question Text:", questionText);
        console.log("Question Type:", questionType);
        console.log("Options:", options);

        fetch('saveQuestion.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Question added successfully!");
                    closeModal('questionModal');
                    loadQuestions();
                } else {
                    alert("Error adding question: " + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("An error occurred while submitting data.");
            });
    }


    function loadQuestions() {
        fetch('getQuestions.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(text => {
                try {
                    const data = JSON.parse(text);
                    if (data.success) {
                        questions = data.questions;
                        renderQuestions();
                    } else {
                        console.error('Error loading questions:', data.message);
                    }
                } catch (error) {
                    console.error('Failed to parse JSON:', text);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    document.addEventListener("DOMContentLoaded", () => {
        loadQuestions();
    });
    function renderQuestions() {
        const questionsList = document.getElementById('questionsList');
        questionsList.innerHTML = ''; // مسح المحتوى الحالي

        // قائمة بريدية للإدمن المسموح لهم بالحذف
        const allowedAdminEmails = ["asmarsamai2003@gmail.com", "shahd.227.almasri@gmail.com"];

        // التحقق من أن المستخدم إدمن
        const isAdmin = allowedAdminEmails.includes(currentUserEmail);

        questions.forEach((question, index) => {
            const questionDiv = document.createElement('div');
            questionDiv.className = 'question';
            questionDiv.innerHTML = `
            <h3>Q${index + 1}: ${question.text}</h3>
            <div class="question-actions">
                <div class="answers-count" onclick="toggleAnswers(${question.id})">${question.answers ? question.answers.length : 0} Answers</div>
                <button onclick="openAnswerModal(${question.id})">Add Answer</button>
                ${question.email === currentUserEmail || isAdmin ? `
                    <button class="delete-button" onclick="deleteQuestion(${question.id})">
                        <svg class="delete-svgIcon" viewBox="0 0 448 512">
                            <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path>
                        </svg>
                    </button>
                ` : ''}
            </div>
            <div class="answers" id="answers-${question.id}" style="display: none;">
                ${question.type === 'multiple-choice' || question.type === 'check-box' ? `
                    <div class="options-list">
                        ${question.options ? question.options.map(option => `
                            <div class="vote-option">
                                <span>${option.text}</span>
                                <span class="vote-count">${option.votes || 0} Votes</span>
                            </div>
                        `).join('') : 'No options available'}
                    </div>
                ` : `
                    ${question.answers ? question.answers.map(answer => `
                        <div class="answer-container">
                            <p>${answer.text && answer.text.trim() !== '' ? answer.text : 'No answer text'}</p>
                            ${answer.filePath ? `<a href="${answer.filePath}" target="_blank">View File</a>` : ''}
                            <small>   Answered by   ${answer.email || 'Unknown'} at ${answer.time ? new Date(answer.time).toLocaleString() : 'Unknown time'}</small>
                            ${answer.email === currentUserEmail || isAdmin ? `
                                <button class="delete-answer-button" onclick="deleteAnswer(${question.id}, ${answer.id})">
                                    <svg class="delete-svgIcon" viewBox="0 0 448 512">
                                        <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path>
                                    </svg>
                                </button>
                            ` : ''}
                        </div>
                    `).join('') : 'No answers yet.'}
                `}
            </div>
        `;
            questionsList.appendChild(questionDiv);
        });
    }
    function submitAnswer(event) {
        event.preventDefault();

        let selectedOptions = [];
        document.querySelectorAll('input[name="selectedOptions"]:checked').forEach((checkbox) => {
            selectedOptions.push(checkbox.value);
        });

        if (selectedOptions.length === 0 && currentQuestionType !== 'text' && currentQuestionType !== 'file') {
            console.error('No selected options to send!');
            alert("Please select at least one option.");
            return;
        }

        if (!currentQuestionId || !currentUserEmail) {
            console.error('Question ID or User Email is missing!');
            alert("An error occurred. Please try again.");
            return;
        }

        const formData = new FormData(event.target);
        formData.append('questionId', currentQuestionId);
        formData.append('userEmail', currentUserEmail);
        formData.append('selectedOptions', JSON.stringify(selectedOptions));
        formData.append('answerType', currentQuestionType);
        formData.append('Votes', 1); // زيادة التصويتات بمقدار 1

        console.log("FormData content:");
        for (let [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }
        console.log("Selected Options:", selectedOptions);
        console.log("Votes:", 1);

        fetch('saveAnswer.php', {
            method: 'POST',
            body: formData
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json(); // تحويل الاستجابة مباشرة إلى JSON
            })
            .then(data => {
                console.log('Response from server:', data);
                if (data.success) {
                    alert("Answer saved successfully!");
                    closeModal('answerModal');
                    loadQuestions();
                } else {
                    alert("Error saving answer: " + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("An error occurred while saving the answer.");
            });
    }






    function toggleAnswers(questionId) {
        const answersDiv = document.getElementById(`answers-${questionId}`);
        if (answersDiv) {
            answersDiv.style.display = answersDiv.style.display === 'none' ? 'block' : 'none';
        }
    }

    function deleteQuestion(questionId) {
        if (!questionId || isNaN(questionId)) {
            console.error("Invalid Question ID");
            return;
        }

        // قائمة بريدية للإدمن المسموح لهم بالحذف
        const allowedAdminEmails = ["asmarsamai2003@gmail.com", "shahd.227.almasri@gmail.com"];

        // التحقق من أن المستخدم إدمن
        const isAdmin = allowedAdminEmails.includes(currentUserEmail);

        // التحقق من أن المستخدم هو صاحب السؤال أو إدمن
        const question = questions.find(q => q.id === questionId);
        const isOwner = question && question.email === currentUserEmail;

        if (isAdmin || isOwner || confirm("Are you sure you want to delete this question?")) {
            fetch(`deleteQuestion.php?id=${encodeURIComponent(questionId)}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ action: 'delete', isAdmin: isAdmin })
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        alert("Question deleted successfully!");
                        location.reload(); // إعادة تحميل الصفحة لعرض التحديثات
                    } else {
                        alert("Error deleting question: " + (data.message || "Unknown error"));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("An error occurred while deleting the question.");
                });
        } else {
            alert("You are not authorized to delete this question.");
        }
    }

    function deleteAnswer(questionId, answerId) {
        console.log("Deleting answer with ID:", answerId);
        if (!answerId) {
            console.error("Answer ID is undefined!");
            return;
        }

        if (confirm("Are you sure you want to delete this answer?")) {
            fetch(`deleteAnswer.php?id=${answerId}`, {
                method: 'POST', // استخدام POST بدلاً من DELETE
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        alert("Answer deleted successfully!");
                        loadQuestions(); // إعادة تحميل الأسئلة
                    } else {
                        alert("Error deleting answer: " + (data.message || "Unknown error"));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("An error occurred while deleting the answer.");
                });
        }
    }
    function openAnswerModal(questionId) {
        console.log("Opening answer modal for question ID:", questionId);
        console.log("Questions array:", questions);

        currentQuestionId = questionId;
        const question = questions.find(q => q.id === String(questionId));

        if (!question) {
            console.error("Question not found for ID:", questionId);
            alert("Question not found. Please try again.");
            return;
        }

        console.log("Question details:", question);

        currentQuestionType = question.type;

        let answerForm = '';

        switch (question.type) {
            case 'text':
                answerForm = `
                <textarea id="answerInput" name="answer" placeholder="Enter your answer..." required></textarea>
            `;
                break;

            case 'multiple-choice':
            case 'check-box':
                if (!question.options || question.options.length === 0) {
                    console.error("No options found for this question.");
                    alert("No options available for this question. Please contact support.");
                    return;
                }
                answerForm = question.options.map(option => `
                <div>
                    <input type="${question.type === 'multiple-choice' ? 'radio' : 'checkbox'}" name="selectedOptions" value="${option.text}">
                    <label>${option.text}</label> <!-- عرض نص الخيار -->
                </div>
            `).join('');
                break;

            case 'file':
                answerForm = `
                <input type="file" id="fileInput" name="file" required>
            `;
                break;

            default:
                console.error("Unknown question type:", question.type);
                alert("Unknown question type. Please contact support.");
                return;
        }

        // إضافة نوع الإجابة كنص مخفي
        answerForm += `<input type="hidden" id="answerType" name="answerType" value="${question.type}">`;

        // عرض النموذج في العنصر المخصص
        document.getElementById('answerForm').innerHTML = answerForm;

        // فتح نافذة الإجابة
        openModal('answerModal');
    }
    document.getElementById('addQuestionBtn').addEventListener('click', addQuestion);

    document.addEventListener("DOMContentLoaded", () => {
        const dropdownBtn = document.getElementById("dropdownBtn");
        const dropdownContent = document.getElementById("dropdownContent");

        dropdownBtn.addEventListener("click", (event) => {
            event.stopPropagation();
            dropdownContent.classList.toggle("show");
        });

        window.addEventListener("click", () => {
            if (dropdownContent.classList.contains("show")) {
                dropdownContent.classList.remove("show");
            }
        });
    });

</script>
</body>
</html>