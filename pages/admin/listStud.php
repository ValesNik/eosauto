<?php
?>
<?php
$stud = getStudFromGroups($db,$_GET['id']);
?>

<div class="viewTables">
    <div>
        <table>
            <caption>Ученики группы <?=getGroupsFromId($db,$_GET['id'])['groups']?></caption>
            <tr>
                <td><p>ФИО</p></td>
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
                        <td><?= $arr['surname']." ".$arr['first_name']." ".$arr['last_name']?></td>
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
