

<div class="login">
    <form  method="post" action="../../scripts/scripts.php" enctype="multipart/form-data">
        <label>Загрузите изображение</label>
        <input type="file" name="avatar" >
        <label><small>Макс. размер изображения 1000x1000px. Допустимый формат - .jpg, .png. Максимальный объем - 200КБ.</small></label>
        <input type="hidden" name="table" value="editAvatar">
        <button>Загрузить</button>
        <p><?=$_SESSION['error']?></p>
        <? unset($_SESSION['error']) ?>
    </form>
</div>
