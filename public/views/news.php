<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/news.css">

    <script src="https://kit.fontawesome.com/723297a893.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <title>PROJECTS</title>
</head>

<body>
<div class="base-container">
    <?php include ("public/views/menu.php")?>
    <main>
        <?php include ("public/views/bar.php")?>
        <section class="news">
            <?php foreach ($news as $post): ?>
            <div id="news-1">
                <img src="public/uploads/<?=$post->getImage(); ?>">
                <div>
                    <h2> <?= $post->getTitle(); ?></h2>
                    <p> <?= $post->getDescription(); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </section>
    </main>
</div>
</body>

<template id="news-template">
<div id="">
    <img src="">
    <div>
        <h2>title</h2>
        <p>description</p>
    </div>
</div>
</template>