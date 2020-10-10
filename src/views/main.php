<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SevenChannel</title>
</head>

<body>
    <div id="background" class="deactive"></div>
    <div class="container">
        <header class="image-container">
            <div>
                <img src="" alt="">
            </div>
        </header>
        <div class="search-container">
            <div>
                <div>
                    <i>Icon</i>
                </div>
                <div>
                    <input type="text" placeholder="Search thread by id, name or theme">
                </div>
            </div>
        </div>
        <h2>Featured Threads</h2>
        <section class="thread-container">
            <div class="row">
                <a href="/thread/create"><i></i></a>
            </div>
            <?php foreach ($context['threads'] as $thread): ?>
            <div class="row" id="thread/<?php echo $thread['pid'] ?>">
                <div class="column">
                    <div class="main-image">
                        <img src="" alt="">
                    </div>
                    <!-- <div class="id-container">
                        <p><?php //echo $thread['pid']; ?></p>
                    </div> -->
                    <div class="header-container">
                        <div>
                            <h3><?php echo $thread['title']; ?></h3>
                        </div>
                        <div>
                            <h3><?php echo $thread['user']; ?></h3>
                        </div>
                    </div>
                    <div class="discussion-container">
                        <?php echo $thread['discussion']; ?>
                    </div>
                    <div class="theme-container">
                        Themes
                    </div>
                    <div class="valoration-container">
                        <div class="likes-container">
                            <i>Icon</i>
                            <p><?php echo $thread['likes']; ?></p>
                        </div>
                        <div class="dislikes-container">
                            <i>Icon</i>
                            <p><?php echo $thread['dislikes']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="column"></div>
            </div>
            <?php endforeach; ?>
        </section>
    </div>
    <script src="../public/js/thread-retrieve.js"></script>
</body>

</html>