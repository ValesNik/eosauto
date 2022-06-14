<?php
$instr = getInstructors($db);
?>

<div class="viewTables">
    <div>
        <table>
            <caption>Преподаватели</caption>
            <tr>
                <td><p>ФИО</p></td>
                <td>
                    <p>Стаж</p>
                </td>
                <td><p>Образование</p></td>
                <td></td>
            </tr>
            <? if(isset($instr)): ?>
                <? while ($arr = $instr->fetch_array()): ?>
                    <tr>
                        <td><a href="/?loc=lk&id=<?=$arr['account']?>"><?= $arr['surname']." ".$arr['first_name']." ".$arr['last_name']?></a></td>
                        <td>
                            <p><?= getSklo($arr['drive_exp'])?></p>
                        </td>
                        <td><p><?= $arr['education']?></p></td>
                        <td><a href="?loc=editPrep&id=<?=$arr['id']?>"><img src="../../img/images/pensil.png" alt=""></a> </td>
                        <td>
                            <a href="/?loc=viewPrep&delete=<?= $arr['id'] ?>">x</a>
                        </td>
                    </tr>
                <? endwhile; ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td><a href="?loc=editPrep" class="button">Добавить</a></td>
                </tr>
            <? else: ?>
                <tr>
                    <td></td>
                    <td><p>Записей нет</p></td>
                    <td><a href="?loc=editPrep" class="button">Добавить</a></td>
                </tr>
            <? endif; ?>
        </table>
    </div>
</div>