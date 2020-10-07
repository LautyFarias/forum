<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <?php //print_r($context); ?>
        <section>
            <article>
                <div class="profile-name">
                    <hr>
                    <h2><?php echo $context['user']['username']; ?></h2>
                    <hr>
                </div>
                <div class="profile-icon">
                    <img src="" alt="">
                </div>
                <div class="profile-description">
                    <p><?php echo $context['user']['description']; ?></p>
                </div>
            </article>
            <article class="featured-thread-container">
                <div class="row">
                    <a href="/thread/create"><i>Create your propie thread!</i></a>
                </div>
                <div class="row">
                    <div class="column">
                        <div class="main-image">
                            <img src="" alt="">
                        </div>
                        <div class="id-container">
                            <p>#Id</p>
                        </div>
                        <div class="header-container">
                            <div>
                                <h3>Title</h3>
                            </div>
                            <div>
                                <h3>Autor</h3>
                            </div>
                        </div>
                        <div class="description-container">
                            Description
                        </div>
                        <div class="theme-container">
                            Themes
                        </div>
                        <div class="valoration-container">
                            <div class="likes-container">
                                <i>Icon</i>
                                <p>Number</p>
                            </div>
                            <div class="dislikes-container">
                                <i>Icon</i>
                                <p>Number</p>
                            </div>
                        </div>
                    </div>
                    <div class="column"></div>
                </div>
            </article>
        </section>
    </div>
</body>

</html>