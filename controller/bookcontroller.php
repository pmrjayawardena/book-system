<?php
include '../common/dbconnection.php';
include '../model/bookmodel.php';
include '../model/loginmodel.php';
include '../common/sessionhandling.php';
include '../PHPMailer/PHPMailerAutoload.php';

$obb = new book();
$action = $_REQUEST['action'];

switch ($action)
{
    case "add":
        $arr = $_POST;
        function clean($string) {
            $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
         
            return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
         }

        $description=clean($arr['description']);
        $book_title=clean($arr['book_title']);
        $isbn=clean($arr['isbn']);
        $author_name=clean($arr['author_name']);
        $user_id = $userinfo['user_id'];
        
        $book_id = $obb->addBook($isbn,$book_title,$author_name, $description,$user_id); //add Book details to db and get the last inserted id
        if ($book_id)
        { //If book has been added then
            if ($_FILES['book_image']['name'] != "")
            { //if image is not empty
                $book_image = $_FILES['book_image']['name']; //name off the image
                $book_tmp = $_FILES['book_image']['tmp_name']; //temp location
                $book_image_new = time() . "_" . $book_id . "_" . $book_image;
                $r = $obb->updateBookImage($book_id, $book_image_new, $book_tmp);
            }

            $msg1 = base64_encode("A record has $msg been added");
            header("Location:../view/allbooks.php?msg1"); //redirection if the book added
            
        }
        else
        {
            $msg2 = base64_encode("A record has $msg been added");
            header("Location:../view/add_book.php?msg2"); //redirection is the process failed
            
        }

    break;

    case "update": //update a perticular book
        $arr = $_POST; //get the details of the book from the form
        $book_id = $_POST['book_id']; //request the book id
        $result = $obb->updateBook($arr, $book_id); //update a perticular book
        if ($result)
        { //if the book is updated
            $msg = "A record has been updated";
            $status = "success";

            if ($_FILES['book_image']['name'] != "")
            { //if image is not empty
               
                     //to remove previous image
                     $resultbook=$obb->viewABook($user_id);
                     $rowbook=$resultbook->fetch(PDO::FETCH_BOTH);
                     $book_pimage=$rowbook['book_image'];
                     $oldpath="../images/book_images/".$book_pimage;
                     unlink($oldpath);
     
                     $book_image=$_FILES['book_image']['name'];//name off the image
                     $book_tmp=$_FILES['book_image']['tmp_name'];//temp location
                     $book_image_new=time()."_".$book_id."_".$book_image;
                     $r=$obb->updateBookImage($book_id, $book_image_new, $book_tmp);
            }
        }
        else
        {
            $msg = "A record has not been updated";
            $status = "danger";
        }

        header("Location:../view/editbook.php?msg1&book_id=$book_id"); //redirection
        
    break;

    case 'delete':
        $book_id = $_REQUEST['book_id'];
        $result = $obb->deleteBook($book_id); //update a perticular user
        if ($result)
        { //if the user is updated
            header("Location:../view/allbooks.php?msg2"); //redirection
            
        }
        else
        {
            $msg = "A record has not been updated";
            $status = "danger";
        }

    break;
    case 'rate':

        $rating = $_POST['rating'];
        $comment = $_POST['comment'];
        $book_id = $_REQUEST['book_id'];
        $user_id = $userinfo['user_id'];
        $singleRating = $obb->viewARating($user_id,$book_id);
        $nou = $singleRating->rowCount();
        if ($nou >= 1)
        {
            $result = $obb->updateRating($book_id, $user_id, $rating, $comment); //update a perticular user
            
        }
        else
        {
            $result = $obb->rateBook($book_id, $user_id, $rating, $comment); //update a perticular user
            
        }
        if ($result)
        { //if the user is updated
            header("Location:../view/allbooks.php"); //redirection
            
        }
        else
        {
            $msg = "A record has not been updated";
            $status = "danger";
        }

    break;

}

?>
