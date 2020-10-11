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
            <h1>
                Welcome to<br>
                NineNineChannel
            </h1>
            <form id="login-form">
                <div>
                    <i class="fas fa-envelope"></i>
                    <input type="text" id="email-input" name="email" required>
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password-input" name="password" required>
                </div>
                <button id="submit-button" class="submit-button">Login</button>
            </form>
            <a href="/register">Are you not registered?</a>
        </section>
        <?php include 'includes/footer.html'; ?>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../public/js/login.js"></script>
</body>

</html>