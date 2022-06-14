<?php
if(checkHash($db,$_GET['hash']) && !isset($_GET['id'])){
    if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['pass']) && isset($_POST['confirmPass'])){
        $pass = trim($_POST['pass']);
        $confirm = trim($_POST['confirmPass']);
        if(checkPass($pass)){
            if($pass==$confirm){
                $pass = md5($pass);
                if(passRecoveFromHash($db,$_GET['hash'],$pass))
                    $_SESSION['error']="Пароль успешно изменён";
            }else
                $_SESSION['error']="Пароли не совпадают";
        }
    }
}elseif(isset($_GET['id'])){
    if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['pass']) && isset($_POST['confirmPass'])){
        $pass = trim($_POST['pass']);
        $confirm = trim($_POST['confirmPass']);
        if(checkPass($pass)){
            if($pass==$confirm){
                $pass = md5($pass);
                if(passRecoveFromId($db,$_GET['id'],$pass))
                    $_SESSION['error']="Пароль успешно изменён";
            }else
                $_SESSION['error']="Пароли не совпадают";
        }
    }
} else
    $_SESSION['error']="Ссылка устарела или недоступна.";
?>

<div class="login">
    <form method="post">
        <? if(!checkHash($db,$_GET['hash']) && !isset($_GET['id'])):?>
        <p><?=$_SESSION['error']?></p>
        <?else:?>
        <label>Введите пароль</label>
        <input type="text" name="pass" placeholder="Введите пароль">
        <label>Подвердение пароля</label>
        <input type="password" name="confirmPass" placeholder="Подверждение пароля">
        <button>Отправить</button>
        <?if(isset($_SESSION['error'])):?>
        <p><?=$_SESSION['error']?></p>
        <?endif;unset($_SESSION['error']); endif;?>
    </form>
</div>
