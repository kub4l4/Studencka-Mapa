<!DOCTYPE html>

<head>
    <?php include("public/views/head.php") ?>
    <link rel="stylesheet" type="text/css" href="public/css/news.css">
    <title>Add News</title>
</head>

<body>
<div class="base-container">
    <?php include("public/views/sidebar.php") ?>
    <main>
        <section class="news-form">
            <h1>Add Point</h1>
            <form action="addNews" method="POST" ENCTYPE="multipart/news-data">
                <div class="messages">
                    <?php
                    if (isset($messages)) {
                        foreach ($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>
                <input name="title" type="text" placeholder="title">
                <textarea name="description" rows=5 placeholder="description"></textarea>

                <input type="file" name="file"/><br/>
                <button type="submit">send</button>
            </form>
        </section>
    </main>
</div>
</body>