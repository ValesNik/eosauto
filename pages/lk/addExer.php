<?php
    $info = getGroups($db);
?>
<div class="editTables">
    <form action="../../scripts/scripts.php" method="post" enctype="multipart/form-data">
        <label>Группа</label>
        <select required name="groups" >
            <option disabled selected>Выберите группу</option>
            <? while($arr = $info->fetch_array()):?>
                <option value="<?= $arr['id']?>"> <?= $arr['groups']?> </option>
            <? endwhile;?>
        </select>
        <label>Заголовок:</label>
        <input required type="text" name="title">
        <label>Задание:</label>
        <textarea required name="message"></textarea>
        <input type="file" name="file">
        <input type="hidden" name="table" value="addExer">
        <button>Добавить</button>
    </form>
</div>
