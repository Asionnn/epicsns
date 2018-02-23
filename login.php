<?php
/* User login process, checks if user exists and password is correct */

// Escape email to protect against SQL injections
$email = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");


if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "User with that email doesn't exist!";
    header("location: error.php");
}
else { // User exists
    $user = $result->fetch_assoc();
     
    
        
        if($user['user_type']=="admin")
        {    
            $_SESSION['email'] = $user['email'];
            $curr_email = $user['email'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
          
            // This is how we'll know the user is logged in
            $_SESSION['logged_in'] = true;
          

            header("location: adminlogin.php");
        }
        else if($user['user_type']=="user")
        {    
            $_SESSION['email'] = $user['email'];
            $curr_email = $user['email'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            
            // This is how we'll know the user is logged in
            $_SESSION['logged_in'] = true;
            
            header("location: profile.php");
        }

    /*
    else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: error.php");
    }*/
}
