<?php
require 'includes/functions.php';

if($_GET['type'] == 'login')
{      
        // assume not found
        $found   = false;
        $message = '<div class="alert alert-danger text-center">
                        Login not found! Try again.
                    </div>';
        
        $user = trim($_POST['user']);
        $pass = trim($_POST['password']);
    
        if(checkUsername($user))
        {
            $found = findUser($user, $pass, 'username');
        }
        elseif(checkPhoneNumber($user))
        {
            $found = findUser($user, $pass, 'phone');
        }
        if($found)
    {   
        session_start();
        $_SESSION['username'] = $user;
        header('Location: thankyou.php?type=login&username='.$user);
        exit();
    } else {
        setcookie("error_message",$message,time() + 1);
        header('Location: login.php');
        exit();
    }
}

if($_GET['type'] == 'signup')
{
    
    $user = trim($_POST['username']);
    $message = '';
    $check = checkSignUp($_POST);

    if($check !== true)
    {
        $message = '<div class="alert alert-danger text-center">
                        '.$check.' 
                    </div>';
        setcookie("error_message",$message,time() + 1);
        header('Location: signup.php');
        exit();
    }
    else
    {
        if(saveUser($_POST))
        {
            session_start();
            $_SESSION['username'] = $user;
            header('Location: thankyou.php?type=signup&username='.$_POST['username']);
            exit();
        }
        else
        {
            $message = '<div class="alert alert-danger text-center">
                            Unable to sign up at this time.
                        </div>';
        }
    }
}

?>