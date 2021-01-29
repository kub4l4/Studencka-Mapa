<!DOCTYPE html>

<head>
    <?php include("public/views/head.php") ?>

    <link rel="stylesheet" type="text/css" href="public/css/news.css">
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <title>News</title>
</head>

<body>
<div class="base-container">
    <?php include("public/views/sidebar.php") ?>
    <main>
        <header>
            <div class="search-bar">
                <input placeholder="search project">
            </div>
        </header>
        <section class="news">
            <?php foreach ($news as $post): ?>
                <div id="news-1">
                    <img src="public/uploads/<?= $post->getImage(); ?>">
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