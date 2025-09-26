<?php
session_start();
$_SESSION['ismember'] = 0;
$fn = "";
$ls = "";
$em = "";
$p = "";
$cp = "";
$error_message = ""; // إعادة تعيين رسالة الخطأ

$email = $password = 0;
$validmember = 0;
$ErrorMessage = 0;
$ErrorText = ""; // إعادة تعيين رسالة الخطأ

if (isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["email"]) && isset($_POST["pass"]) && isset($_POST["confpass"]) &&
    !empty($_POST["firstName"]) && !empty($_POST["lastName"]) && !empty($_POST["email"]) && !empty($_POST["pass"]) && !empty($_POST["confpass"])) {

    $fn = $_POST["firstName"];
    $ls = $_POST["lastName"];
    $em = $_POST["email"];
    $p = $_POST["pass"];
    $cp = $_POST["confpass"];

    if ($p !== $cp) {
        $error_message = "The Confirm Password does not match.";
    } else {
        try {
            $db = new mysqli("localhost", "root", "", "signup");
            if ($db->connect_error) {
                die("Connection failed: " . $db->connect_error);
            }

            // التحقق من وجود البريد الإلكتروني
            $checkEmailQuery = "SELECT * FROM userinfo WHERE Email = ?";
            $stmt = $db->prepare($checkEmailQuery);
            $stmt->bind_param("s", $em);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $error_message = "Email already exists. Please use a different email.";
            } else {
                // تشفير كلمة المرور
                $hashed_password = password_hash($p, PASSWORD_BCRYPT);

                // إدخال البيانات في قاعدة البيانات
                $qs = "INSERT INTO userinfo (First_Name, Last_Name, Email, Pass, Conf_pass)
                       VALUES (?, ?, ?, ?, ?)";
                $stmt = $db->prepare($qs);
                $stmt->bind_param("sssss", $fn, $ls, $em, $hashed_password, $hashed_password);

                if ($stmt->execute()) {
                    $_SESSION['ismember'] = 1;
                    $_SESSION['user_email'] = $em;
                    header("location: pages.php");
                    exit();
                } else {
                    $error_message = "Error creating account. Please try again.";
                }
            }

            $stmt->close();
            $db->close();
        } catch (Exception $e) {
            $error_message = "An error occurred. Please try again.";
        }
    }
}

if (isset($_POST["user"]) && isset($_POST["pass"]) && !empty($_POST["user"]) && !empty($_POST["pass"])) {

    $email = $_POST["user"];
    $password = $_POST["pass"];

    try {
        $db = new mysqli("localhost", "root", "", "signup");
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }

        // التحقق من صحة البريد الإلكتروني وكلمة المرور
        $stmt = $db->prepare("SELECT * FROM userinfo WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['Pass'])) {
                $validmember = 1;
                $_SESSION['ismember'] = 1;
                $_SESSION['user_email'] = $email;
                header("location: pages.php");
                exit();
            } else {
                $ErrorMessage = 1;
                $ErrorText = "The Email or Password is incorrect.";
            }
        } else {
            $ErrorMessage = 1;
            $ErrorText = "The Email or Password is incorrect.";
        }

        $stmt->close();
        $db->close();
    } catch (Exception $e) {
        $ErrorText = "An error occurred. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EDUHELP</title>
    <link rel="stylesheet" href="slideLogin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="img/book.png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js"></script>
    <script>
        window.onload = function() {
            var ani = lottie.loadAnimation({
                container: document.getElementById('ani'),
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: './loginani.json',
                preserveAspectRatio: 'none'
            });
        };
    </script>

    <style>
        .overlay2 {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1001;
        }

        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            padding: 20px;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            z-index: 1002;
            width:20%;
            height: 30%;
            text-align: center;
        }

        .popup h2 {
            margin-bottom: 20px;
            font-size: 20px;
            color: #805436;
            font-family: 'Poppins', sans-serif;
        }

        .popup input {
            width: 65%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #af9886;
            border-radius: 5px;
            font-size: 14px;
        }

        .popup button {
            background: #805436;
            color: #f5ede8;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-size: 13px;
            left: 30%;
            top: 68%;
        }

        .popup button:hover {
            background: #6a452d;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 17px;
            cursor: pointer;
            font-size: 20px;
            color: #805436;
        }
        #error-message-forgot {
            color: darkred;
            margin-bottom: 9px;
            font-size: 12px;
        }

        .overlay3 {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1001;
        }

        .popup3 {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            padding: 20px;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            z-index: 1002;
            width:25%;
            height: 35%;
            text-align: center;
        }

        .popup3 h2 {
            margin-bottom: 20px;
            font-size: 20px;
            color: #805436;
            font-family: 'Poppins', sans-serif;
        }

        .popup3 input {
            width: 65%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #af9886;
            border-radius: 5px;
            font-size: 14px;
        }

        .popup3 button {
            background: #805436;
            color: #f5ede8;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-size: 13px;
            left: 31%;
            top: 78%;
        }

        .popup3 button:hover {
            background: #6a452d;
        }

        #error-message-reset{
            color: darkred;
            margin-bottom: 9px;
            font-size: 12px;
        }

        .error {
            color: darkred;
            margin-bottom: 15px;
            font-size: 12px;
            display: block;
        }
    </style>
</head>
<body>
<button class="learn-more" onclick="window.location.href='firstPage.php'">
    <span class="circle" aria-hidden="true">
        <span class="icon arrow"></span>
    </span>
    <span class="button-text">Back Home</span>
</button>

<div class="container">
    <div class="form-container login-container">
        <form method="post" action="slideLogin.php" onsubmit="return Check()">
            <h2>Log In</h2>
            <input type="email" autocomplete="off" name="user" class="input" placeholder="Email" required id="emailL">
            <input type="password" autocomplete="off" name="pass" class="input" placeholder="Password" required id="passL">
            <p id="error-message2" class="error" style="color: darkred; margin-bottom: 25%; font-size: 15px"><?php echo $ErrorText; ?></p>

            <button class="sub" type="submit" style="font-size: 11pt">Submit</button>
            <br><br>

            <p style="position:relative; bottom: 20%; font-size: 10pt; top: -12%">
                Don't have an account? <a href="#" id="moveToSignUp">Sign Up</a> | <a href="forget">Forgot Password?</a>
            </p>

            <?php
            if (isset($_GET['password_reset']) && $_GET['password_reset'] === 'success') {
                echo "<script>alert('Password reset successfully. Please log in with your new password.');</script>";
            }
            ?>

        </form>
    </div>
    <div class="form-container signup-container">
        <form method="post" action="slideLogin.php" onsubmit="return handleSignUp(event)" style="z-index: 11">
            <h2>Sign Up</h2>
            <input type="text" autocomplete="off" name="firstName" class="input" placeholder="First Name" required value="<?php echo $fn; ?>">
            <input type="text" autocomplete="off" name="lastName" class="input" placeholder="Last Name" required value="<?php echo $ls; ?>">
            <input type="email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" autocomplete="off" name="email" id="email" class="input" placeholder="Email" required value="<?php echo $em; ?>">
            <input type="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d@$!%?&]{8,}$" autocomplete="off" name="pass" id="pass" class="input" placeholder="Password" required>
            <p id="passwordHelp" style="display:none; font-size: 6.5pt; color: gray;">
                Password must contain at least one uppercase letter, one lowercase letter, one number, and be at least 8 characters long.
            </p>
            <script>
                const passwordInput = document.getElementById("pass");
                const passwordHelp = document.getElementById("passwordHelp");

                passwordInput.addEventListener("focus", () => {
                    passwordHelp.style.display = "block";
                });

                passwordInput.addEventListener("blur", () => {
                    passwordHelp.style.display = "none";
                });
            </script>
            <input type="password" autocomplete="off" name="confpass" id="confpass" class="input" placeholder="Confirm Password" required>
            <p id="error-message" class="error" style="color: darkred; margin-bottom: 42%; font-size: 10px"><?php echo $error_message; ?></p>
            <button class="sub2" type="submit" style="font-size: 11pt">Create Account</button>
            <p class="b" style="bottom:5%; position: absolute; font-size: 10pt">Already have an account? <a href="#" id="moveToLogin">Log In</a></p>

            <?php
            // افتراض قراءة المدخلات من نموذج
            $Pass = $_POST['password'] ?? '';
            $Conf_pass = $_POST['confirm_password'] ?? '';

            // التحقق من المدخلات
            if ($Pass !== $Conf_pass) {
                $error_message= "The Confirm Password does not match.";
            }
            ?>

        </form>
    </div>
    <div class="overlay">
        <div class="overlay-panel">
            <div id="ani"></div>
        </div>
    </div>
</div>

<!-- Popup Forgot Password -->
<div class="overlay2" id="forgotPasswordOverlay">
    <div class="popup">
        <span class="close-btn" id="closeForgotPassword">&times;</span>
        <h2>Forgot Password</h2>
        <form id="forgotPasswordForm">
            <input type="email" name="email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" autocomplete="off" class="input" placeholder="Enter your email" required>
            <p id="error-message-forgot" class="error" style="color: darkred; margin-bottom: 15px;"></p>
            <button type="button" id="showResetPasswordPopup" class="sub">Reset Password</button>
        </form>
    </div>
</div>

<!-- Popup Reset Password -->
<div class="overlay3" id="resetPasswordOverlay">
    <div class="popup3">
        <span class="close-btn" id="closeResetPassword">&times;</span>
        <h2>Reset Password</h2>
        <form id="resetPasswordForm">
            <input type="password" name="new_password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d@$!%?&]{8,}$" class="input" placeholder="New Password" required id="newPasswordInput">
            <p id="passwordHelp1" style="display:none; font-size: 6.5pt; color: gray;">
                Password must contain at least one uppercase letter, one lowercase letter, one number, and be at least 8 characters long.
            </p>
            <input type="password" name="confirm_password" class="input" placeholder="Confirm Password" required>
            <p id="error-message-reset" class="error" style="color: darkred; margin-bottom: 20px;"></p>
            <button type="submit" class="sub">Update Password</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const container = document.querySelector(".container");
        const moveToSignUp = document.getElementById("moveToSignUp");
        const moveToLogin = document.getElementById("moveToLogin");

        moveToSignUp.addEventListener("click", (e) => {
            e.preventDefault();
            container.classList.add("active");
            document.getElementById("error-message").innerText = ""; // إعادة تعيين رسالة الخطأ
        });

        moveToLogin.addEventListener("click", (e) => {
            e.preventDefault();
            container.classList.remove("active");
            document.getElementById("error-message2").innerText = ""; // إعادة تعيين رسالة الخطأ
        });
    });

    function handleSignUp(event) {
        event.preventDefault();

        const form = event.target;
        const emailInput = document.getElementById("email");
        const errorMessage = document.getElementById("error-message");
        const pas = document.getElementById("pass");
        const confPass = document.getElementById("confpass");

        // التحقق من تطابق كلمة المرور
        if (pas.value !== confPass.value) {
            errorMessage.innerText = "The Confirm Password does not match.";
            pas.value = "";
            confPass.value = "";
            return; // إيقاف الإرسال إذا كانت كلمة المرور غير متطابقة
        }

        // إرسال النموذج إلى الخادم
        fetch(form.action, {
            method: 'POST',
            body: new FormData(form),
        })
            .then(response => response.text())
            .then(data => {
                if (data.includes("Email already exists")) {
                    errorMessage.innerText = "Email already exists. Please use a different email.";
                    emailInput.value = "";
                    pas.value = "";
                    confPass.value = "";
                } else {
                    window.location.href = "pages.php";
                }
            })
            .catch(error => {
                console.error("Error:", error);
            });
    }

    function Check() {
        var errorMessage = "<?php echo $ErrorText; ?>";
        if (errorMessage) {
            document.getElementById("error-message2").innerText = errorMessage;
        }
    }

    document.addEventListener("DOMContentLoaded", () => {
        const forgotPasswordOverlay = document.getElementById("forgotPasswordOverlay");
        const resetPasswordOverlay = document.getElementById("resetPasswordOverlay");
        const showResetPasswordPopup = document.getElementById("showResetPasswordPopup");
        const closeForgotPassword = document.getElementById("closeForgotPassword");
        const closeResetPassword = document.getElementById("closeResetPassword");
        const forgotPasswordForm = document.getElementById("forgotPasswordForm");
        const resetPasswordForm = document.getElementById("resetPasswordForm");
        const errorMessageForgot = document.getElementById("error-message-forgot");
        const errorMessageReset = document.getElementById("error-message-reset");

        function resetFormFields(form) {
            form.reset();
            if (form === forgotPasswordForm) {
                errorMessageForgot.innerText = "";
            } else if (form === resetPasswordForm) {
                errorMessageReset.innerText = "";
            }
        }

        const forgotPasswordLink = document.querySelector('a[href="forget"]');
        if (forgotPasswordLink) {
            forgotPasswordLink.addEventListener("click", (e) => {
                e.preventDefault();
                forgotPasswordOverlay.style.display = "block";
            });
        }

        if (closeForgotPassword) {
            closeForgotPassword.addEventListener("click", () => {
                forgotPasswordOverlay.style.display = "none";
                resetFormFields(forgotPasswordForm);
            });
        }

        if (showResetPasswordPopup) {
            showResetPasswordPopup.addEventListener("click", async (e) => {
                e.preventDefault();

                const email = forgotPasswordForm.querySelector('input[name="email"]').value;

                const response = await fetch("forgot_password.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: `email=${encodeURIComponent(email)}`,
                });

                const data = await response.json();

                if (data.status === "success") {
                    forgotPasswordOverlay.style.display = "none";
                    resetPasswordOverlay.style.display = "block";
                } else {
                    errorMessageForgot.innerText = data.message;
                }
            });
        }

        if (closeResetPassword) {
            closeResetPassword.addEventListener("click", () => {
                resetPasswordOverlay.style.display = "none";
                resetFormFields(resetPasswordForm);
            });
        }

        if (resetPasswordForm) {
            resetPasswordForm.addEventListener("submit", async (e) => {
                e.preventDefault();

                const newPassword = resetPasswordForm.querySelector('input[name="new_password"]').value;
                const confirmPassword = resetPasswordForm.querySelector('input[name="confirm_password"]').value;

                if (newPassword !== confirmPassword) {
                    errorMessageReset.innerText = "Passwords do not match.";
                    return;
                }

                const response = await fetch("reset_password.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: `new_password=${encodeURIComponent(newPassword)}&confirm_password=${encodeURIComponent(confirmPassword)}`,
                });

                if (response.ok) {
                    window.location.href = "slideLogin.php?password_reset=success";
                } else {
                    errorMessageReset.innerText = "An error occurred. Please try again.";
                }
            });
        }

        window.addEventListener("click", (e) => {
            if (e.target === forgotPasswordOverlay) {
                forgotPasswordOverlay.style.display = "none";
                resetFormFields(forgotPasswordForm);
            }
            if (e.target === resetPasswordOverlay) {
                resetPasswordOverlay.style.display = "none";
                resetFormFields(forgotPasswordForm);
                resetFormFields(resetPasswordForm);
            }
        });
    });
</script>
</body>
</html>