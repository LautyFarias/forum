<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $context['user']['username']; ?> - NineNineChannel</title>
    <link rel="shortcut icon" href="../public/images/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
</head>

<body>
    <div id="background" class="deactive"></div>
    <div class="container">
        <?php include 'includes/nav.html'; ?>
        <section class="profile-container">
            <article>
                <div class="profile-name">
                    <hr>
                    <h2><?php echo $context['user']['username']; ?></h2>
                    <hr>
                </div>
                <div class="profile-email">
                    <p><?php echo $context['user']['email']; ?></p>
                </div>
                <div class="profile-description">
                    <p><?php echo $context['user']['description']; ?></p>
                </div>
            </article>
            <article class="thread-container">
                <div onclick="displayThreadForm();" class="row create-link">
                    <i class="fas fa-plus"></i>
                </div>
                <?php foreach ($context['threads'] as $thread) : ?>
                    <div class="row" id="thread/<?php echo $thread['pid'] ?>">
                        <div class="header-container">
                            <div>
                                <h3><?php echo $thread['title']; ?></h3>
                                <p><?php echo $thread['date']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </article>
        </section>
        <?php include 'includes/footer.html'; ?>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../public/js/thread-form.js"></script>
    <script src="../public/js/thread-retrieve.js"></script>
</body>

</html>