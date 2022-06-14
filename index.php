<?php
    session_start();
    $role = ['student', 'inst', 'prep'];

    if(!isset($_SESSION['title'])){
        $_SESSION['title']= "Главная страница";
    }
    if($_GET['loc']=='exit') {
        unset($_SESSION['user']);
        header("Location: /");
    }
    require "scripts/db.php";
    require "scripts/scripts.php";
    require 'phpmailer/mailConfig.php';
    require "scripts/getTitle.php";
    require "pages/sceleton/head.php";
    require "pages/sceleton/header.php";
?>

<div class="main">
<?php
    switch ($_GET['loc']){
        case 'cat':
            require "pages/category.php";
            break;
        case 'prep':
            require "pages/instructors.php";
            break;
        case 'passRecov':
            require "pages/passRecov.php";
            break;
        case 'changePass':
            require "pages/changePass.php";
            break;
        case 'lk':
            if(!in_array($_SESSION['user']['role'],$role) && $_SESSION['user']['role']!='admin')
                require "pages/login.php";
            elseif($_SESSION['user']['role']=='admin') {
                if(isset($_GET['id']))
                    require "pages/lk/profile.php";
                else
                    require "pages/news.php";
            }
            else
                require "pages/lk/profile.php";
            break;
        case 'viewExer':
            if(!in_array($_SESSION['user']['role'],$role))
                require "pages/login.php";
            elseif($_SESSION['user']['role']=='admin')
                require "pages/news.php";
            else
                require "pages/lk/exercise.php";
            break;
        case 'addExer':
            if(!in_array($_SESSION['user']['role'],$role))
                require "pages/login.php";
            elseif($_SESSION['user']['role']=='prep')
                require "pages/lk/addExer.php";
            else
                require "pages/news.php";
            break;
        case 'fullExer':
            if(!in_array($_SESSION['user']['role'],$role))
                require "pages/login.php";
            elseif($_SESSION['user']['role']=='admin')
                require "pages/news.php";
            elseif(isset($_GET['id']))
                require "pages/lk/fullExer.php";
            else
                require "pages/news.php";
            break;
        case 'login':
            if($_SESSION['user']['role']!='admin' && !in_array($_SESSION['user']['role'],$role))
                require "pages/login.php";
            else
                require "pages/news.php";
            break;
        case 'viewStud':
            if($_SESSION['user']['role']=='admin')
                require "pages/admin/stud.php";
            else
                require "pages/news.php";
            break;
        case 'viewPrep':
            if($_SESSION['user']['role']=='admin')
                require "pages/admin/instructors.php";
            else
                require "pages/news.php";
            break;
        case 'viewGroup':
            if($_SESSION['user']['role']=='admin') {
                require "pages/admin/groups.php";
            }
            else
                require "pages/news.php";
            break;

        case 'viewNews':
            if($_SESSION['user']['role']=='admin')
                require "pages/admin/news.php";
            else
                require "pages/news.php";
            break;
        case 'editPrep':
            if($_SESSION['user']['role']=='admin')
                require "pages/admin/editPrep.php";
            else
                require "pages/news.php";
            break;
        case 'listStud':
            if(isset($_SESSION['user']['role']))
                require "pages/admin/listStud.php";
            else
                require "pages/news.php";
            break;
        case 'editStud':
            if($_SESSION['user']['role']=='admin')
                require "pages/admin/editStud.php";
            else
                require "pages/news.php";
            break;
        case 'editAvatar':
            if(!in_array($_SESSION['user']['role'],$role))
                require "pages/login.php";
            elseif($_SESSION['user']['role']=='admin')
                require "pages/news.php";
            else
                require "pages/lk/editAvatar.php";
            break;
        default:
            require "pages/news.php";
            break;
    }
?>
</div>
<? require "pages/sceleton/footers.php"?>


