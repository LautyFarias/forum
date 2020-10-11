<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $context['thread']['title']; ?> - NineNineChannel</title>
    <link rel="shortcut icon" href="../public/images/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
</head>

<body>
    <div id="background" class="deactive"></div>
    <div class="container">
        <?php include 'includes/nav.html'; ?>
        <section class="thread-container-retrieve">
            <div class="row" id="thread/<?php echo $context['thread']['pid'] ?>">
                <div class="data-container">
                    <div class="header-container">
                        <div>
                            <h3><?php echo $context['thread']['title']; ?></h3>
                            <p><?php echo $context['thread']['date']; ?></p>
                        </div>
                        <div>
                            <a href="/profile/<?php echo $context['thread']['user_pid']; ?>">
                                <h6><?php echo $context['thread']['user']; ?></h6>
                            </a>
                        </div>
                    </div>
                    <div class="discussion-container">
                        <?php echo $context['thread']['discussion']; ?>
                    </div>
                </div>
                <!-- <div class="valoration-container">
                    <div class="likes-container">
                        <i class="fas fa-thumbs-up" onclick="valorate(event);" style="cursor: pointer;"></i><p><?php //echo $context['thread']['likes']; 
                                                                                                                ?></p>
                    </div>
                    <div class="dislikes-container">
                        <i class="fas fa-thumbs-down" onclick="valorate(event);" style="cursor: pointer;"></i><p><?php //echo $context['thread']['dislikes']; 
                                                                                                                    ?></p>
                    </div>
                </div> -->
            </div>
            <div id="responses" class="responses-container">
                <?php if ($context['responses']) :
                    foreach ($context['responses'] as $response) : ?>
                        <div class="response-header">
                            <a href="/profile/<?php echo $response['user_pid']; ?>">
                                <p class="response-user">- <?php echo $response['user']; ?>:</p>
                            </a>
                            <p><?php echo $response['date']; ?></p>
                        </div>
                        <p class="response-content"><?php echo $response['content']; ?></p>
                <?php endforeach;
                endif; ?>
            </div>
            <div class="response-input-container">
                <textarea name="response" id="response-input" placeholder="Opine... Press enter to send!"></textarea>
            </div>
        </section>
        <?php include 'includes/footer.html'; ?>
    </div>
    <script src="../public/js/valoration.js"></script>
    <script src="../public/js/thread-response.js"></script>
</body>

</html>