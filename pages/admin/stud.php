<?php
$stud = getStud($db);
?>

<div class="viewTables">
    <div>
        <table>
            <caption>Ученики</caption>
            <tr>
                <td><p>ФИО</p></td>
                <td><p>Группа</p></td>
                <td>
                    <p>Дата рождения</p>
                </td>
                <td>
                    <p>Дата начала обучения</p>
                </td>
                <td></td>
            </tr>
            <? if(isset($stud)): ?>
                <? while ($arr = $stud->fetch_array()): ?>
                    <tr>
                        <td><a href="/?loc=lk&id=<?=$arr['account']?>"><?= $arr['surname']." ".$arr['first_name']." ".$arr['last_name']?></a></td>
                        <td>
                            <p><?= $arr['groups']?></p>
                        </td>
                        <td><p><?= $arr['birth_date']?></p></td>
                        <td><p><?= $arr['start_date']?></p></td>
                        <td><a href="?loc=editStud&id=<?=$arr['id']?>"><img src="../../img/images/pensil.png" alt=""></a></td>
                        <td>
                            <a href="/?loc=viewStud&delete=<?= $arr['id'] ?>">x</a>
                        </td>
                    </tr>
                <? endwhile; ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td><a href="?loc=editStud" class="button">Добавить</a></td>
                </tr>
            <? else: ?>
                <tr>
                    <td></td>
                    <td><p>Записей нет</p></td>
                    <td><a href="?loc=editStud" class="button">Добавить</a></td>
                </tr>
            <? endif; ?>
        </table>
    </div>
</div>