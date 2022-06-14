<?php
    $groups = getGroups($db);
    if(isset($_GET['id']))
        $groupsFromId = getGroupsFromId($db,$_GET['id']);
?>

<div class="viewTables">
    <div>
        <table>
            <caption>Группы</caption>
            <tr>
                <td><p>Группа</p></td>
                <td>
                    <p>Кол-во человек в группе</p>
                </td>
                <td></td>
            </tr>
            <? if(isset($groups)): ?>
            <? while ($arr = $groups->fetch_array()): ?>
            <tr>
                <td><a href="?loc=listStud&id=<?=$arr['id']?>"><?= $arr['groups']?></a></td>
                <td>
                    <p><?= getCountStudentInGroup($db,$arr['id'])?></p>
                </td>
                <td>
                    <a href="?loc=viewGroup&id=<?=$arr['id']?>"><img src="../../img/images/pensil.png" alt=""></a>
                </td>
                <td>
                    <a href="/?loc=viewGroup&delete=<?= $arr['id'] ?>">x</a>
                </td>
            </tr>
            <? endwhile; ?>
            <? else: ?>
            <? endif; ?>
            <tr>
            <form action="../../scripts/scripts.php" method="post">

                    <td><div class="block">
                            <div>
                                <p>Группа</p>
                                <input required type="text" name="groups" value="<?=$groupsFromId['groups']?>">
                            </div>
                        </div>
                    </td>
                    <? if(isset($groupsFromId)):?>
                    <input type="hidden" name="id" value="<?= $_GET['id']?>">
                    <input type="hidden" name="table" value="editGroups">
                    <? else: ?>
                    <input type="hidden" name="table" value="addGroups">
                    <? endif; ?>
                    <td><button class="button">Отправить</button></td>

            </form>
            </tr>
        </table>
        <? if($checkDelete==true):?>
            <label>Ошибка: В группе имеются люди</label>
        <? endif;$checkDelete=false;?>
    </div>
</div>