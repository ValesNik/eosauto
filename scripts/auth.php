<?php
    require_once 'db.php';
    require_once 'scripts.php';
    session_start();
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = trim($_POST['email']);
    $pass = md5(trim($_POST['pass']));
    $query = $db->query("SELECT account.id, account.avatar, role.role FROM `account` JOIN `role` ON account.role = role.id  WHERE account.email ='$email' AND account.pass='$pass'");
    $rows = $query->num_rows;
    if($rows>0){
        $array = $query->fetch_array();
        if($array['role']=='admin') {
            $_SESSION['user'] = [
                "id" => $array['id'],
                "role" => $array['role']
            ];
        }
        else{
            $user = getUserFromAccount($db,$array['id'],$array['role']);
            $_SESSION['user'] = [
                "id" => $array['id'],
                "role" => $array['role'],
                "first_name" => $user['first_name'],
                "surname" => $user['surname'],
                "last_name" => $user['last_name'],
                "groups" => $user['groups'],
                "avatar" => $array['avatar']
            ];
        }
        header("Location: ../");
    }
    else {
        $_SESSION['error'] = true;
        header("Location: ../?loc=login");
    }

}
?>