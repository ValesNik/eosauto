<?php
if(isset($_GET['id'])) {
    $arr = getStudFromId ($db, $_GET['id']);
    $arr1 = getGroupsForStudent($db,$arr['groups']);
    $groupsWithoutStudent = getGroupsWithoutStudent($db,$arr['groups']);
}
else
    $groups = getGroups($db);

?>
<div class="editTables">
    <label>Информация о ученике</label>
    <form action="../../scripts/scripts.php" method="post">
        <div class="block">
            <div>
                <label>Фамилия:</label>
                <input required  type="text" name="surname" value="<?= $arr['surname']?>">
            </div>
            <div>
                <label>Имя:</label>
                <input required  type="text" name="first_name" value="<?= $arr['first_name']?>" >
            </div>
            <div>
                <label>Отчество:</label>
                <input required  type="text" name="last_name" value="<?= $arr['last_name']?>">
            </div>
            <br>
            <div>
                <label>Группа:</label>
                <select required name="groups">

                    <? if(isset($arr)):?>

                    <option disabled>Выберите группу</option>
                    <option selected value="<?=$arr1['id']?>"> <?= $arr1['groups'] ?> </option>
                    <? if(isset($groupsWithoutStudent)):?>
                    <? while($arr2 = $groupsWithoutStudent->fetch_array()): ?>
                    <option value="<?= $arr2['id']?>"> <?=$arr2['groups']?> </option>
                    <? endwhile;?>
                    <? endif;?>
                    <? else: ?>

                    <option disabled selected>Выберите группу</option>
                    <? while($arr2 = $groups->fetch_array()):?>

                    <option value="<?= $arr2['id']?>"> <?= $arr2['groups']?> </option>

                    <? endwhile;?>
                    <? endif;?>
                </select>
            </div>
            <div>
                <label>Дата рождения</label>
                <input required  type="date" name="birth_date" value="<?= $arr['birth_date']?>">
            </div>
            <div>
                <label>Дата начала обучения</label>
                <input required  type="date" name="start_date" value="<?= $arr['start_date']?>">
            </div>
            <? if(isset($arr)):?>
                <input type="hidden" name= "id" value="<?= $arr['id']?>">
                <input type="hidden" name="table" value="editStud">

            <? else: ?>
                <div>
                    <label>Email</label>
                    <input required  type="email" name="email" maxlength="35">
                </div>
                <div>
                    <label>Пароль</label>
                    <input required  type="password" name="pass" minlength="5">
                </div>
                <input type="hidden" name="table" value="addStud">
            <? endif;?>
        </div>
        <button>Отправить</button>
    </form>
</div>
