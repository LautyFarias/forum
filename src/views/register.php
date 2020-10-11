<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - NineNineChannel</title>
    <link rel="shortcut icon" href="../public/images/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
</head>

<body>
    <div id="background" class="deactive"></div>
    <div class="container">
        <section class="auth-section">
            <h1>Welcome to<br>NineNineChannel</h1>
            <form id="register-form">
                <div class="input-container">
                    <i class="fas fa-envelope"></i>
                    <input type="text" id="email-input">
                </div>
                <div class="input-container">
                    <i class="fas fa-user"></i>
                    <input type="text" id="username-input">
                </div>
                <div class="input-container">
                    <i class="fas fa-unlock"></i>
                    <input type="text" id="password-input">
                </div>
                <div class="input-container">
                    <i class="fas fa-lock"></i>
                    <input type="text" id="repassword-input">
                </div>
                <div class="input-container">
                    <i class="fas fa-align-left"></i>
                    <textarea id="description-input"></textarea>
                </div>
                <button id="submit-button" class="submit-button">Register</button>
            </form>
            <a href="/login">Are you registered? Login!</a>
        </section>
        <?php include 'includes/footer.html'; ?>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../public/js/register.js"></script>
</body>

</html>