<?php $instr = getInstructors($db) ?>
    <div class="info-prepod">
        <div>
            <table>
                <caption>Преподаватели</caption>
                <? if(isset($instr)): ?>
                <tr>
                    <td>ФИО</td>
                    <td>Стаж</td>
                    <td>Образование</td>
                </tr>
                <? while($arr = $instr->fetch_array()): ?>
                <tr>
                    <td><?= $arr['surname']." ".$arr['first_name']." ".$arr['last_name'] ?></td>
                    <td><?= getSklo($arr['drive_exp'])?></td>
                    <td><?= $arr['education'] ?></td>
                </tr>
                <? endwhile; ?>
                <? else: ?>
                <tr>
                    <td>Записи не найдены</td>
                </tr>
                <? endif; ?>
            </table>
        </div>
    </div>
