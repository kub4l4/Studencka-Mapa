<!DOCTYPE html>
<head>
    <?php include("public/views/head.php") ?>
    <title>LOGIN PAGE</title>
</head>

<body>
<div class="container">
    <?php include("public/views/logo.php") ?>
    <div class="login-container">
        <form class="login" action="login" method="POST">
            <div class="messages">
                <?php
                if (isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            </div>
            <input name="email" type="text" placeholder="email@email.com">
            <input name="password" type="password" placeholder="password">
            <button type="submit">LOGIN</button>
        </form>
    </div>
</div>
</body>