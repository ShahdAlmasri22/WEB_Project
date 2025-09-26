<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDUHELP</title>
    <link rel="stylesheet" href="firstPage.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Wix+Madefor:wght@400;530;700;800&family=Aboreto&family=Alegreya:ital,wght@0,409;1,409&family=Concert+One&family=Forum&family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="img/book.png">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/lottie-web@5.7.8/build/player/lottie.min.js"></script>
<script>
    window.onload = function() {
        var animation = lottie.loadAnimation({
            container: document.getElementById('animation'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: 'Page.json'
        });
    };
</script>
<style>
    html, body {
        scroll-behavior: smooth;
        margin: 0;
        padding: 0;
        height: 100%;
        overflow-x: hidden;
        font-family: 'Poppins', sans-serif;
        background-color: #f5ede8;
        transition: opacity 0.5s ease;

    }
    .Btn {
        display: flex;
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 45px;
        height: 45px;
        background: linear-gradient(#af9886, #cab1a2);
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        cursor: pointer;
        border: none;
        z-index: 1000;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: background 0.3s ease, opacity 0.3s ease, visibility 0.3s ease;
        opacity: 0;
        display: none;
    }


    .arrow path {
        fill: white;
    }

    .text {
        font-size: 0.7em;
        width: 100px;
        position: absolute;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        bottom: -18px;
        opacity: 0;
        transition-duration: .7s;
    }

    .Btn:hover .text {
        opacity: 1;
        transition-duration: .7s;
    }

    .Btn:hover .arrow {
        animation: slide-in-bottom .7s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
    }

    @keyframes slide-in-bottom {
        0% {
            transform: translateY(10px);
            opacity: 0;
        }

        100% {
            transform: translateY(0);
            opacity: 1;
        }
    }
    .fade-out {
        opacity: 0;
    }

    footer .Site {
        position: absolute;
        left: 40%;
    }
    .start{
        margin-top: 68%;
        margin-left: -74%;
    }


    @media (min-width: 1088px) and (max-width: 1235px) {

        #animation {
            width:38%;
            height: auto;
        }

        .about {
            top: 14%;
            font-size: 1.5em;
            margin-top: 30px;
            width: 16em;
            height: 14em;
        }

        .start {
            position: absolute;
            margin-top: 60%;
            font-size: .7em;
            left: 5%;
        }


        #mynav .menu {
            flex-direction: row;
            justify-content: center;
            gap: 20px;
            font-size: 12px;
        }

        #divAbout #table1 {
            display: flex;
            flex-direction: row;
            align-items: center;
        }


        #divAbout #table1 img {
            width: 120%;
            height: auto;
        }
        #divAbout #table1 p{
            font-size: 14px;
        }

        #about-us {
            font-size: 1.8em;
        }

        .Services {
            flex-direction: row;
            justify-content: space-around;
        }

        .box {
            width: 20%;
        }
        #Share p{
            font-size: 10px;
            width: 200px;
        }

        #ServiceTitle{
            font-size: 1.4px;
        }
        .contact-img {
            width: 25%;
            height: auto;
        }

        .contact-button {
            font-size: 1em;
        }

        .social-links {
            flex-direction: row;
            justify-content: center;
        }
        .social-links a{
            font-size: 1em;
        }

        .designer, .copyright {
            text-align: center;
        }
        .contact-container h1{
            font-size: 1.7em;
        }
        .description{
            font-size: 1em;
        }
        #contact{
            margin-left: 2%;
        }
    }

    @media (min-width: 778px) and (max-width: 1088px) {

        #animation {
            width:42%;
            height: auto;
        }

        .about {
            top: 22%;
            font-size: 1.1em;
            width: 16em;
            height: 14em;
        }

        .start {
            position: absolute;
            margin-top: 60%;
            font-size: .7em;
            left: 81%;
            width: 90px;
            height: 23px;
        }

        .menu button {
            font-size: 14px;
        }

        #mynav .menu {
            flex-direction: row;
            justify-content: center;
            gap: 20px;
        }

        #divAbout #table1 {
            display: flex;
            flex-direction: row;
            align-items: center;
        }


        #divAbout #table1 img {
            width: 116%;
            height: auto;
        }
        #divAbout #table1 p{
            font-size: 11px;
            padding-left: 15%;
            margin: 0;
        }

        #about-us {
            font-size: 1.8em;
            padding-left: 6%;
        }

        .Services {
            flex-direction: row;
            justify-content: space-around;
        }

        #ServiceTitle{
            padding: 10px;
            margin: 0;
            font-size: 1.4em;
        }
        .box {
            width: 18%;
            height: 58%;
        }
        #Share p{
            font-size: 10px;
            width: 180px;
        }

        .contact-img {
            width: 25%;
            height: auto;
        }

        .contact-button {
            font-size: 1em;
        }

        .social-links {
            flex-direction: row;
            justify-content: center;
        }
        .social-links p{
            font-size: 0.8em;
        }

        .designer, .copyright {
            text-align: center;
        }
        .contact-container h1{
            font-size: 1.6em;
        }
        .description{
            font-size: 1em;
        }
        #contact{
            margin-left: -1%;
        }
        .container{
            height: 83%;
        }
    }

    @media (min-width: 635px) and (max-width: 778px) {

        #animation {
            width:42%;
            height: auto;
            top:20%;
            right: 5%;
        }

        .about {
            top: 22%;
            font-size: 1em;
            width: 14em;
            height: 12em;
            left: 5%;
        }

        .start {
            position: absolute;
            margin-top: 60%;
            font-size: .6em;
            left: 81%;
            width: 90px;
            height: 23px;
        }

        .menu button {
            font-size: 13px;
        }

        #mynav .menu {
            display: flex;
            flex-direction: row;
            justify-content: left;
            gap: 20px;
        }

        #page1{
            height: 470px;
        }

        #divAbout #table1 {
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        #divAbout #table1 img {
            width: 100%;
            height: auto;
        }
        #divAbout #table1 p{
            font-size: 10px;
            padding-left: 15%;
            margin: 0;
        }

        #about-us {
            font-size: 1.4em;
            padding-left: 6%;

        }

        #ServiceTitle{
            padding: 10px;
            margin: 0;
            font-size: 1.2em;
        }
        .Services {
            flex-direction: row;
            justify-content: space-around;
        }

        .box {
            width: 16%;
            height: 50%;
            display: grid;
        }
        #Share p{
            font-size: 8px;
            width: 120px;
        }

        .contact-img {
            width: 22%;
            height: auto;
        }

        .contact-button {
            font-size: 0.7em;
        }

        .social-links {
            flex-direction: row;
            justify-content: center;
        }
        .social-links p{
            font-size: 0.7em;
        }

        .designer, .copyright {
            text-align: center;
        }
        .contact-container h1{
            font-size: 1.4em;
        }
        .description{
            font-size: 0.7em;
        }
        #contact{
            margin-left: -2%;
        }
        .container{
            height: 61%;
        }
    }

    @media (min-width: 487px) and (max-width: 635px) {

        #animation {
            width:40%;
            height: auto;
            top:22%;
            right: 5%;
        }

        .about {
            top: 22%;
            font-size: 0.7em;
            width: 16em;
            height: 13em;
            left: 4%;
        }

        .start {
            position: absolute;
            margin-top: 53%;
            font-size: .4em;
            left: 83%;
            width: 50px;
            height: 22px;
            border-width: 0 1px 1px 0;
            --arrow-width: 8px;
            --arrow-stroke: 1.5px;
        }


        .start .arrow::before {
            padding: 2px;
            top: -2.5px;
            right: 2px;
        }

        .menu button {
            font-size: 11px;
        }
        #mynav{
            height: 60px;
        }

        #mynav .menu {
            display: flex;
            flex-direction: row;
            justify-content: left;
            gap: 20px;
        }

        #page1{
            height: 380px;
        }

        #divAbout #table1 img {
            width: 90%;
            height: auto;
        }

        #divAbout #table1 p{
            font-size: 8px;
            padding-left: 15%;
            margin: 0;
        }

        #about-us {
            font-size: 1.4em;
            padding-left: 6%;
        }

        .Services {
            flex-direction: row;
            justify-content: space-around;
        }
        #ServiceTitle{
            padding: 10px;
            margin: 0;
            font-size: 1.2em;
        }

        .box {
            width: 19%;
            height: 50%;
            display: grid;
            left: -17px;
        }
        #Share p{
            font-size: 7px;
            width: 90px;
            left: 0px;
            margin-left: -3%;
        }

        .contact-img {
            width: 20%;
            height: auto;
        }

        .contact-button {
            font-size: 0.6em;
        }

        .social-links {
            flex-direction: row;
            justify-content: center;
        }
        .social-links p{
            font-size: 0.6em;
        }

        .designer, .copyright {
            text-align: center;
        }
        .contact-container h1{
            font-size: 1.1em;
        }
        .description{
            font-size: 0.6em;
        }
        #contact{
            margin-left: -3%;
        }
        .container{
            height: 50.5%;
        }
    }

    @media  (max-width: 487px) {

        #animation {
            width:40%;
            height: auto;
            top:22%;
            right: 5%;
        }

        .about {
            top: 26%;
            font-size: 0.56em;
            width: 13em;
            height: 11em;
            left: 0%;
        }

        .start {
            position: absolute;
            margin-top: 56%;
            font-size: .35em;
            left: 85%;
            width: 47px;
            height: 19px;
            border-width: 0 1px 1px 0;
            --arrow-width: 8px;
            --arrow-stroke: 1.5px;
        }


        .start .arrow::before {
            padding: 2px;
            top: -2.5px;
            right: 2px;
        }

        .menu button {
            font-size: 9.5px;
        }
        #mynav{
            height: 60px;
        }

        #mynav .menu {
            display: flex;
            flex-direction: row;
            justify-content: left;
            gap: 20px;
        }

        #page1{
            height: 300px;
        }

        #divAbout #table1 img {
            width: 87%;
            height: auto;
        }

        #divAbout #table1 p{
            font-size: 6.7px;
            padding-left: 15%;
            margin: 0;
        }

        #about-us {
            font-size: 1em;
            padding-left: 6%;
        }

        .Services {
            flex-direction: row;
            justify-content: space-around;
        }

        .box {
            width: 18%;
            height: 43%;
            display: grid;
            left: -17px;
        }
        #Share p{
            font-size: 5.6px;
            width: 80px;
            left: 0px;
            margin-top: 0;
            margin-left: -3%;
        }
        #ServiceTitle{
            padding: 10px;
            margin: 0;
            font-size: 1em;
        }

        .contact-img {
            width: 19%;
            height: auto;
        }

        .contact-button {
            font-size: 0.5em;
        }

        .social-links {
            flex-direction: row;
            justify-content: center;
        }
        .social-links p{
            font-size: 0.5em;
        }

        .designer, .copyright {
            text-align: center;
        }
        .contact-container h1{
            font-size: 1em;
        }
        .description{
            font-size: 0.5em;
        }
        #contact{
            margin-left: -4%;
        }
        .container{
            height: 50%;
        }
    }

</style>

<div id="page1">
    <div id="animation" style="display: flex"></div>
    <p class="about" style="display: flex">
        Welcome to website! <br>
        Explore, share, <br>and connect with <br>
        educational resources <br>to enhance <br>your learning.
        <button class="start" onclick="window.location.href = 'slideLogin.php';">
            Start
            <div class="arrow-wrapper">
                <div class="arrow"></div>
            </div>
        </button>
    </p>
</div>

<nav id="mynav">
    <ul class="menu" >
        <li><a href="slideLogin.php"><button>Log In</button></a></li>
        <a href="#divAbout"><li><button>About</button></li></a>
        <a href="#Ser"><li><button>Services</button></li></a>
        <a href="#contact"><li><button>Contact us</button></li></a>
    </ul>
</nav>

<button class="Btn" id="backToTopBtn">
    <svg height="1.2em" class="arrow" viewBox="0 0 512 512">
        <path d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z"></path>
    </svg>
    <p class="text">Back to Top</p>
</button>

<div id="divAbout">
    <table id="table1" class="hidden-section">
        <tr>
            <td><img src="img/About us page-amico.png" alt="" id="S"></td>
            <td>
                <span id="about-us">About Us</span>
                <p>Hello and welcome! What we offer is a site for swapping and sharing slides and stationery among students. Materials that you are willing to exchange with your colleagues are posted on the website, and communication with colleagues is done through integrated chat. There is also a place to ask questions about the various materials or provide information about the materials that can be used to ask the questions. And we’ve also included educational courses for you to enhance and widen up your skills. Our mission is to promote interaction between students through the sharing of knowledge and educational resources. Sign up today and start exchanging materials as well as enjoying the courses!</p>
            </td>
        </tr>
    </table>
</div>

<div id="Ser" class="hidden-section">
    <p id="ServiceTitle" >Services</p>
    <div class="Services">
        <div class="box">
            <img src="img/borrow.png" alt="">
            <p class="all">Share & Borrow</p>
        </div>
        <div class="box">
            <img src="img/Online world-cuate.png" alt="">
            <p class="all" style="text-align: center;">Q & A</p>
        </div>
        <div class="box">
            <img src="img/Course app-amico.png" alt="">
            <p class="all">Learn Courses</p>
        </div>
    </div>
    <div id="Share">
        <p>You can easily find the stationery or slides you need by browsing through available posts shared by other students. If you can't find what you're looking for, you can create a post explaining what you need or would like to borrow.</p>
        <p>There is a built-in chat to communicate directly with your colleagues, in addition to a dedicated box to post your questions about the study materials or request to borrow the tools you need.</p>
        <p>We provide educational courses dedicated to supporting the study materials and everything you need to develop your skills. Whether you are looking for an explanation of the materials or additional resources.</p>
    </div>
</div>

<div class="hidden-section container">
    <div class="contact-container" id="contact">
        <h1>Contact Us</h1>
        <p class="description">We're here to help! If you have any inquiries, feel free to reach out to us.</p>
    
        <img src="img/Mail sent-amico.png" alt="Contact Image" class="contact-img">
    
        <a href="mailto:shahd.227.almasri@gmail.com,asmarsamia2003@gmail.com" class="contact-button">Send an Email</a>
        <div class="social-links">
            <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
            <a href="mailto:asmarsamia2003@gmail.com,shahd.227.almasri@gmail.com"><i class="fas fa-envelope"></i></a>
          <p class="designer">Designed by Samia Asmar and Shahd Almasri</p>
          <p class="copyright">©️ 2025 All Rights Reserved</p>
      </div>
</div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => entry.isIntersecting && entry.target.classList.add("visible"));
        }, { threshold: 0.5 });

        document.querySelectorAll(".hidden-section").forEach(section => observer.observe(section));
    });


    document.addEventListener("DOMContentLoaded", () => {
        const backToTopBtn = document.getElementById("backToTopBtn");

        window.addEventListener("scroll", () => {
            console.log("Scroll position:", window.scrollY);
            if (window.scrollY > -300) {
                backToTopBtn.style.display = "flex";
                backToTopBtn.style.opacity = "1";
            } else {
                backToTopBtn.style.display = "none";
                backToTopBtn.style.opacity = "0";
            }
        });

        backToTopBtn.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    });

    document.querySelector('a[href="slideLogin.php"]').addEventListener('click', function(event) {
        event.preventDefault();
        const link = this.href;
        document.body.classList.add('fade-out');
        setTimeout(function() {
            window.location.href = link;
        }, 500);
    });
    document.getElementsByClassName('start')[0].addEventListener('click', function(event) {
        event.preventDefault();
        const link = 'slideLogin.php';
        document.body.classList.add('fade-out');
        setTimeout(function() {
            window.location.href = link;
        }, 500);
    });

    document.getElementById('loginButton').addEventListener('click', function() {
        window.location.href = 'slideLogin.php';
    });
</script>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = htmlspecialchars($_POST['firstName']);
    $lastName = htmlspecialchars($_POST['lastName']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $to = "asmarsami2003@gmail.com, shahd.227.almasri@gmail.com";

    $headers = "From: $email" . "\r\n" .
        "Reply-To: $email" . "\r\n" .
        "X-Mailer: PHP/" . phpversion();

    $emailContent = "First Name: $firstName\n" .
        "Last Name: $lastName\n" .
        "Email: $email\n" .
        "Subject: $subject\n" .
        "Message: $message\n";

    if (mail($to, $subject, $emailContent, $headers)) {
    } else {
    }
}
?>
</body>
</html>