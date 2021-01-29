<nav>
    <a href="<?= "http://$_SERVER[HTTP_HOST]/" ?>" alt="Studencka Mapa">
        <img src="public/img/logo.svg">
    </a>
    <ul>
        <li name="mapa">
            <i class="fas fa-map-marked"></i>
            <a href="<?= "http://$_SERVER[HTTP_HOST]/map" ?>" class="button">Map</a>
        </li>
        <li>
            <i class="fas fa-newspaper"></i>
            <a href="<?= "http://$_SERVER[HTTP_HOST]/news" ?>" class="button">news</a>
        </li>

        <?
        require_once __DIR__ . '/../../src/repository/UserRepository.php';
        $userRepository = new UserRepository();

        $currentUserID = 0;
        if ($_COOKIE['user_token'] != null) {
            $currentUserID = $userRepository->cookieCheck($_COOKIE['user_token']);
        }
        if ($currentUserID == 0):
            ?>
            <li name="sign-in">
                <i class="fas fa-user-alt"></i>
                <a href="<?= "http://$_SERVER[HTTP_HOST]/login" ?>" class="button">sign in</a>
            </li>
            <li name="sign-up">
                <i class="fas fa-user-plus"></i>
                <a href="<?= "http://$_SERVER[HTTP_HOST]/register" ?>" class="button">sign up</a>
            </li>
        <? else: ?>
            <li>
                <i class="far fa-plus-square"></i>
                <a href="<?= "http://$_SERVER[HTTP_HOST]/addNews" ?>" class="button">add news</a>
            </li>
            <li name="log-out">
                <i class="fas fa-user-alt-slash"></i>
                <a href="<?= "http://$_SERVER[HTTP_HOST]/log_out" ?>" class="button">log out</a>
            </li>
        <? endif; ?>
    </ul>
</nav>