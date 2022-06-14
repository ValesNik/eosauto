<?php
    $info = getExerFromId($db,$_GET['id'])
?>
<div class="exercise">
    <label>Тема: <?=$info['title']?></label>
    <p>Задание: <?=$info['message']?></p>
    <?if(isset($info['file'])):?>
    <h3>Прикрепленные файлы:</h3>
    <a href="../../files/exerсize/<?=$info['file']?>" download=""><?=$info['file']?></a>
    <?endif;?>
</div>