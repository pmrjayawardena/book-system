<?php

class login
{
    
    function userlogin($user_nic, $user_pwd, $status)
    {
        
        global $con;
        
        $r = $con->prepare("SELECT * FROM login l,user u,role r WHERE l.user_id=u.user_id AND u.role_id=r.role_id AND l.user_nic=? AND l.user_pwd=? AND u.user_status=?"); // we use ? to prevent from sql injection attacks
        $r->execute(array(
            $user_nic,
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
    
    function checkEmail($user_email)
    {
        
        global $con;
        
        $r = $con->prepare("SELECT * FROM login WHERE user_email=?"); // we use ? to prevent from sql injection attacks
        $r->execute(array(
            $user_email
        )); // pass values using arrays
        $n = $r->rowCount();
        if ($r->errorCode() != 0) {
            $errors = $r->errorInfo();
            echo $errors[2];
            
        }
        
        return $n;
        
    }
    
}

?>