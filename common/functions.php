<?php

   //To get remote ip address - http://stackoverflow.com/questions/15699101/get-the-client-ip-address-using-php
    function get_ip_address(){
        $ipaddress='';
        if(isset($_SERVER['HTTP_CLIENT_IP'])){
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        }else if(isset($_SERVER['HTTP_FORWARDED_FOR'])){
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];       
        }else if(isset($_SERVER['REMOTE_ADDR'])){
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        }else{
            $ipaddress="UNKNOWN";
        }
        return $ipaddress;
    }
    
 function checkModuleRole($m_id,$role_id){ //check if a user has a permission to a perticular model
     global  $con;
      
        $r=$con->prepare("SELECT * FROM module_role  WHERE m_id=? AND role_id=?"); 
        
        $r->execute(array($m_id,$role_id)); 
        $count=$r->rowCount();
        if($r->errorCode()!=0){
            $errors = $r -> errorInfo();
            echo $errors[2];
            
        }
        
        return $count;
 }


