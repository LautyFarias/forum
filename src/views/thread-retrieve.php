<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div id="background" class="deactive"></div>
    <div class="container">
        <section class="thread-container">
            <div class="row" id="thread/<?php echo $context['thread']['pid'] ?>">
                <div class="main-image">
                    <img src="" alt="">
                </div>
                <div class="header-container">
                    <div>
                        <h3><?php echo $context['thread']['title']; ?></h3>
                    </div>
                    <div>
                        <h3><?php echo $context['thread']['user']; ?></h3>
                    </div>
                </div>
                <div class="discussion-container">
                    <?php echo $context['thread']['discussion']; ?>
                </div>
                <div class="theme-container">
                    Themes
                </div>
                <div class="valoration-container">
                    <div class="likes-container">
                        <i>Icon</i>
                        <p><?php echo $context['thread']['likes']; ?></p>
                    </div>
                    <div class="dislikes-container">
                        <i>Icon</i>
                        <p><?php echo $context['thread']['dislikes']; ?></p>
                    </div>
                </div>
            </div>
            <div id="responses"></div>
            <div>
                <textarea name="response" id="response-input" cols="30" rows="10">
                    Opine...
                </textarea>
            </div>
        </section>
    </div>
    <script src="../public/js/response.js"></script>
</body>

</html>