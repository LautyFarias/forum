<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NineNineChannel</title>
    <link rel="shortcut icon" href="../public/images/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
</head>

<body>
    <div id="background" class="deactive"></div>
    <div class="container">
        <?php include 'includes/nav.html'; ?>
        <header class="image-container">
            <div>
                <img src="../public/images/logo.jpg" alt="logo">
            </div>
        </header>
        <h2>Featured Threads</h2>
        <section class="thread-container">
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
                        <div>
                            <h5><?php echo $thread['user']; ?></h5>
                        </div>
                    </div>
                    <!-- <div class="valoration-container">
                        <div class="likes-container">
                            <i class="fas fa-thumbs-up"></i>
                            <p><?php //echo $thread['likes']; ?></p>
                        </div>
                        <div class="dislikes-container">
                            <i class="fas fa-thumbs-down"></i>
                            <p><?php //echo $thread['dislikes']; ?></p>
                        </div>
                    </div> -->
                </div>
            <?php endforeach; ?>
        </section>
        <?php include 'includes/footer.html'; ?>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../public/js/thread-form.js"></script>
    <script src="../public/js/thread-retrieve.js"></script>
</body>

</html>