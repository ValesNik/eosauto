<body>
<header>
    <nav class="dws-menu">
        <ul>
            <li><a href="/">Главная</a></li>
            <li><u>Обучение</u>
                <ul>
                    <li><a href="?loc=cat">Категории</a></li>
                    <li><a href="?loc=prep">Преподаватели</a></li>
                    </li>
                </ul>
            </li>
            <? if($_SESSION['user']['role']=='admin'): ?>
            <li><u>Админ панель</u>
                <ul>
                    <li><a href="?loc=viewStud">Данные об учениках</a></li>
                    <li><a href="?loc=viewPrep"">Данные о преподавателях</a></li>
                    <li><a href="?loc=viewGroup"">Данные о группах</a></li>
                    <li><a href="?loc=viewNews"">Управление новостями</a></li>
            <? else: ?>
            <li><u>Личный кабинет</u>
                <ul>
                    <li><a href="?loc=lk">Профиль</a></li>
                    <li><a href="?loc=viewExer">Задания</a></li>
                    <? endif; ?>
                </ul>
            </li>
            <? if(isset($_SESSION['user']['role'])): ?>
            <li><a href="?loc=exit">Выход</a></li>
            <? else: ?>
            <li><a href="?loc=login">Вход</a></li>
            <? endif; ?>
        </ul>
    </nav>

</header>