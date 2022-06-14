<?php
    if(isset($_GET['id']))
        $arr = getInstructorsFromId($db,$_GET['id']);

?>
<div class="editTables">
    <label>Информация о преподавателе</label>
    <form action="../../scripts/scripts.php" method="post">
        <div class="block">
            <div>
                <label>Фамилия:</label>
                <input required  type="text" name="surname" value="<?= $arr['surname']?>">
            </div>
            <div>
                <label>Имя:</label>
                <input required   type="text" name="first_name" value="<?= $arr['first_name']?>" >
            </div>
            <div>
                <label>Отчество:</label>
                <input required  type="text" name="last_name" value="<?= $arr['last_name']?>">
            </div>
            <div>
                <label>Стаж</label>
                <input required  type="number" name="drive_exp" value="<?= $arr['drive_exp']?>">
            </div>
            <div>
                <label>Образование</label>
                <input required  type="text" name="education" value="<?= $arr['education']?>">
            </div>
            <? if(isset($arr)):?>
                <input type="hidden" name="id" value="<?= $arr['id']?>">
                <input type="hidden" name="table" value="editPrep">
            <? else: ?>
            <div>
                <label>email</label>
                <input required  type="email" name="email" maxlength="35">
            </div>
                <div>
                    <label>Пароль</label>
                    <input required  type="password" name="pass" minlength="5">
                </div>
            <input type="hidden" name="table" value="addPrep">
            <? endif;?>
        </div>
        <button>Отправить</button>
    </form>
</div>
