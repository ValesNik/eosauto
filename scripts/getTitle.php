<?php
    switch ($_GET['loc']){
        case 'cat':
            $_SESSION['title']="Категории";
            break;
        case 'prep':
            $_SESSION['title']="Список преподавателей";
            break;
        case 'passRecov':
            $_SESSION['title']="Восстановление пароля";
            break;
        case 'changePass':
            $_SESSION['title']="Смена пароля";
            break;
        case 'lk':
            if(!in_array($_SESSION['user']['role'],$role) && $_SESSION['user']['role']!='admin')
                $_SESSION['title']="Авторизация";
            elseif($_SESSION['user']['role']=='admin') {
                if(isset($_GET['id']))
                    $_SESSION['title']="Профиль";
                else
                    $_SESSION['title']=null;
            }
            else
                $_SESSION['title']="Профиль";
            break;
        case 'viewExer':
            if(!in_array($_SESSION['user']['role'],$role))
                $_SESSION['title']="Авторизация";
            elseif($_SESSION['user']['role']=='admin')
                $_SESSION['title']=null;
            else
                $_SESSION['title']="Задания";
            break;
        case 'addExer':
            if(!in_array($_SESSION['user']['role'],$role))
                $_SESSION['title']="Авторизация";
            elseif($_SESSION['user']['role']=='prep')
                $_SESSION['title']="Новое задание";
            else
                $_SESSION['title']=null;
            break;
        case 'fullExer':
            if(!in_array($_SESSION['user']['role'],$role))
                $_SESSION['title']="Авторизация";
            elseif($_SESSION['user']['role']=='admin')
                $_SESSION['title']=null;
            elseif(isset($_GET['id']))
                $_SESSION['title']="Задание";
            else
                $_SESSION['title']=null;
            break;
        case 'login':
            if($_SESSION['user']['role']!='admin' && !in_array($_SESSION['user']['role'],$role))
                $_SESSION['title']="Авторизация";
            else
                $_SESSION['title']=null;
            break;
        case 'viewStud':
            if($_SESSION['user']['role']=='admin')
                $_SESSION['title']="Список студентов";
            else
                $_SESSION['title']=null;
            break;
        case 'viewPrep':
            if($_SESSION['user']['role']=='admin')
                $_SESSION['title']="Список препадавателей";
            else
                $_SESSION['title']=null;
            break;
        case 'viewGroup':
            if($_SESSION['user']['role']=='admin') {
                $_SESSION['title']="Список групп";
            }
            else
                $_SESSION['title']=null;
            break;

        case 'viewNews':
            if($_SESSION['user']['role']=='admin')
                $_SESSION['title']="Список новостей";
            else
                $_SESSION['title']=null;
            break;
        case 'editPrep':
            if($_SESSION['user']['role']=='admin')
                $_SESSION['title']="Изменение данных";
            else
                $_SESSION['title']=null;
            break;
        case 'listStud':
            if(isset($_SESSION['user']['role']))
                $_SESSION['title']="Список студентов";
            else
                $_SESSION['title']=null;
            break;
        case 'editStud':
            if($_SESSION['user']['role']=='admin')
                $_SESSION['title']="Изменение данных";
            else
                $_SESSION['title']=null;
            break;
        case 'editAvatar':
            if(!in_array($_SESSION['user']['role'],$role))
                $_SESSION['title']="Авторизация";
            elseif($_SESSION['user']['role']=='admin')
                $_SESSION['title']=null;
            else
                $_SESSION['title']="Смена аватара";
            break;
        default:
            $_SESSION['title']=null;
            break;
    }
?>