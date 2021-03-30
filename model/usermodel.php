<?php
class user
{
    
    function userlogin($user_email, $user_pwd, $status)
    {
        
        global $con;
        
        $r = $con->prepare("SELECT * FROM login l,user u,role r WHERE l.user_id=u.user_id AND u.role_id=r.role_id AND l.user_email=? AND l.user_pwd=? AND u.user_status=?"); // we use ? to prevent from sql injection attacks
        
        $r->execute(array(
            $user_email,
            $user_pwd,
            $status
        )); // pass values using arrays
        
        if ($r->errorCode() != 0) {
            $errors = $r->errorInfo();
            echo $errors[2];
            
        }
        
        return $r;
        
        
    }
    function addlogin($user_email, $user_pwd, $user_id)
    {
        
        global $con;
        
        $r = $con->prepare("INSERT INTO login VALUES(?,?,?)"); // we use ? to prevent from sql injection attacks
        
        $r->execute(array(
            $user_email,
            $user_pwd,
            $user_id
        )); // pass values using arrays
        
        if ($r->errorCode() != 0) {
            $errors = $r->errorInfo();
            echo $errors[2];
            
        }
        
        return $r;
        
        
    }
    
    
    
    function checkNIC($nic)
    {
        
        global $con;
        
        $r = $con->prepare("SELECT * FROM login WHERE user_nic=?"); // we use ? to prevent from sql injection attacks
        
        $r->execute(array(
            $nic
        )); // pass values using arrays
        $n = $r->rowCount();
        if ($r->errorCode() != 0) {
            $errors = $r->errorInfo();
            echo $errors[2];
            
        }
        
        return $n;
        
        
    }
    
    public function addUser($arr)
    {
        global $con;
        
        $r = $con->prepare("INSERT INTO user (user_fname,role_id,user_nic,user_status,user_email) VALUES (?,?,?,?,?)");
        $r->execute(array(
            $arr['user_fname'],
            2,
            $arr['user_nic'],
            "Active",
            $arr['user_email']
        ));
        $user_id = $con->lastinsertId();
        return $user_id;
        
        if ($r->errorCode() != 0) {
            $errors = $r->errorinfo();
            echo $errors[2];
        }
    }
    
    
    public function updateUser($arr, $user_id)
    {
        global $con;
        
        $r = $con->prepare("UPDATE user SET user_fname=?,user_email=? WHERE user_id=?");
        $r->execute(array(
            $arr['user_fname'],
            $arr['user_email'],
            $user_id
        ));
        
        return $r;
        
        if ($r->errorCode() != 0) {
            $errors = $r->errorinfo();
            echo $errors[2];
        }
    }
    
    
    public function updateUserImage($user_id, $user_image_new, $user_tmp)
    {
        global $con;
        $r = $con->prepare("UPDATE user SET user_image=? WHERE user_id=?");
        $r->execute(array(
            $user_image_new,
            $user_id
        ));
        if ($r) {
            $path = "../images/user_images/" . $user_image_new;
            move_uploaded_file($user_tmp, $path);
        }
        if ($r->errorCode() != 0) {
            $errors = $r->errorinfo();
            echo $errors[2];
        }
        return $r;
    }
    
    
    
}

?>