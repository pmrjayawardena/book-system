<?php
include '../common/dbconnection.php';
include '../model/usermodel.php';
include '../model/loginmodel.php';
$obu = new user();
$action = $_REQUEST['action'];

switch ($action)
{
    case "add":
        $arr = $_POST;

        $user_id = $obu->addUser($arr); //add user details to db and get the last inserted id
        // $group_id = $obu->addToGroup($_POST['group_id'],$_POST['user_nic']);
        $msg = 'not';
      
       
        if ($user_id)
        { //If user has been added then
            echo $user_pwd = sha1($_POST['password']); //encrypt the default password using sha1 and asign to a variable
            $obu->addlogin($_POST['user_nic'], $user_pwd, $user_id); //add the email and password to login table
            

            if ($_FILES['user_image']['name'] != "")
            { //if image is not empty
                $user_image = $_FILES['user_image']['name']; //name off the image
                $user_tmp = $_FILES['user_image']['tmp_name']; //temp location
                $user_image_new = time() . "_" . $user_id . "_" . $user_image;
                $r = $obu->updateUserImage($user_id, $user_image_new, $user_tmp);
            }

            $msg1 = base64_encode("A record has $msg been added");
            header("Location:../view/student_register.php?msg1=$msg1"); //redirection if the user added
            
        }
        else
        {
            $msg2 = base64_encode("A record has $msg been added");
            header("Location:../view/student_register.php?msg2=$msg2"); //redirection is the process failed
            
        }

    break;

}

?>
