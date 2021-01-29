<!DOCTYPE html>
<head>
    <?php include("public/views/head.php") ?>
    <title>ERROR PAGE</title>
</head>

<body>
<div class="container">
    <?php include("public/views/logo.php") ?>
    <div class="error-container">
        <h2> You don't have permission to view this page.</h2>
        <?php
        if (isset($messages)) {
            foreach ($messages as $message) {
                echo $message;
            }
        }
        ?>
        <a href="<?= "http://$_SERVER[HTTP_HOST]/login" ?>"> LOGIN </a>
    </div>
</div>
</body>