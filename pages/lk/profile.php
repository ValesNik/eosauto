<?php
    if(isset($_GET['id']))
        $id = $_GET['id'];
    else
        $id = $_SESSION['user']['id'];
    $user = getUserFromId($db,$id);
    $user_info = getUserFromAccount($db,$id,$user['role']);
    if($user['role']=='student') {
        $info = getStudFromIdAccount($db,$id);
    }
?>
<div class="profile">
        <div class="menu">
            <div class="avatar">
                <?if(file_exists($_SERVER['DOCUMENT_ROOT']."/img/avatar/".$user['avatar'])):?>
                <img src="../../img/avatar/<?=$user['avatar']?>" alt="">
                <?else:?>
                <img src="../../img/avatar/avatar.jpg" alt="">
                <?endif;?>
            </div>
            <?if($_SESSION['user']['id']==$id):?>
                <a href="/?loc=editAvatar">Изменить аватар</a>
                <a href="/?loc=changePass&id=<?=$id?>">Изменить пароль</a>
            <?endif;?>
        </div>

        <div>
            <div>
                <label>Фамилия:</label>
                <p><?=$user_info['surname']?></p>
            </div>
            <div>
                <label>Имя: </label>
                <p><?=$user_info['first_name']?></p>
            </div>
            <div>
                <label>Отчество: </label>
                <p><?=$user_info['last_name']?></p>
            </div>
            <? if($user['role']=='student'):?>
            <div>
                <label>Группа: </label>
                <p><?=getGroupsFromId($db,$info['groups'])['groups']?></p>
            </div>
            <div>
                <label>Дата рождения: </label>
                <p><?=$info['birth_date']?></p>
            </div>
            <div>
                <label>Дата начала обучения: </label>
                <p><?=$info['start_date']?></p>
            </div>
            <? endif;?>
        </div>
    </div>

