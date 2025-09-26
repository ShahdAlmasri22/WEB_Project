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
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="icon" type="image/png" href="img/book.png">
    <style>
        body {
            background: #af9886;
            overflow: hidden;
        }
        .carousel-indicators li::after {
            content: "";
        }

        .carousel-indicators {
            list-style-type: none;
            padding: 0;
            margin: 0;
            position: absolute;
            bottom: -50px;
            left: 50%;
            transform: translateX(-50%);
        }

        .carousel-item img {
            margin-top: 10px;
            margin-left: 300px;
            height: 550px;
        }

        .carousel-indicators [data-bs-target] {
            border-radius: 50%;
            width: 10px;
            height: 10px;
            margin: 5px;
            display: inline-block;
        }

        .carousel-indicators li {
            text-indent: -9999px;
        }

        .carousel-item .btn {
            line-height: 1;
            display: flex;
            position: absolute;
            bottom: 5px;
            left: 440px;
            background: none;
            color: white;
            padding: 10px 20px;
            border-radius: 20px;
            border: 1px solid white;
            height: 33px;
            text-align: center;
            width: 250px;
            text-decoration: none;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        .container{
            position: absolute;
            display: flex;
            margin-top:120px;
            margin-left: 185px;
        }
        .carousel-item .btn:hover {
            transform: scale(1.1);
        }

        #mynav {
            position: fixed;
            top: 0;
            left: -27px;
            right: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            height: 80px;
            background-color: #f5ede8;
        }

        .menu {
            display: flex;
            gap: 20px;
        }

        .menu a{
            display: inline-block;
            text-decoration: none;
        }

        .menu button {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            color: #805436;
            font-weight: bold;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .menu button:hover {
            color: #f0eff1;
            background-color: #af9886;
            border-radius: 40em;
            transform: scale(1.1);
        }

        .carousel{
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.4);
            border-radius: 10px;
        }

        .submit-btn {
            display: flex;
            position: fixed;
            bottom: 40px;
            right: 190px;
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
            background-color: #f5ede8;
            color: #805436;
            padding: 12px 25px;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 1px;
            cursor: pointer;
            box-shadow: -5px 6px 20px 0px rgba(0, 0, 0, 0.57);
            z-index: 999;
            font-family: 'Poppins', sans-serif;
            visibility: visible;
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
        }

        .submit-btn:hover {
            transform: scale(1.1);
            box-shadow: -5px 6px 20px 0px rgba(35, 35, 35, 0.57);
        }

        .submit-btn.hidden {
            visibility: hidden;
            opacity: 0;
        }

        @media (max-width: 1520px) {
            .container  {
                left: 12%;
                top:8%;
            }

            .container {
                margin-top: 80px;
                margin-left: 0;
                width: 100%;
            }

            .carousel-indicators {
                bottom: -40px;
            }

            .submit-btn {
                display: flex;
                bottom: 9% ;
                width: 147px;

            }

            .menu button {
                font-size: 17px;
            }
        }

        @media (max-width: 1401px) {
            .container  {
                left: 12%;
                top:8%;
            }

            .carousel-indicators {
                bottom: -40px;
            }

            .submit-btn {
                bottom: 9% ;
                left:77%;
                width: 147px;

            }

            .menu button {
                font-size: 17px;
            }
            .carousel-item img{
                margin-left: 27%;
            }

        }
        @media (max-width: 900px) {
            .container  {
                left: 12%;
                top:8%;
                width: 200px;

            }
            .carousel-item img{
                margin-left: 27%;
                /*height: 10%;*/

            }

            .carousel-indicators {
                bottom: -40px;

            }

            .submit-btn {
                bottom: 9% ;
                font-size: 11px;
                width: 136px;
                left: 73%;
            }

            .menu button {
                font-size: 17px;
            }
        }

        @media (max-width: 750px) {
            .container  {
                left: 12%;
                top:20%;
                width: 200px;

            }
            .carousel-item img{
                margin-left: 27%;
                height: auto;

            }

            .carousel-indicators {
                bottom: -40px;

            }

            .submit-btn {
                bottom: 36% ;
                font-size: 10px;
                width: 133px;
                height: auto;
                left: 73%;
            }

            .menu button {
                font-size: 13px;
            }


        }

        @media (max-width: 650px) {
            .container  {
                left: 12%;
                top:20%;
                width: 200px;

            }
            .carousel-item img{
                margin-left: 27%;
                height: auto;

            }

            .carousel-indicators {
                bottom: -40px;

            }

            .submit-btn {
                bottom: 38% ;
                font-size: 10px;
                width: 133px;
                height: auto;
                left: 73%;
            }

            .menu button {
                font-size: 13px;
            }


        }
        @media (max-width: 570px) {
            .container  {
                left: 12%;
                top:20%;
                width: 200px;

            }
            .carousel-item img{
                margin-left: 27%;
                height: auto;

            }

            .carousel-indicators {
                bottom: -40px;

            }

            .submit-btn {
                display: flex;
                bottom: 41% ;
                font-size: 8px;
                width: 124px;
                height: auto;
                left: 73%;
            }

            .menu button {
                font-size: 13px;
            }


        }
        @media (max-width: 570px) {
            .container  {
                left: 12%;
                top:27%;
                width: 200px;

            }
            .carousel-item img{
                margin-left: 27%;
                height: 220px;

            }

            .carousel-indicators {
                bottom: -40px;

            }

            .submit-btn {
                display: flex;
                bottom: 33% ;
                font-size: 8px;
                width: 120px;
                height: auto;
                left: 73%;
            }

            .menu button {
                font-size: 13px;
            }


        }
        @media (max-width: 480px) {
            .container  {
                left: 12%;
                top:27%;
                width: 200px;

            }
            .carousel-item img{
                margin-left: 27%;
                height: 220px;

            }

            .carousel-indicators {
                bottom: -40px;

            }

            .submit-btn {
                display: flex;
                bottom: 32% ;
                font-size: 7px;
                width: 109px;
                height: auto;
                left: 73%;
            }

            .menu button {
                font-size: 11px;
            }


        }

        @media (max-width: 400px) {
            .container  {
                left: 12%;
                top:27%;
                width: 200px;

            }
            .carousel-item img{
                margin-left: 27%;
                height: 220px;

            }

            .carousel-indicators {
                bottom: -40px;

            }

            .submit-btn {
                display: flex;
                bottom: 32% ;
                font-size: 7px;
                width: 100px;
                height: auto;
                left: 73%;
            }

            .menu button {
                font-size: 11px;
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
    </ul>
</nav>

<div id="slide" class="carousel slide container w-75" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#slide" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#slide" data-bs-slide-to="1"></li>
        <li data-bs-target="#slide" data-bs-slide-to="2"></li>
    </ol>

    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="img/Webinar-bro.png" alt="" class="w-50">
            <div class="submit-btn" id="course"> Courses Page </div>
        </div>
        <div class="carousel-item">
            <img src="img/Questions-pana.png" alt="" class="w-50">
            <div class="submit-btn" id="q&a">Q & A Page</div>
        </div>
        <div class="carousel-item">
            <img src="img/Search-amico.png" alt="" class="w-50">
            <div class="submit-btn" id="slide1">Slide & Stationery</div>
        </div>
    </div>

    <a href="#slide" class="carousel-control-next" data-bs-slide="next" id="nextBtn">
        <span class="carousel-control-next-icon"></span>
    </a>

    <a href="#slide" class="carousel-control-prev" data-bs-slide="prev" id="prevBtn">
        <span class="carousel-control-prev-icon"></span>
    </a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const submitBtns = document.querySelectorAll('.submit-btn');
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');

    nextBtn.addEventListener('click', function() {
        submitBtns.forEach(function(submitBtn) {
            submitBtn.classList.add('hidden');
        });

        setTimeout(function() {
            submitBtns.forEach(function(submitBtn) {
                submitBtn.classList.remove('hidden');
            });
        }, 630);
    });

    prevBtn.addEventListener('click', function() {
        submitBtns.forEach(function(submitBtn) {
            submitBtn.classList.add('hidden');
        });

        setTimeout(function() {
            submitBtns.forEach(function(submitBtn) {
                submitBtn.classList.remove('hidden');
            });
        }, 630);
    });

    document.getElementById('course').addEventListener('click', function(event) {
        if (!event.target.closest('.carousel-control-prev') && !event.target.closest('.carousel-control-next')) {
            event.preventDefault();
            const link = 'courses.php';
            document.body.classList.add('fade-out');
            setTimeout(function() {
                window.location.href = link;
            }, 600);
        }
    });


    document.getElementById('q&a').addEventListener('click', function(event) {
        event.preventDefault();
        const link = 'question.php';
        document.body.classList.add('fade-out');
        setTimeout(function() {
            window.location.href = link;
        }, 700);
    });

    document.getElementById('slide1').addEventListener('click', function(event) {
        if (!event.target.closest('.carousel-control-prev') && !event.target.closest('.carousel-control-next')) {
            event.preventDefault();
            const link = 'Borrow.php';
            document.body.classList.add('fade-out');
            setTimeout(function() {
                window.location.href = link;
            }, 600);
        }
    });


</script>

</body>
</html>


