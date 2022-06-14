    <div class="login">
        <form action="../scripts/auth.php" method="post">
            <label>Логин</label>
            <input type="email" name="email" placeholder="Введите свой email">
            <label>Пароль</label>
            <input type="password" name="pass" placeholder="Введите свой пароль">
            <a href="?loc=passRecov">Забыли пароль?</a>
            <button>Войти</button>
            <? if($_SESSION[error]==true): ?>
            <p>Логин/Пароль неверен</p>
            <? endif; $_SESSION[error]=false ?>
        </form>
    </div>
