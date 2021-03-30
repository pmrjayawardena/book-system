<?php
include '../common/dbconnection.php'; //include database connection
include '../model/usermodel.php';   //include login model

$obuser= new user(); //create an object using login class

$nic=$_GET['q']; //get the typed email to the variable $email from the check Email function

// $patemail='/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z]{2,6})+$/'; // use to perform a pattern match on the email

if($nic){ 
$n=$obuser->checkNIC($nic);   //check the input email with database email list
    if($n==1){                     //if the result is match meaning theres and existing email in the database
        echo "<i class='alert-danger'>Not available</i>";   // show error message not available 
        $status=1;          //declar a variable $status=1 for not available state
    }else{
        echo "<i class='alert-sucess'>Available<i>";  //if the result is zero meaning theres no existing email in the database and show message available
         $status=0; //declare a variable $status=0 for available state
    }


}
?>
<input type="hidden" name="hid" id="hid" value="<?php echo $status?>" />  <!-- //get the status to the input feild as a hidden value -->