<?php

function generateNew($line){
    $eachPost2 = preg_split("/\|/", $line);
    $fp = fopen('posts1.txt', 'a+'); 
    fwrite($fp, trim($eachPost2[0]) . '|' . trim($eachPost2[1]) . '|' . trim($eachPost2[2]) . '|' . trim($eachPost2[3]) . '|' . trim($eachPost2[4]) . PHP_EOL);
    fclose($fp);
}


session_start();
if(isset($_SESSION['username'])){
    $user = $_SESSION['username'];
    $id = $_GET['id'];
    $postLines = file('posts.txt');
 
     foreach($postLines as $post2){
         echo 'sai do loop <br />';
         $eachPost2 = preg_split("/\|/", $post2);
         echo 'aqui segundo loop <br />';
             if((trim($id) != trim($eachPost2[0])) || (trim($user) != trim($eachPost2[1]))){
             echo 'aqui 4 <br />';
             generateNew($post2);
         }else{
             echo 'aqui 5 <br />';
             header("Location:posts.php");
         }
     
     }

     unlink('posts.txt');
     rename('posts1.txt','posts.txt');
     header("Location:posts.php");


    }
         else 
            {
              header("Location: index.php");   
            }
