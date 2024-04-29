<div class="login__sidebar">
    <ul>
        <li class="<?= $_SERVER['REQUEST_URI'] == '/profile.php' ? ' active' : ''; ?>">
            <a href="/profile.php">Контактные данные</a>
        </li>
        <li class="<?= $_SERVER['REQUEST_URI'] == '/whishlist.php' ? ' active' : ''; ?>">
            <a href="/whishlist.php">Избранное</a>
        </li>
        <li class="login__sidebar--logout">
            <a href="/vendor/auth/logout.php">Выйти</a>
        </li>
    </ul>
</div>