<?php
    if($_SESSION['user']['role']=='student')
        $info = getExerListForStudent($db);
    else
        $info = getExerListForInstructors($db);
?>

<div class="viewTables">
    <div>
        <table>
            <caption>Задания</caption>
            <? if(isset($info)): ?>
            <? if($_SESSION['user']['role']=='student'):?>
                <? while ($arr = $info->fetch_array()): ?>
                    <tr>
                        <td><p>От: <?= $arr['surname']." ".mb_substr($arr['first_name'],0,1).". ".mb_substr($arr['last_name'],0,1)?></p></td>
                        <td><a href="?loc=fullExer&id=<?=$arr['id']?>"><?= $arr['title']?></a></td>
                        <td>
                            <p><?=$arr['date']?></p>
                        </td>
                    </tr>
                <? endwhile; ?>
            <? else: ?>
                    <? while ($arr = $info->fetch_array()): ?>
                        <tr>
                            <td><p>Кому: <?=$arr['groups']?></p></td>
                            <td><a href="?loc=fullExer&id=<?=$arr['id']?>"><?= $arr['title']?></a></td>
                            <td>
                                <p><?=$arr['date']?></p>
                            </td>
                        </tr>
                    <? endwhile; ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><a href="/?loc=addExer" class="button">Добавить новое задание</a></td>
                    </tr>
            <?endif; ?>
            <? else: ?>
            <tr>
                <td>Заданий нет</td>
                <? if($_SESSION['user']['role']=='prep'): ?>
                <td></td>
                <td><a href="/?loc=addExer" class="button">Добавить новое задание</a></td>
                <? endif;?>
            </tr>
            <? endif; ?>
        </table>
    </div>
</div>
