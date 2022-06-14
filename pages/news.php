<?php $news = getNews($db) ?>
<div class="news">
    <div>
        <h1>Добро пожаловать на сайт автошколы "Veles"</h1>
        <p>Данный сайт создан для ознакомления с нашей автошколой. На сайте присутствует образовательная среда для учеников и преподавателей</p>
        <p>Если у вас есть желание обучаться в нашей автошколе, то вы можете узнать интересующую вас информацию по номеру +7 (4832) ***- *** или отправив сообщение на почту eosauto.test@bk.ru</p>
        <div>
            <a href="/?loc=cat" class="button">Категории</a>
            <a href="/?loc=prep" class="button">Преподаватели</a>
            <a href="/?loc=lk" class="button">Личный кабинет</a>
            <a href="/?loc=login" class="button">Авторизация</a>
        </div>

    </div>
    <div>
        <table>
            <caption>Новости</caption>
            <? if(isset($news)): ?>
            <? while($arr = $news->fetch_array()): ?>
            <tr>
                <td><p><?= $arr["news"] ?></p></td>
                <td>
                    <p><?= $arr["date"]?></p>
                </td>
            </tr>
            <? endwhile; ?>
            <? else:?>
            <tr>
                <td class="error"><p>Записей нет</p></td>
            </tr>
            <? endif; ?>
        </table>
    </div>
</div>