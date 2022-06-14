<?php
session_start();
require "db.php";
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($_POST['table']){
        case 'addPrep':
            addInstructor($db,$_POST);
            break;
        case 'editPrep':
            editInstructor($db,$_POST);
            break;
        case 'addStud':
            addStud($db,$_POST);
            break;
        case 'editStud':
            editStud($db,$_POST);
            break;
        case 'addGroups':
            addGroups($db,$_POST);
        case 'editGroups':
            editGroups($db,$_POST);
            break;
        case 'addNews':
            addNews($db,$_POST);
        case 'editNews':
            editNews($db,$_POST);
            break;
        case 'addExer':
            addExer($db,$_POST,$_FILES);
            break;
        case 'editAvatar':
            editAvatar($db,$_FILES);
            break;
        default:
            break;
    }

}

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if(isset($_GET['delete'])){
        switch ($_GET['loc']){
            case 'viewGroup':
                $checkDelete = deleteGroup($db, $_GET['delete']);
                break;
            case 'viewPrep':
                deleteInstructor($db, $_GET['delete']);
                break;
            case 'viewStud':
                deleteStud($db,$_GET['delete']);
                break;
            case 'viewNews':
                deleteNews($db,$_GET['delete']);
                break;
            default:
                break;
        }
    }

}
    function checkEmail($db,$email){
        $query = $db->query("SELECT * FROM account WHERE email= '$email'");
        if(($query->num_rows)>0)
            return true;
        return false;
    }

    function getTimeMoscow(){
        date_default_timezone_set("Europe/Moscow");
        return date('Y-m-d',time());
    }

    function sendMail($email,$mail,$db){
        $expire = time() + 3600;
        $hash = md5($expire.$email);
        $query = $db -> query("INSERT INTO `recover`(`hash`, `expire`, `email`) VALUES ('$hash','$expire','$email')");
        if($query) {
            $title = 'Восстановление пароля';
            $body = 'Для восстановления пароля на сайте перейдите по ссылке http://'.$_SERVER['HTTP_HOST'].'/?loc=changePass&hash='.$hash;
            $mail->addAddress($email);
            $mail->Subject = $title;
            $mail->Body = $body;
            $mail->AltBody = '';
            if ($mail->send())
                return true;

        }
        return false;
    }

    function checkHash($db,$hash){
        $query= $db->query("SELECT * FROM recover WHERE hash='$hash'");
        if(($query->num_rows)>0) {
            $row = $query->fetch_array();
            $expire = time();
            if ($row['expire'] - $expire > 0)
                return true;
            else
                $db->query("DELETE FROM recover WHERE expire < '$expire'");
        }
        return false;

    }

    function checkPass($pass){
        $strlen= strlen($pass);
        if($strlen >= 6 && $strlen <= 16){
            if(preg_match('/[A-z]+/',$pass)){
                if(preg_match('/[0-9]+/',$pass))
                    return true;
            }
        }
            $_SESSION['error']="Длина пароля должна быть от 6 до 16 символов. Также должен содержать буквы и цифры.";
    }

    function checkFile($db,$data){
        if(isset($data['file'])){
            $file = $data['file'];
            $name = $file['name'];
            $dir = $_SERVER['DOCUMENT_ROOT'].'/files/exerсize/'.$name;
            if(move_uploaded_file($file['tmp_name'],$dir)){
                return $name;
            }
        }
        return null;
    }

    function passRecoveFromId($db,$id,$pass){
        $query = $db->query("UPDATE `account` SET `pass`='$pass' WHERE `id`='$id'");
        if($query){
            return true;
        }
        return false;
    }

    function passRecoveFromHash($db,$hash,$pass){
        $email = getEmailFromHash($db,$hash);
        $query = $db->query("UPDATE `account` SET `pass`='$pass' WHERE `email`='$email'");
        if($query){
            $db->query("DELETE FROM recover WHERE email='$email'");
            return true;
        }
        return false;
    }

    function getEmailFromHash($db,$hash){
        $query = $db->query("SELECT * FROM recover WHERE hash='$hash'");
        if(($query->num_rows)>0){
            $row= $query->fetch_array();
            return $row['email'];
        }
        return false;
    }

    function getExerListForInstructors($db){
        $id = getInstructorsFromIdAccout($db,$_SESSION['user']['id'])['id'];
        $query = $db->query("SELECT message.id, groups.groups, message.title, message.message, message.date  FROM message JOIN groups ON message.id_to=groups.id WHERE message.id_from=$id");
        if(($query->num_rows)>0)
            return $query;
        else
            return null;
    }

    function getExerListForStudent($db){
        $id = $_SESSION['user']['groups'];
        $query = $db->query("SELECT message.id, instructor.first_name, instructor.surname, instructor.last_name, message.title, message.message, message.date  FROM message JOIN instructor ON message.id_from=instructor.id WHERE message.id_to=$id");
        if(($query->num_rows)>0)
            return $query;
        else
            return null;
    }

    function getExerFromId($db,$id){
        $query= $db->query("SELECT * FROM message WHERE id=$id");
        $rows = $query->num_rows;
        if($rows>0)
            return $query->fetch_array();
        else
            return null;
    }

    function getUserFromId($db,$id){
        $query = $db->query("SELECT account.id, account.avatar, role.role FROM `account` JOIN `role` ON account.role = role.id  WHERE account.id='$id'");
        if(($query->num_rows)>0){
            return $query->fetch_array();
        }
        return false;
    }

    function getUserFromAccount($db,$id,$role){
        switch ($role) {
            case 'admin':
                return null;
                break;
            case 'student':
                return $db->query("SELECT * FROM student WHERE account=$id")->fetch_array();
                break;
            case 'prep':
                return $db->query("SELECT * FROM instructor WHERE account=$id")->fetch_array();
                break;
            default:
                break;
        }
    }
    function getNews($db){
        $query= $db->query("SELECT * FROM news LIMIT 3");
        $rows = $query->num_rows;
        if($rows>0)
            return $query;
        else
            return null;
    }
    function getNewsNoLimit($db){
        $query= $db->query("SELECT * FROM news");
        $rows = $query->num_rows;
        if($rows>0)
            return $query;
        else
            return null;
    }

    function getNewsFromId($db,$id){
        $query= $db->query("SELECT * FROM news WHERE id = $id");
        $rows = $query->num_rows;
        if($rows>0)
            return $query->fetch_array();
        else
            return null;
    }

    function getStud($db){
        $query= $db->query("SELECT student.id AS id, student.first_name AS first_name, student.surname AS surname, student.last_name AS last_name, groups.groups AS groups, student.birth_date AS birth_date, student.start_date AS start_date, student.account AS account FROM student JOIN groups ON student.groups=groups.id");
        $rows = $query->num_rows;
        if($rows>0)
            return $query;
        else
            return null;
    }

    function getStudFromGroups($db,$id){
        $query= $db->query("SELECT * FROM student WHERE groups='$id'");
        $rows = $query->num_rows;
        if($rows>0)
            return $query;
        else
            return null;
    }

    function getStudFromId($db,$id){
        $query = $db->query("SELECT * FROM student WHERE id='$id'");
        if(($query->num_rows)>0)
            return $query->fetch_array();
        else
            return null;
    }

    function getStudFromIdAccount($db,$id){
        $query = $db->query("SELECT * FROM student WHERE account='$id'");
        if(($query->num_rows)>0)
            return $query->fetch_array();
        else
            return null;
    }

    function getInstructors($db){
        $query = $db->query("SELECT * FROM instructor");
        if(($query->num_rows)>0)
            return $query;
        else
            return null;
    }

    function getInstructorsFromId($db,$id){
        $query = $db->query("SELECT * FROM instructor WHERE id=$id");
        if(($query->num_rows)>0)
            return $query->fetch_array();
        else
            return null;
    }

    function getInstructorsFromIdAccout($db,$id){
        $query = $db->query("SELECT * FROM instructor WHERE account=$id");
        if(($query->num_rows)>0)
            return $query->fetch_array();
        else
            return null;
    }
    function getGroups($db){
        $query = $db->query("SELECT * FROM groups");
        if(($query->num_rows)>0)
            return $query;
        else
            return null;
    }

    function getGroupsFromId($db,$id){
        $query = $db->query("SELECT * FROM groups WHERE id=$id");
        if(($query->num_rows)>0)
            return $query->fetch_array();
        else
            return null;
    }

    function getGroupsForStudent($db,$id){
        $query = $db->query("SELECT * FROM groups WHERE id=$id");
        if(($query->num_rows)>0)
            return $query->fetch_array();
        else
            return null;
    }

    function getGroupsWithoutStudent($db,$id){
        $query = $db->query("SELECT * FROM groups WHERE id<>$id");
        if(($query->num_rows)>0)
            return $query;
        else
            return null;
    }

    function getCountStudentInGroup($db,$id){
        $query = $db->query("SELECT COUNT(student.id) AS count FROM student JOIN groups ON student.groups=groups.id WHERE student.groups='$id'");
        if(($query->num_rows)>0)
            return $query->fetch_array()['count'];
        else
            return "0";
    }
    function getSklo($number)
    {
        $one =' год';
        $two1 =' года';
        $three =' лет';
        $first = substr( $number , -1);
        $two = substr( $number , -2);
        if($first =='1' and $two !='11') { return $number.$one;}
        elseif($first =='2' and $two !='12') { return $number.$two1;}
        elseif($first =='3' and $two !='13') { return $number.$two1;}
        elseif($first =='4' and $two !='14') { return $number.$two1;}
        else{ return $number.$three; }

    }


    function addNews($db,$data){
        $news= $data['news'];
        $date = getTimeMoscow();
        $db->query("INSERT INTO news (`news`, `date`) VALUES ('$news', '$date')");
        header('Location: /?loc=viewNews');
    }


    function addInstructor($db,$data){
        $first_name= $data['first_name'];
        $surname = $data['surname'];
        $last_name = $data['last_name'];
        $drive_exp = $data['drive_exp'];
        $education = $data['education'];
        $email = $data['email'];
        $pass = md5($data['pass']);
        $db->query("INSERT INTO `account`(`email`, `pass`, `role`) VALUES ('$email', '$pass', 4)");
        $query = $db->query("SELECT id FROM account ORDER BY id DESC LIMIT 1")->fetch_array();
        $id = $query['id'];
        $db->query("INSERT INTO `instructor`(`first_name`, `surname`, `last_name`, `drive_exp`, `education`, `account`) VALUES ('$first_name','$surname','$last_name','$drive_exp','$education', '$id')");


        header("Location: /?loc=viewPrep");
    }

    function addGroups($db,$data){
        $groups = $data['groups'];
        $db ->query("INSERT INTO `groups` (`groups`) VALUE ('$groups')");
        header('Location: /?loc=viewGroup');
    }

    function addStud($db,$data){
        $first_name= $data['first_name'];
        $surname = $data['surname'];
        $last_name = $data['last_name'];
        $groups = $data['groups'];
        $birth_date = $data['birth_date'];
        $start_date = $data['start_date'];
        $email = $data['email'];
        $pass = md5($data['pass']);
        $db->query("INSERT INTO `account`(`email`, `pass`, `role`) VALUES ('$email', '$pass', 2)");
        $query = $db->query("SELECT id FROM account ORDER BY id DESC LIMIT 1")->fetch_array();
        $id = $query['id'];
        $db->query("INSERT INTO `student`(`first_name`, `surname`, `last_name`, `groups`, `birth_date`, `start_date`, `account`) VALUES ('$first_name', '$surname', '$last_name', '$groups', '$birth_date', '$start_date', '$id')");
        header("Location: /?loc=viewStud");
    }
    function addExer($db,$data,$file){
        $groups = $data['groups'];
        $title = $data['title'];
        $message = $data['message'];
        $from = getInstructorsFromIdAccout($db,$_SESSION['user']['id'])['id'];
        $file = checkFile($db,$file);
        $date = getTimeMoscow();
        $query = $db->query("INSERT INTO message (`id_from`,`id_to`,`title`,`message`, `file`, `date`) VALUES ('$from','$groups','$title','$message', '$file', '$date')");
        header('Location: /?loc=viewExer');
    }

    function editNews($db,$data){
        $id = $data['id'];
        $news = $data['news'];
        $db->query("UPDATE news SET `news`='$news' WHERE `id`='$id'");
        header('Location: /?loc=viewNews');
    }

    function editInstructor($db,$data){
        $id = $data['id'];
        $first_name= $data['first_name'];
        $surname = $data['surname'];
        $last_name = $data['last_name'];
        $drive_exp = $data['drive_exp'];
        $education = $data['education'];
        $query = $db->query("UPDATE `instructor` SET `first_name`='$first_name',`surname`='$surname',`last_name`='$last_name',`drive_exp`='$drive_exp',`education`='$education' WHERE `id`='$id'");
        header("Location: /?loc=viewPrep");
    }

    function editStud($db,$data){
        $id = $data['id'];
        $first_name= $data['first_name'];
        $surname = $data['surname'];
        $last_name = $data['last_name'];
        $groups = $data['groups'];
        $birth_date = $data['birth_date'];
        $start_date = $data['start_date'];
        $query = $db->query("UPDATE `student` SET `first_name`='$first_name',`surname`='$surname',`last_name`='$last_name',`groups`='$groups',`birth_date`='$birth_date',`start_date`='$start_date' WHERE `id`='$id'");
        header("Location: /?loc=viewStud");
    }

    function editGroups($db,$data){
        $id = $data['id'];
        $groups = $data['groups'];
        $db->query("UPDATE `groups` SET `groups`='$groups' WHERE `id`='$id'");
        header('Location: /?loc=viewGroup');
    }

    function editAvatar($db,$data){
        if(isset($data['avatar'])) {
            $avatar = $data['avatar'];
            $file_name=$avatar['name'];
            $type = $avatar['type'];
            $size = $avatar['size'];
            $dir = $_SERVER['DOCUMENT_ROOT']."/img/avatar/";
            $name = md5(time().$file_name);
            $sub_type = ".".substr($type,strlen("image/"));
            $file = $dir.$name.$sub_type;
            if (($type == "image/jpg") || ($type == "image/png") || ($type == "image/jpeg")) {
                if($size<=200*1024){
                    if(move_uploaded_file($avatar['tmp_name'],$file)){
                        $size = getimagesize($file);
                        if($size[0]<=1000 && $size[1]<=1000){
                            $id = $_SESSION['user']['id'];
                            $query = $db->query("UPDATE `account` SET `avatar`='$name$sub_type' WHERE `id`='$id'" );
                            if($query){
                                header('Location: /?loc=lk');
                            }
                            else{
                                $_SESSION['error']="Ошибка в обработке запроса";
                                unlink($file);
                                header('Location: /?loc=editAvatar');
                            }
                        }
                        else{
                            $_SESSION['error']="Размер файла превышен.";
                            unlink($file);
                            header('Location: /?loc=editAvatar');
                        }
                    }else {
                        $_SESSION['error'] = "Ошибка загрузки файла";
                        header('Location: /?loc=editAvatar');
                    }
                }else {
                    $_SESSION['error'] = "Объём файла больше 200КБ.";
                    header('Location: /?loc=editAvatar');
                }
            }else {
                $_SESSION['error'] = "Формат файла не поддерживается.";
                header('Location: /?loc=editAvatar');
            }
        }else {
            $_SESSION['error'] = "Файл не загружен!";
            header('Location: /?loc=editAvatar');
        }

}

    function deleteNews($db,$id){
        $db->query("DELETE FROM `news` WHERE `id` = '$id'");
        header('Location: /?loc=viewNews');
    }

    function deleteStud($db,$id){
        $query = $db->query("SELECT * FROM student WHERE id='$id'")->fetch_array();
        $idAcc = $query['account'];
        $db->query("DELETE FROM `student` WHERE `id`='$id'");
        $db->query("DELETE FROM `account` WHERE `id`='$idAcc'");
        header('Location: /?loc=viewStud');
    }

    function deleteGroup($db,$id){
        $query = $db->query("SELECT * FROM groups JOIN student ON groups.id=student.groups WHERE student.groups='$id'");
        if($query->num_rows==0) {
            $query = $db->query("DELETE FROM `groups` WHERE `id`='$id'");
            header('Location: /?loc=viewGroup');
        }
        return true;
    }
    function deleteInstructor($db,$id){
        $query = $db->query("SELECT * FROM instructor WHERE id='$id'")->fetch_array();
        $idAcc = $query['account'];
        $db->query("DELETE FROM `instructor` WHERE `id`='$id'");
        $db->query("DELETE FROM `account` WHERE `id`='$idAcc'");
        header('Location: /?loc=viewPrep');
    }
?>