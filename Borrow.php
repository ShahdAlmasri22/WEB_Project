<?php
session_start();
if (!isset($_SESSION['ismember']) || $_SESSION['ismember'] != 1) {
    header("location: slideLogin.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "borrow_post");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM post_b ORDER BY Post_Time_B DESC";
$result = $conn->query($sql);

$posts = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
}

$comments = [];
foreach ($posts as $post) {
    $postId = $post['Post_Id'];
    $sql = "SELECT * FROM comment_b WHERE Post_Id = $postId ORDER BY Time_Comment DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $comments[$postId][] = $row;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDUHELP</title>
    <link rel="icon" type="image/png" href="img/book.png">
    <link rel="stylesheet" href="Borrow.css">
    <style>
        .menu img {
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
            font-family: 'Poppins', sans-serif;
        }

        .dropdown-content a {
            color: #805436;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s ease;
        }

        .dropdown-content a:hover {
            background-color: #805436;
            color: #f5ede8;
        }

        .dropdown-content.show {
            display: block;
        }

        .post-item {
            position: relative;
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        .comment-section {
            margin-top: 10px;
        }

        .comment-input {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: vertical;
        }

        .comment-item {
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            position: relative;
        }

        .delete-post-button {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 10px;
            width: 20px;
            height: 20px;
        }

        .delete-comment-button {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 10px;
            width: 20px;
            height: 20px;
        }

        .submit-comment-button {
            background-color: #805436;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .submit-comment-button:hover {
            background-color: #6a452d;
        }

        .bookmarkBtn {
            width: 130px;
            height: 40px;
            border-radius: 40px;
            border: none;
            background-color: rgb(255, 255, 255);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition-duration: .3s;
            overflow: hidden;
            box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.062);
        }

        .IconContainer {
            width: 30px;
            height: 30px;
            background-color: #805436;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            z-index: 2;
            transition-duration: .3s;
        }

        .text {
            height: 100%;
            width: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #805436;
            z-index: 1;
            transition-duration: .3s;
            font-size: 1.04em;
            font-weight: 600;
        }

        .bookmarkBtn:hover .IconContainer {
            width: 120px;
            border-radius: 40px;
            transition-duration: .3s;
        }

        .bookmarkBtn:hover .text {
            transform: translate(10px);
            width: 0;
            font-size: 0;
            transition-duration: .3s;
        }

        .bookmarkBtn:active {
            transform: scale(0.95);
            transition-duration: .3s;
        }

        .up-button {
            position: fixed;
            bottom: 20px;
            right: 25px;
            background: #fff;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: all 0.3s ease;
            opacity: 0;
            visibility: hidden;
        }

        .up-button.show {
            opacity: 1;
            visibility: visible;
        }

        .up-button svg {
            fill: #805436;
        }

        .up-button:hover {
            background: #af9886;
        }

        .up-button:hover svg {
            fill: #fff;
        }

        .up-button .tooltip {
            position: absolute;
            top: -40px;
            font-size: 14px;
            background: #af9886;
            color: white;
            padding: 5px 8px;
            border-radius: 5px;
            box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .up-button:hover .tooltip {
            opacity: 1;
        }

        .submit-comment-button{
            width: auto;
            right: 22%;
            margin-bottom: 5px;
        }

        .file-input{
            top:1px;
            left: 13%;
        }

        #file-upload{
            display: flex;
            justify-content: left;
            left:15%;
            margin-bottom: 10px;
        }

        .post-form textarea{
            resize: none;
        }

        .submit-comment-button{
            display:flex ;
            left: 0.5%;
        }
        .file-input{
            display:flex ;
            left: 0.5%;
        }

        @media (max-width: 1041px) {
            .Question {
                font-size: 23px;
            }

            .Question img {
                width: 100px;
                height: 100px;
                left: 98%;
            }

            .Question pre {
                font-size: 23px;
                top:92%;
                left:-16%;
            }

            .post {
                width: 80px;
                height: 25px;
                font-size: 14px;
            }

            .post-form {
                width: 70%;
            }

            .post-form textarea {
                width: 90%;
            }

            .post-item {
                margin: 10px 0;
            }

            .comment-input {
                width: 100%;
            }
            .delete-post-button{
                top:3%;
                left:95%;
            }
            .delete-comment-button{
                left:95%;
            }

            .submit-comment-button{
                display:flex ;
                left: 0.5%;
            }
            .file-input{
                display:flex ;
                left: 0.5%;
            }
        }

        @media (max-width: 933px) {
            .Question {
                font-size: 20px;
            }

            .Question img {
                width: 90px;
                height: 90px;
                left: 98%;
            }

            .Question pre {
                font-size: 20px;
                top:92%;
                left:-17%;
            }

            .post {
                width: 80px;
                height: 25px;
                font-size: 14px;
                top:66%;
            }

            .post-form {
                width: 70%;
                /*left: -10%;*/
            }

            .post-form textarea {
                width: 90%;
            }

            .post-item {
                margin: 10px 0;
            }

            .comment-input {
                width: 100%;
            }
            .delete-post-button{
                top:3%;
                left:95%;
            }
            .delete-comment-button{
                left:95%;
            }
            .div1{
                height: 390px;
            }
            #dropdownBtn{
                left: 90%;
                bottom: 27%;
                width: 30px;
                height: 30px;
            }

        }

        @media (max-width: 755px) {
            .Question {
                font-size: 18px;
                left:22%;
            }

            .Question img {
                width: 80px;
                height: 80px;
                left: 98%;
            }

            .Question pre {
                font-size: 18px;
                top:92%;
                left:-24%;
            }

            .post {
                width: 80px;
                height: 25px;
                font-size: 14px;
                top:65%
            }

            .post-form {
                width: 70%;
                /*left: -10%;*/
            }

            .post-form textarea {
                width: 90%;
            }

            .post-item {
                margin: 10px 0;
            }

            .comment-input {
                width: 100%;
            }
            .delete-post-button{
                top:3%;
                left:95%;
            }
            .delete-comment-button{
                left:95%;
            }
            .div1{
                height: 360px;
            }
            #dropdownBtn{
                left: 90%;
                bottom: 27%;
                width: 30px;
                height: 30px;
            }

        }

        @media (max-width: 636px) {
            .Question {
                font-size: 18px;
                left:20%;
            }

            .Question img {
                width: 70px;
                height: 70px;
                left: 98%;
            }

            .Question pre {
                font-size: 15px;
                top:92%;
                left:-17%;
            }

            .post {
                width: 80px;
                height: 25px;
                font-size: 14px;
                top: 63%;
                left: 17%;
            }

            .post-form {
                width: 70%;
            }

            .post-form textarea {
                width: 90%;
            }

            .post-item {
                margin: 10px 0;
            }

            .comment-input {
                width: 100%; /* العرض يتكيف مع الشاشة */
            }
            .delete-post-button{
                top:3%;
                left:95%;
            }
            .delete-comment-button{
                left:95%;
            }
            .bi-chevron-double-up{
                width: 12px;
                height: 12px;
            }
            .div1{
                height: 360px;
            }
            #dropdownBtn{
                left: 90%;
                bottom: 27%;
                width: 30px;
                height: 30px;
            }

        }

        @media (max-width: 550px) {
            .Question {
                font-size: 16px; /* تصغير حجم الخط للشاشات الصغيرة */
                left:20%;
            }

            .Question img {
                width: 65px; /* تصغير حجم الصورة للشاشات الصغيرة */
                height: 65px;
                left: 99%;
            }

            .Question pre {
                font-size: 13px; /* تصغير حجم الخط للشاشات الصغيرة */
                top:92%;
                left:-17%;
            }

            .post {
                width: 70px; /* تصغير حجم الزر للشاشات الصغيرة */
                height: 15px;
                font-size: 14px; /* تصغير حجم الخط داخل الزر */
                top: 59%;
                left: 17%;
            }


            .post-form {
                width: 70%; /* العرض يتكيف مع الشاشة */
                /*left: -10%;*/
            }

            .post-form textarea {
                width: 90%; /* العرض يتكيف مع الشاشة */
            }

            .post-item {
                margin: 10px 0; /* تقليل الهوامش للشاشات الصغيرة */
            }

            .comment-input {
                width: 100%; /* العرض يتكيف مع الشاشة */
            }
            .delete-post-button{
                top:3%;
                left:93%;
            }
            .delete-comment-button{
                left:93%;
            }
            .bi-chevron-double-up{
                width: 12px;
                height: 12px;
            }
            #dropdownBtn{
                left: 90%;
                bottom: 27%;
                width: 30px;
                height: 30px;
            }
            .div1{
                height: 360px;
            }
        }

        @media (max-width: 458px) {
            .div1{
                height: 360px;
            }
            .Question {
                font-size: 14px; /* تصغير حجم الخط للشاشات الصغيرة */
                left:20%;
            }

            .Question img {
                width: 60px; /* تصغير حجم الصورة للشاشات الصغيرة */
                height: 60px;
                left: 99%;
            }

            .Question pre {
                font-size: 10px; /* تصغير حجم الخط للشاشات الصغيرة */
                top:92%;
                left:-17%;
            }

            .post {
                width: 70px; /* تصغير حجم الزر للشاشات الصغيرة */
                height: 15px;
                font-size: 14px; /* تصغير حجم الخط داخل الزر */
                top: 55%;
                left: 17%;
            }


            .post-form {
                width: 70%; /* العرض يتكيف مع الشاشة */
                /*left: -10%;*/
            }

            .menu{
                gap: 2px;
            }
            #dropdownBtn{
                left: 88%;
                width: 30px;
                height: 30px;
            }
            .dropdown-content{
                width: 40px;
                /*height: 40px;*/
            }
            .post-form textarea {
                width: 90%; /* العرض يتكيف مع الشاشة */
            }

            .post-item {
                margin: 10px 0; /* تقليل الهوامش للشاشات الصغيرة */
            }

            .comment-input {
                width: 100%; /* العرض يتكيف مع الشاشة */
            }
            .delete-post-button{
                top:3%;
                left:92%;
            }
            .delete-comment-button{
                left:92%;
            }
            .bi-chevron-double-up{
                width: 12px;
                height: 12px;
            }
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
        <li type="none">
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
        <p> <b>Are you looking for stationery?</b> </p>
        <img src="img/book2.png">
        <pre>
        If you need some tools or slides you can post here to get help
    </pre>
    </div>
    <button class="post" onclick="openPostForm()"> Add Post </button>
</div>

<div class="div2">
    <p class="ADD">-- All Post --</p>

    <div id="post-container">
        <?php foreach ($posts as $post): ?>
            <div class="post-item">
                <p><?php echo htmlspecialchars($post['Text_Contant']); ?></p>
                <?php if (!empty($post['image_Path'])): ?>
                    <?php
                    $fileExtension = strtolower(pathinfo($post['image_Path'], PATHINFO_EXTENSION));
                    if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])): ?>
                        <img src="<?php echo $post['image_Path']; ?>"
                             style="max-width: 30%; max-height: 30%; border-radius: 10px; margin-bottom: 10px; cursor: pointer;"
                             onclick="openImageModal('<?php echo $post['image_Path']; ?>')">
                    <?php else: ?>
                        <a href="<?php echo $post['image_Path']; ?>" target="_blank" style="display: block; margin-top: 10px; color: #805436; font-weight: bold;">
                            Open attached file
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
                <p style="font-size: 12px; color: #888; margin-top: 5px;">
                    Posted on: <?php echo date('Y-m-d H:i:s', strtotime($post['Post_Time_B'])); ?>
                </p>
                <p style="font-size: 12px; color: #888; margin-top: 5px;">
                    Posted by: <a href="mailto:<?php echo $post['Email']; ?>" style="color: #805436; text-decoration: none;"><?php echo $post['Email']; ?></a>
                </p>

                <?php if ($_SESSION['user_email'] === $post['Email'] || $_SESSION['user_email'] === 'asmarsamia2003@gmail.com' || $_SESSION['user_email'] === 'shahd.227.almasri@gmail.com'): ?>
                    <img src="img/delete.png" class="delete-post-button" onclick="deletePost(<?php echo $post['Post_Id']; ?>)">
                <?php endif; ?>

                <!-- زر التعليق -->
                <button class="bookmarkBtn" onclick="toggleCommentInput(this)">
            <span class="IconContainer">
                <svg fill="white" viewBox="0 0 512 512" height="1em">
                    <path d="M123.6 391.3c12.9-9.4 29.6-11.8 44.6-6.4c26.5 9.6 56.2 15.1 87.8 15.1c124.7 0 208-80.5 208-160s-83.3-160-208-160S48 160.5 48 240c0 32 12.4 62.8 35.7 89.2c8.6 9.7 12.8 22.5 11.8 35.5c-1.4 18.1-5.7 34.7-11.3 49.4c17-7.9 31.1-16.7 39.4-22.7zM21.2 431.9c1.8-2.7 3.5-5.4 5.1-8.1c10-16.6 19.5-38.4 21.4-62.9C17.7 326.8 0 285.1 0 240C0 125.1 114.6 32 256 32s256 93.1 256 208s-114.6 208-256 208c-37.1 0-72.3-6.4-104.1-17.9c-11.9 8.7-31.3 20.6-54.3 30.6c-15.1 6.6-32.3 12.6-50.1 16.1c-.8 .2-1.6 .3-2.4 .5c-4.4 .8-8.7 1.5-13.2 1.9c-.2 0-.5 .1-.7 .1c-5.1 .5-10.2 .8-15.3 .8c-6.5 0-12.3-3.9-14.8-9.9c-2.5-6-1.1-12.8 3.4-17.4c4.1-4.2 7.8-8.7 11.3-13.5c1.7-2.3 3.3-4.6 4.8-6.9c.1-.2 .2-.3 .3-.5z"></path>
                </svg>
            </span>
                    <p class="text">Comment</p>
                </button>

                <!-- مربع إدخال النص وزر إرسال التعليق -->
                <div class="comment-section" style="display: none;">
                    <textarea class="comment-input" placeholder="Write your comment here..."></textarea>
                    <input type="file" class="file-input" accept="image/*,application/pdf,.doc,.docx">
                    <button class="submit-comment-button" onclick="submitComment(this, <?php echo $post['Post_Id']; ?>)">Share Comment</button>
                </div>

                <?php if (isset($comments[$post['Post_Id']])): ?>
                    <?php foreach ($comments[$post['Post_Id']] as $comment): ?>
                        <div class="comment-item">
                            <p><?php echo htmlspecialchars($comment['Text_Comment']); ?></p>
                            <?php if (!empty($comment['image_Path_C'])): ?>
                                <?php
                                $fileExtension = strtolower(pathinfo($comment['image_Path_C'], PATHINFO_EXTENSION));
                                if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                    <img src="<?php echo $comment['image_Path_C']; ?>" style="max-width: 100px; margin-top: 10px; cursor: pointer;" onclick="openImageModal('<?php echo $comment['image_Path_C']; ?>')">
                                <?php else: ?>
                                    <a href="<?php echo $comment['image_Path_C']; ?>" target="_blank" style="display: block; margin-top: 10px; color: #805436; font-weight: bold;">
                                        Open attached file
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                            <p style="font-size: 12px; color: #888; margin-top: 5px;">
                                Commented on: <?php echo date('Y-m-d H:i:s', strtotime($comment['Time_Comment'])); ?>
                            </p>
                            <p style="font-size: 12px; color: #888; margin-top: 5px;">
                                Commented by: <a href="mailto:<?php echo $comment['Email']; ?>" style="color: #805436; text-decoration: none;"><?php echo $comment['Email']; ?></a>
                            </p>
                            <?php if ($_SESSION['user_email'] === $comment['Email'] || $_SESSION['user_email'] === 'asmarsamia2003@gmail.com' || $_SESSION['user_email'] === 'shahd.227.almasri@gmail.com'): ?>
                                <img src="img/delete.png" class="delete-comment-button" onclick="deleteComment(<?php echo $comment['Comment_Id']; ?>)">
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="overlay" id="overlay" onclick="closePostForm()">
    <div class="post-form" onclick="event.stopPropagation()">
        <h2>Add new post</h2>
        <textarea id="post-text" placeholder="write post here..." required></textarea>
        <input type="file" id="file-upload" class="file-input" accept="image/*">
        <button onclick="submitPost()" class="button1">post</button>
        <button onclick="closePostForm()" class="button2">cancel</button>
    </div>
</div>

<div id="upButton" class="up-button">
    <span class="tooltip">UP</span>
    <span>
        <svg viewBox="0 0 16 16" class="bi bi-chevron-double-up" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg">
            <path d="M7.646 2.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 3.707 2.354 9.354a.5.5 0 1 1-.708-.708l6-6z" fill-rule="evenodd"></path>
            <path d="M7.646 6.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 7.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z" fill-rule="evenodd"></path>
        </svg>
    </span>
</div>


<script>
    function openPostForm() {
        document.getElementById('overlay').style.display = 'flex';
    }

    function closePostForm() {
        document.getElementById("post-text").value = "";

        document.getElementById("file-upload").value = "";

        document.getElementById('overlay').style.display = 'none';
    }

    function clearPostForm() {
        document.getElementById("post-text").value = "";

        document.getElementById("file-upload").value = "";

        closePostForm();
    }

    function submitPost() {
        const postContent = document.getElementById("post-text").value;
        const fileInput = document.getElementById("file-upload");
        const file = fileInput.files[0];

        if (postContent) {
            const formData = new FormData();
            formData.append("post-text", postContent);
            if (file) {
                formData.append("file-upload", file);
            }

            fetch("save_post.php", {
                method: "POST",
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert("Error: " + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("An error occurred while saving the post.");
                });
        } else {
            alert("Write your post before clicking on 'post'");
        }
    }

    function deletePost(postId) {
        if (confirm("Are you sure you want to delete this post?")) {
            fetch("delete_post.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ post_id: postId })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert("Error: " + data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    }

    function toggleCommentInput(button) {
        const commentSection = button.nextElementSibling;
        commentSection.style.display = commentSection.style.display === "none" ? "block" : "none";
    }

    function submitComment(button, postId) {
        const commentSection = button.parentElement;
        const commentInput = commentSection.querySelector(".comment-input");
        const fileInput = commentSection.querySelector(".file-input");
        const commentText = commentInput.value;
        const file = fileInput.files[0];

        if (commentText || file) {
            const formData = new FormData();
            formData.append("post_id", postId);
            formData.append("comment-text", commentText);
            if (file) {
                formData.append("file-upload", file);
            }

            fetch("save_comment.php", {
                method: "POST",
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert("Error: " + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("An error occurred while saving the comment.");
                });
        } else {
            alert("Write your comment or attach a file before clicking on 'Send'");
        }
    }

    function deleteComment(commentId) {
        if (confirm("Are you sure you want to delete this comment?")) {
            fetch("delete_comment.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ comment_id: commentId }) // تأكد من إرسال comment_id
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload(); // إعادة تحميل الصفحة بعد الحذف
                    } else {
                        alert("Error: " + data.message); // عرض رسالة الخطأ
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    }

    function openImageModal(imageUrl) {
        const modal = document.createElement("div");
        modal.style.position = "fixed";
        modal.style.top = "0";
        modal.style.left = "0";
        modal.style.width = "100%";
        modal.style.height = "100%";
        modal.style.backgroundColor = "rgba(0, 0, 0, 0.7)";
        modal.style.display = "flex";
        modal.style.alignItems = "center";
        modal.style.justifyContent = "center";
        modal.style.zIndex = "1000";

        const img = document.createElement("img");
        img.src = imageUrl;
        img.style.maxWidth = "90%";
        img.style.maxHeight = "90%";
        img.style.borderRadius = "10px";

        modal.appendChild(img);
        document.body.appendChild(modal);

        modal.onclick = function (event) {
            if (event.target === modal) {
                document.body.removeChild(modal);
            }
        };
    }

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

    const upButton = document.getElementById('upButton');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 200) {
            upButton.classList.add('show');
        } else {
            upButton.classList.remove('show');
        }
    });

    upButton.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>
</body>
</html>