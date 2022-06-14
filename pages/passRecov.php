<?php
    if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['email'])){
        $email = trim($_POST['email']);
        if(checkEmail($db,$email)) {
            if (sendMail($email, $mail, $db))
                $_SESSION['send'] = true;
        }
        else
            $_SESSION['error'] = true;
    }
?>

<div class="login">
    <form method="post">
        <? if($_SESSION['send']): ?>
        <label>Сообщение отправлено</label>
        <h3>Проверьте свою почту. Если сообщение не найдено зайдите в папку "Спам"</h3>
        <? $_SESSION['send']=false; else:?>
        <label>Введите ваш email</label>
        <input type="email" name="email" placeholder="Введите свой email">
        <button>Отправить</button>
        <? if($_SESSION['error']): ?>
            <p>Аккаунта с такой почтой не найдено</p>
        <? endif; $_SESSION[error]=false; endif;?>
    </form>
</div>