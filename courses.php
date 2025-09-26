<?php
session_start();
if (!isset($_SESSION['ismember']) || $_SESSION['ismember'] != 1) {
    header("location:slideLogin.php");
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
    <link rel="stylesheet" href="courses.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Wix+Madefor:wght@400;530;700;800&family=Aboreto&family=Alegreya:ital,wght@0,409;1,409&family=Concert+One&family=Forum&family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
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
            background: #c9aa92;
        }

        .up-button:hover svg {
            fill: #fff;
        }

        .up-button .tooltip {
            position: absolute;
            top: -40px;
            font-size: 14px;
            background: #c9aa92;
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

        @media (max-width: 1090px) {
            .Question p {
                position: relative;
                font-size: 25px;
                margin-top: -10%;
                left:12%;
            }

            .Question pre {
                font-size: 20px;
                margin-top: -13%;
                left: 2.5%;
            }

            .Question img {
                width: 90px;
                height: 135px;
                left: 472px;
                margin-top: -22%;
            }
            .desc{
                font-size: 18px;
            }
            iframe {
                width:300px ;
                height:200px ;
            }
        }

        @media (max-width: 780px) {
            .Question p {
                position: relative;
                font-size: 22px;
                margin-top: -12%;
                left:8%;
            }

            .Question pre {
                font-size: 18px;
                margin-top: -13%;
                left: -3%;
            }

            .Question img {
                width: 80px;
                height: 120px;
                left: 427px;
                margin-top: -22%;
            }
            .desc{
                font-size: 18px;
            }
            iframe {
                width:300px ;
                height:200px ;
            }
        }

        @media (max-width: 700px) {
            .Question p {
                position: relative;
                font-size: 18px;
                margin-top: -18%;
                left:4%;
            }

            .Question pre {
                font-size: 15px;
                margin-top: -25%;
                left: -8%;
            }

            .Question img {
                width: 60px;
                height: 100px;
                left: 346px;
                margin-top: -26%;
            }
            .div1{
                height: 400px;
            }
            .desc{
                font-size: 14px;
            }
            iframe {
                width:200px ;
                height:150px ;
            }
            .card{
                width: 90px;
                height: 90px;
                font-size: 12px;
            }
        }

        @media (max-width: 570px) {
            .Question p {
                position: relative;
                font-size: 15px;
                margin-top: -29%;
                left:-1%;
            }

            .Question pre {
                font-size: 12px;
                margin-top: -44%;
                left: -12%;
            }

            .Question img {
                width: 45px;
                height: 80px;
                left: 272px;
                margin-top: -36%;
            }
            .div1{
                height: 350px;
            }
            .desc{
                font-size: 12px;
            }
            iframe {
                width:200px ;
                height:150px ;
            }
            .card{
                width: 90px;
                height: 90px;
                font-size: 12px;
            }
        }

        @media (max-width: 520px) {
            .Question p {
                position: relative;
                font-size: 14px;
                margin-top: -32%;
                left:-4%;
            }

            .Question pre {
                font-size: 12px;
                margin-top: -46%;
                left: -18%;
            }

            .Question img {
                width: 45px;
                height: 80px;
                left: 272px;
                margin-top: -36%;
            }
            .div1{
                height: 350px;
            }
            .desc{
                font-size: 11px;
            }
            iframe {
                width:180px ;
                height:130px ;
            }
            .card{
                width: 90px;
                height: 90px;
                font-size: 10px;
            }
        }
        @media (max-width: 480px) {
            .Question p {
                position: relative;
                font-size: 12px;
                margin-top: -35%;
                left:-4%;
            }

            .Question pre {
                font-size: 11px;
                margin-top: -57%;
                left: -15%;
            }

            .Question img {
                width: 42px;
                height: 73px;
                left: 220px;
                margin-top: -47%;
            }
            .div1{
                height: 330px;
            }
            .desc{
                font-size: 8.5px;
            }
            iframe {
                width:130px ;
                height:100px ;
            }
            .card{
                width: 80px;
                height: 80px;
                font-size: 9.5px;
            }
            .menu button {
                font-size: 11px;
            }
            #dropdownBtn{
                width: 27px;
                height: 27px;
                bottom: 27%;
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
        <p> <b>Programming language courses</b> </p>
        <img src="img/online-learning.png" >
        <pre>
    Do you want to learn additional courses for

    some programming languages?
  </pre>
    </div>
</div>

<div class="all">
    <p> <b>-- All Courses --</b></p>
    <p> Click on the language you want to learn </p>
    <div class="courses">
        <div class="card">
        <a href="#JAVA" > Java </a>
        </div>
        <div class="card">
            <a href="#PYTHON" > PYTHON </a>
        </div>
        <div class="card">
            <a href="#C++" > C++ </a>
        </div>
        <div class="card">
            <a href="#js" > JavaScript </a>
        </div>
        <div class="card">
            <a href="#css" > CSS </a>
        </div>
        <div class="card">
            <a href="#html" > HTML </a>
        </div>
        <div class="card">
            <a href="#C" > C </a>
        </div>
        <div class="card">
            <a href="#JavaFX" > JavaFX </a>
        </div>
        <div class="card">
            <a href="#REACT" > REACT </a>
        </div>
        <div class="card">
            <a href="#PHP" > PHP </a>
        </div>
        <div class="card">
            <a href="#SQL" > SQL </a>
        </div>
        <div class="card">
            <a href="#C#" > C# </a>
        </div>
        <div class="card">
            <a href="#AJAX" > AJAX </a>
        </div>
        <div class="card">
            <a href="#XML" > XML </a>
        </div>
        <div class="card">
            <a href="#MySQL" > MySQL </a>
        </div>
        <div class="card">
            <a href="#DataStructure" > Data Structure </a>
        </div>
        <div class="card">
            <a href="#BOOTSTRAP" > BOOTSTRAP  </a>
        </div>
        <div class="card">
            <a href="#JQUERY" > JQUERY  </a>
        </div>
        <div class="card">
            <a href="#TypeScript" > TypeScript  </a>
        </div>
        <div class="card">
            <a href="#Nodejs" > Node.js  </a>
        </div>
        <div class="card">
            <a href="#MongoDB" > MongoDB  </a>
        </div>
    </div>
</div>

<div id="JAVA">
<p> <b>-- Java Courses --</b></p>
    <table cellspacing="30px">
        <tr>
            <td colspan="2" style="align-items: center">
    <p class="desc"> Java is an object-oriented programming language utilized for creating cross-platform applications. It is recognized for its portability due to the Java Virtual Machine (JVM), enabling Java applications to operate across different platforms. Java is commonly utilized in web applications, Android development, and embedded systems.
    </p>
            </td>

        </tr>
        <tr>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLCInYL3l2AajYlZGzU_LVrHdoouf8W6ZN"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLCInYL3l2AagY7fFlhCrjpLiIFybW3yQv"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLZPZq0r_RZOOj_NOZYq_R2PECIMglLemc"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
        </tr>
    </table>
</div>

<div id="PYTHON">
    <p> <b>-- Python Courses --</b></p>
    <table cellspacing="30px">
        <tr>
            <td colspan="2" style="align-items: center">
                <p class="desc"> Python is a high-level, interpreted coding language that is simple to master. It is crafted to be straightforward and easy, making it perfect for newcomers. Python is recognized for its robust libraries that make tasks easier in areas like web development, data analysis, artificial intelligence, machine learning, and automation. It is a flexible language, indicating it can be utilized in numerous applications.
                </p>
            </td>

        </tr>
        <tr>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLDoPjvoNmBAyE_gei5d18qkfIe-Z8mocs"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
            <td >
                <iframe width="500" height="300" src="https://www.youtube.com/embed/ix9cRaBkVe0?si=fmLTiKCMRvQ6-86e" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </td>
        </tr>
    </table>
</div>


<div id="C++">
    <p> <b>-- C++ Courses --</b></p>
    <table cellspacing="30px">
        <tr>
            <td colspan="2" style="align-items: center">
                <p class="desc">C++ is a versatile, high-efficiency programming language designed for various purposes. It is commonly utilized for system software, game creation, and applications that demand high speed and efficiency. C++ supports both procedural and object-oriented programming, providing flexibility and control of system resources.
                </p>
            </td>

        </tr>
        <tr>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLCInYL3l2Aaiq1oLvi9TlWtArJyAuCVow"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLCInYL3l2AajFAiw4s1U4QbGszcQ-rAb3"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLZPZq0r_RZOMHoXIcxze_lP97j2Ase2on"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>            </td>
        </tr>
    </table>
</div>

<div id="js">
    <p> <b>-- JavaScript Courses --</b></p>
    <table cellspacing="30px">
        <tr>
            <td colspan="2" style="align-items: center">
                <p class="desc">JavaScript is a flexible, high-level programming language mainly utilized for web development. It allows for dynamic content and interactive functionalities on websites. JavaScript operates in the browser, making it crucial for client-side scripting, and it can also serve for server-side development through environments such as Node.js.
                </p>
            </td>

        </tr>
        <tr>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLknwEmKsW8OuTqUDaFRBiAViDZ5uI3VcE"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLDoPjvoNmBAx3kiplQR_oeDqLDBUDYwVv"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <iframe width="500" height="300" src="https://www.youtube.com/embed/lfmg-EJ8gm4?si=GLWl9mWsWA7eHOFB" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </td>
        </tr>
    </table>
</div>


<div id="css">
    <p> <b>-- CSS Courses --</b></p>
    <table cellspacing="30px">
        <tr>
            <td colspan="2" style="align-items: center">
                <p class="desc">CSS (Cascading Style Sheets) is a style sheet language utilized for defining the appearance of a web page created in HTML or XML. It manages the arrangement, colors, typefaces, and overall aesthetics of a webpage. CSS enables developers to design websites that are visually attractive and adaptable.
                </p>
            </td>

        </tr>
        <tr>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLDoPjvoNmBAzjsz06gkzlSrlev53MGIKe"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
            <td >
                <iframe width="500" height="300" src="https://www.youtube.com/embed/OXGznpKZ_sA?si=pljOfSbQvTQS_sb5" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </td>
        </tr>
    </table>
</div>

<div id="html">
    <p> <b>-- HTML Courses --</b></p>
    <table cellspacing="30px">
        <tr>
            <td colspan="2" style="align-items: center">
                <p class="desc">HTML (HyperText Markup Language) is the default language employed for developing and designing web pages. It organizes web content with components like headings, paragraphs, images, links, and others. HTML serves as the core of all web content, offering the basis for styling through CSS and functionality via JavaScript.
                </p>
            </td>

        </tr>
        <tr>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLDoPjvoNmBAw_t_XWUFbBX-c9MafPk9ji"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLP9IO4UYNF0VdAajP_5pYG-jG2JRrG72s"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>            </td>
        </tr>
    </table>
</div>

<div id="C">
    <p> <b>-- C Courses --</b></p>
    <table cellspacing="30px">
        <tr>
            <td colspan="2" style="align-items: center">
                <p class="desc">C is a versatile, procedural programming language commonly utilized for developing system and application software. It offers low-level memory access, which enhances efficiency for tasks such as operating systems, embedded systems, and applications that are critical for performance. C is recognized for its straightforwardness and robust capabilities, enabling direct control over hardware and memory, and it has impacted numerous other programming languages.
                </p>
            </td>

        </tr>
        <tr>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLRtfJqT1hc31ZP4tr3ijypE_0T-4PE_kZ"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLZPZq0r_RZOOzY_vR4zJM32SqsSInGMwe"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>            </td>
        </tr>
    </table>
</div>

<div id="JavaFX">
    <p> <b>-- JavaFX Courses --</b></p>
    <table cellspacing="30px">
        <tr>
            <td colspan="2" style="align-items: center">
                <p class="desc">JavaFX serves as a framework for creating immersive and interactive user interfaces in Java. It facilitates graphics, animations, and multimedia, allowing developers to build cross-platform desktop and web applications.
                </p>
            </td>

        </tr>
        <tr>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLwj1YcMhLRN1ISKdFo23inpSYyzXWrGDm"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLZPZq0r_RZOM-8vJA3NQFZB7JroDcMwev"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>            </td>
        </tr>
    </table>
</div>

<div id="REACT">
    <p> <b>-- REACT Courses --</b></p>
    <table cellspacing="30px">
        <tr>
            <td colspan="2" style="align-items: center">
                <p class="desc">React is a JavaScript library designed for creating user interfaces, especially for single-page applications. It enables developers to build reusable UI components, enhancing web applications' speed and efficiency by refreshing only the sections of the page that require updates.
                </p>
            </td>

        </tr>
        <tr>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLpr1Lg_f0v3ojNKR4WzZ_SEXhiKBHDQmB"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLZPZq0r_RZOMQArzyI32mVndGBZ3D99XQ"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>            </td>
        </tr>
    </table>
</div>

<div id="PHP">
    <p> <b>-- PHP Courses --</b></p>
    <table cellspacing="30px">
        <tr>
            <td colspan="2" style="align-items: center">
                <p class="desc">PHP is a popular server-side language utilized for developing dynamic and engaging web pages. It seamlessly connects with databases and is compatible with multiple frameworks for web development.
                </p>
            </td>

        </tr>
        <tr>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLDoPjvoNmBAy41u35AqJUrI-H83DObUDq"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLZPZq0r_RZOO6bGTY9jbLOyF_x6tgwcuB"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLS1QulWo1RIZc4GM_E04HCPEd_xpcaQgg&index=1"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
        </tr>
    </table>
</div>

<div id="SQL">
    <p> <b>-- SQL Courses --</b></p>
    <table cellspacing="30px">
        <tr>
            <td colspan="2" style="align-items: center">
                <p class="desc">SQL (Structured Query Language) is utilized for managing and manipulating databases, allowing efficient tasks such as data retrieval, insertion, updating, and deletion.
                </p>
            </td>

        </tr>
        <tr>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLsjUcU8CQXGFFAhJI6qTA8owv3z9jBbpd&index=1"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
        </tr>
    </table>
</div>

<div id="C#">
    <p> <b>-- C# Courses --</b></p>
    <table cellspacing="30px">
        <tr>
            <td colspan="2" style="align-items: center">
                <p class="desc">C# is a contemporary, object-oriented programming language created by Microsoft, commonly employed for developing desktop, web, and mobile applications.
                </p>
            </td>

        </tr>
        <tr>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLqPejUavRNTWrbmE7fTvBC1HH-sAmz7c3&index=1"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLZPZq0r_RZOPNy28FDBys3GVP2LiaIyP_"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
        </tr>
    </table>
</div>

<div id="AJAX">
    <p> <b>-- AJAX Courses --</b></p>
    <table cellspacing="30px">
        <tr>
            <td colspan="2" style="align-items: center">
                <p class="desc">AJAX (Asynchronous JavaScript and XML) is a method in web development that permits data to be retrieved or transmitted to a server without reloading the webpage, facilitating dynamic and quicker user experiences.
                </p>
            </td>

        </tr>
        <tr>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLDoPjvoNmBAytfRIdMIkLeoQHP0o5uWBa"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
        </tr>
    </table>
</div>

<div id="XML">
    <p> <b>-- XML Courses --</b></p>
    <table cellspacing="30px">
        <tr>
            <td colspan="2" style="align-items: center">
                <p class="desc">XML (eXtensible Markup Language) is a versatile format for managing and transferring data. It arranges information in a clear, structured format, making it commonly utilized for data transfer between systems.
                </p>
            </td>

        </tr>
        <tr>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLImps_mlpW35B0z0D0SHw8hr9Zc0esUk1"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
        </tr>
    </table>
</div>

<div id="MySQL">
    <p> <b>-- MYSQL Courses --</b></p>
    <table cellspacing="30px">
        <tr>
            <td colspan="2" style="align-items: center">
                <p class="desc">MySQL is a relational database management system (RDBMS) that is open-source and designed for efficient data storage, management, and retrieval. It is recognized for its quickness, dependability, and user-friendliness, which makes it a favorite for web applications and data-centric initiatives.
                </p>
            </td>

        </tr>
        <tr>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLZPZq0r_RZOMskz6MdsMOgxzheIyjo-BZ"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
        </tr>
    </table>
</div>

<div id="DataStructure">
    <p> <b>-- Data Structure Courses --</b></p>
    <table cellspacing="30px">
        <tr>
            <td colspan="2" style="align-items: center">
                <p class="desc">Data structures are structured methods for storing, handling, and retrieving data effectively. They serve as the foundation of algorithms and software systems, facilitating operations such as searching, sorting, and data handling. Typical types consist of arrays, linked lists, stacks, queues, trees, and graphs.
                </p>
            </td>

        </tr>
        <tr>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLCInYL3l2AajqOUW_2SwjWeMwf4vL4RSp"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLZPZq0r_RZON1eaqfafTnEexRzuHbfZX8"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
        </tr>
    </table>
</div>

<div id="BOOTSTRAP">
    <p> <b>-- BOOTSTRAP Courses --</b></p>
    <table cellspacing="30px">
        <tr>
            <td colspan="2" style="align-items: center">
                <p class="desc">Bootstrap is a widely-used front-end framework for creating responsive and mobile-first websites. It offers ready-made elements such as buttons, navigation menus, and grids, streamlining web development and simplifying the process.
                </p>
            </td>

        </tr>
        <tr>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLDoPjvoNmBAyvm7f--dc6XqkpfDcen_vQ"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLknwEmKsW8OscL9GvjxwL7RYbcwwdIitk"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
        </tr>
    </table>
</div>

<div id="JQUERY">
    <p> <b>-- JQUERY Courses --</b></p>
    <table cellspacing="30px">
        <tr>
            <td colspan="2" style="align-items: center">
                <p class="desc">jQuery is a lightweight and speedy JavaScript library that streamlines the manipulation of HTML DOM, event handling, and animations. It enables developers to create more features with less code and guarantees compatibility across different browsers.
                </p>
            </td>
        </tr>
        <tr>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLDoPjvoNmBAwXDFEEpc8TT6MFbDAC5XNB"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
        </tr>
    </table>
</div>

<div id="TypeScript">
    <p> <b>-- TypeScript Courses --</b></p>
    <table cellspacing="30px">
        <tr>
            <td colspan="2" style="align-items: center">
                <p class="desc">TypeScript is an extension of JavaScript that incorporates static typing into the language. It enables developers to identify errors early in the development process, offers enhanced tooling support, and enhances code maintainability. TypeScript code gets transformed into standard JavaScript, ensuring compatibility with every browser and environment.
                </p>
            </td>

        </tr>
        <tr>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLDoPjvoNmBAy532K9M_fjiAmrJ0gkCyLJ"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
        </tr>
    </table>
</div>

<div id="Nodejs">
    <p> <b>-- Node.js Courses --</b></p>
    <table cellspacing="30px">
        <tr>
            <td colspan="2" style="align-items: center">
                <p class="desc">Node.js is a JavaScript runtime created on Chrome's V8 engine, enabling developers to execute JavaScript code on the server side. It is intended to create scalable and high-performance applications, especially for I/O-intensive tasks such as web servers, APIs, and real-time applications. Node.js operates on an event-driven and non-blocking model, making it effective for managing simultaneous tasks.
                </p>
            </td>

        </tr>
        <tr>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLTjRvDozrdlydy3uUBWZlLUTNpJSGGCEm"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
        </tr>
    </table>
</div>

<div id="MongoDB">
    <p> <b>-- MongoDB Courses --</b></p>
    <table cellspacing="30px">
        <tr>
            <td colspan="2" style="align-items: center">
                <p class="desc">MongoDB is a NoSQL database that saves information in a flexible format resembling JSON. It is recognized for its scalability, efficiency, and user-friendliness, which makes it perfect for handling significant amounts of unstructured data.
                </p>
            </td>

        </tr>
        <tr>
            <td >
                <iframe width="500" height="300"
                        src="https://www.youtube.com/embed/videoseries?list=PLZPZq0r_RZONbmOn3EsHac5u5_-Rue3ne"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                </iframe>
            </td>
        </tr>
    </table>
</div>

<p class="feed"><b>For Feedback</b></p>

<div class="para">
    <p>If you have any feedback, such as adding a new material or course, please feel free to let us know
        <br>via the <a id="cont" href="firstPage.php#Contact"><u>Contact Us</u></a> section on the home page.</p>
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

