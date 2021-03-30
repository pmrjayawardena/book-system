<?php
class book
{
    public function viewAllBooks() //view all user data
    {
        global $con;
        $r = $con->prepare("SELECT * FROM book");
        $r->execute();
        return $r;
    }
    
    public function getSingleBook($book_id) //view all user data
    {
        global $con;
        $r = $con->prepare("SELECT * FROM book WHERE id=?");
        $r->execute(array(
            $book_id
        ));
        return $r;
    }
    public function allRating($book_id) //view all user data
    {
        global $con;
        $r = $con->prepare("SELECT * FROM book_rating WHERE book_id=?");
        $r->execute(array(
            $book_id
        ));
        return $r;
    }

    public function  getRatingCount($user_nic){  //view all user data
        global $con;
        $r=$con->prepare("SELECT * FROM user_rating WHERE user_nic='$user_nic' ");
        $r->execute(array($user_nic));
        $n=$r->rowCount();
        return $n;
    }
    public function getTotalSumRating($rated_by){  //view all user data
        global $con;
        $r=$con->prepare("SELECT SUM(rating) FROM user_rating WHERE user_nic='$rated_by'");
        $r->execute(array($rated_by));
     
        return $r;
    }
    public function deleteBook($book_id) //view all user data
    {
        global $con;
        $r = $con->prepare("DELETE FROM book WHERE id=?");
        $r->execute(array(
            $book_id
        ));
        return $r;
    }
    public function rateBook($book_id, $user_id, $rating, $comment) //view all user data
    {
        
        global $con;
        $r = $con->prepare("INSERT INTO book_rating (user_id,book_id,rating,comment) VALUES (?,?,?,?)");
        $r->execute(array(
            $user_id,
            $book_id,
            $rating,
            $comment
        ));
        $rate_id = $con->lastinsertId();
        return $rate_id;
        
        if ($r->errorCode() != 0) {
            $errors = $r->errorinfo();
            echo $errors[2];
        }
    }
    
    public function updateRating($book_id, $user_id, $rating, $comment)
    {
        global $con;
        
        $r = $con->prepare("UPDATE book_rating SET rating=?,comment=? WHERE book_id=? AND user_id=?");
        $r->execute(array(
            $rating,
            $comment,
            $book_id,
            $user_id
        ));
        
        return $r;
        
        if ($r->errorCode() != 0) {
            $errors = $r->errorinfo();
            echo $errors[2];
        }
    }
    public function viewARating($user_id, $book_id) //view all user data
    {
        
        global $con;
        $r = $con->prepare("SELECT * FROM book_rating WHERE user_id=?  AND book_id=?");
        $r->execute(array(
            $user_id,
            $book_id
        ));
        
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
    
    
    public function viewBookLimited($start, $limit)
    {
        global $con;
        $r = $con->prepare("SELECT * FROM book  ORDER BY id ASC LIMIT $start,$limit");
        $r->execute();
        return $r;
    }
    
    
    public function addBook($arr, $description, $book_id)
    {
        global $con;
        $r = $con->prepare("INSERT INTO book (isbn,book_title,author_name,book_des,user_id) VALUES (?,?,?,?,?)");
        $r->execute(array(
            $arr['isbn'],
            $arr['book_title'],
            $arr['author_name'],
            $description,
            $book_id
        ));
        $book_id = $con->lastinsertId();
        return $book_id;
        
        if ($r->errorCode() != 0) {
            $errors = $r->errorinfo();
            echo $errors[2];
        }
    }
    public function updateBook($arr, $book_id)
    {
        global $con;
        
        $r = $con->prepare("UPDATE book SET isbn=?,book_title=?,author_name=?,book_des=? WHERE id=?");
        $r->execute(array(
            $arr['isbn'],
            $arr['book_title'],
            $arr['author_name'],
            $arr['description'],
            $book_id
        ));
        
        return $r;
        
        if ($r->errorCode() != 0) {
            $errors = $r->errorinfo();
            echo $errors[2];
        }
    }
    
    
    public function updateBookImage($book_id, $book_image_new, $book_tmp)
    {
        
        global $con;
        $r = $con->prepare("UPDATE book SET book_image=? WHERE id=?");
        $r->execute(array(
            $book_image_new,
            $book_id
        ));
        if ($r) {
            $path = "../images/book_images/" . $book_image_new;
            move_uploaded_file($book_tmp, $path);
        }
        if ($r->errorCode() != 0) {
            $errors = $r->errorinfo();
            echo $errors[2];
        }
        return $r;
    }
    
    public function viewABook($book_id) //To select a particular user
    {
        global $con;
        $r = $con->prepare("SELECT * FROM book WHERE id=?");
        $r->execute(array(
            $book_id
        ));
        return $r;
    }
    
    
    public function viewSearchBook($search) //view all user data
    {
        global $con;
        $r = $con->prepare("SELECT * FROM book WHERE book_title LIKE '$search%' OR author_name LIKE '$search%' OR isbn LIKE '$search'");
        $r->execute();
        
        return $r;
    }
    public function overallRating($book_id) //view all user data
    {
        global $con;
        $r = $con->prepare("SELECT * FROM book_rating WHERE book_id=?");
        $r->execute(array(
            $book_id
        ));
        return $r;
    }
    public function ratingSUM($book_id) //view all user data
    {
        global $con;
        $r = $con->prepare("SELECT SUM(rating) AS BookRate FROM book_rating WHERE book_id=?");
        $r->execute(array(
            $book_id
        ));
        return $r;
    }
    
    public function viewSearchBookLimited($search, $start, $limit) //view all user data
    {
        global $con;
        $r = $con->prepare("SELECT * FROM book  WHERE book_title LIKE '$search' OR author_name LIKE '$search' OR author_name LIKE '$search'  GROUP BY author_name ");
        
        
        $r->execute(array(
            $search
        ));
        
        
        return $r;
    }
    
    
    public function viewALoggedUser($user_id) //To select a particular user
    {
        global $con;
        $r = $con->prepare("SELECT * FROM user u,role r,login l WHERE u.role_id=r.role_id AND u.user_id=l.user_id AND u.user_id='$user_id'");
        $r->execute(array(
            $user_id
        ));
        return $r;
    }
    
}

?>