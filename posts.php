<?php
session_start();
if(isset($_SESSION['username']))
{   
    $user = $_SESSION['username'];
    $checkPreg = false;

    if(file_exists('posts.txt')){
        $postLines = file('posts.txt');
    }

    if(count($_POST) > 0){
      if(preg_match('/[a-z]+$/i', trim($_POST['title'])) &&
         preg_match('/[a-z0-9\,.\?\!]+$/i', trim($_POST['comment'])) &&
         preg_match('/[1-3]{1}/i', trim($_POST['priority'])) &&
         $user == trim($_POST['username'])) 
         {
            $checkPreg = true;
         }    
    }

    if($checkPreg == true) {
        $fp = fopen('posts.txt', 'a+');
        $title = trim($_POST['title']);   
        $comment = trim($_POST['comment']);  
        $priority = trim($_POST['priority']);
        
        if($priority == 1) {
            $priority = 'panel-danger';
        }elseif($priority == 2){
            $priority = 'panel-warning';
        }elseif($priority == 3){
            $priority = 'panel-info';
        }
        
        $id = uniqid("");
        fwrite($fp, $id . '|' . $user . '|' . $title . '|' . $comment . '|' . $priority . PHP_EOL);
        fclose($fp);
        header("location:posts.php");
    }

}
    else 
{
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>COMP 3015</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<div id="wrapper">

    <div class="container">
          
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <h1 class="login-panel text-center text-muted">
                    COMP 3015 Assignment 2      
                </h1>
                <hr/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <button class="btn btn-default" data-toggle="modal" data-target="#newPost"><i class="fa fa-comment"></i> New Post</button>
                <a href="logout.php" class="btn btn-default pull-right"><i class="fa fa-sign-out"> </i> Logout</a>
                <hr/>
            </div>
        </div>


<div id="newPost" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
    <form role="form" method="post" action="posts.php">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">New Post</h4>
        </div>
        <div class="modal-body">
                <div class="form-group">
                    <input class="form-control" placeholder="Username" value="<?php echo $user ?>" name="username" required>
                </div>
                <div class="form-group">
                    <label>Title</label>
                    <input class="form-control" placeholder="" name="title" required>
                </div>
                <div class="form-group">
                    <label>Comment</label>
                    <textarea class="form-control" rows="3" name="comment" required></textarea>
                </div>
                <div class="form-group">
                    <label>Priority</label>
                    <select class="form-control" name="priority">
                        <option value="1">Important</option>
                        <option value="2">High</option>
                        <option value="3">Normal</option>
                    </select>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" value="Post!"/>
        </div>
    </div><!-- /.modal-content -->
    </form>
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php       
         if(isset($postLines)){
             foreach($postLines as $post){
             $eachPost = preg_split("/\|/", $post);
                if(trim($eachPost[4]) == 'panel-danger'){
                $danger = 'panel-danger';
                $postCode = '<div class="row">
                        <div class="col-md-6 col-md-offset-3">
                        <div class="panel '.$danger.'">
                        <div class="panel-heading">
                            <span>'.$eachPost[2].'
                                
                            </span>
                            <span class="pull-right text-muted">
                                <a class="" href="delete.php?id='.trim($eachPost[0]).'">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </span>
                        </div>
                        <div class="panel-body">
                            <p class="text-muted">
                            </p>
                            <p>
                                '.$eachPost[3].'
                            </p>
                        </div>
                        <div class="panel-footer">
                            <p>
                                '.$eachPost[1].' 
                            </p>
                        </div>
                    </div>
                </div>
                </div> ';
                echo $postCode;
                }
            }
                foreach($postLines as $post){
                $eachPost = preg_split("/\|/", $post);
                if(trim($eachPost[4]) == 'panel-warning'){
                    $warning = 'panel-warning';
                    $postCode = '<div class="row">
                            <div class="col-md-6 col-md-offset-3">
                            <div class="panel '.$warning.'">
                            <div class="panel-heading">
                                <span>'.$eachPost[2].'
                                    
                                </span>
                                <span class="pull-right text-muted">
                                    <a class="" href="delete.php?id='.$eachPost[0].'">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>
                                </span>
                            </div>
                            <div class="panel-body">
                                <p class="text-muted">
                                </p>
                                <p>
                                    '.$eachPost[3].'
                                </p>
                            </div>
                            <div class="panel-footer">
                                <p>
                                    '.$eachPost[1].' 
                                </p>
                            </div>
                        </div>
                    </div>
                    </div> <br />';
                    echo $postCode;
                    }
                }
                foreach($postLines as $post){
                $eachPost = preg_split("/\|/", $post);
                    if(trim($eachPost[4]) == 'panel-info'){
                    $info = 'panel-info';
                    $postCode = '<div class="row">
                            <div class="col-md-6 col-md-offset-3">
                            <div class="panel '.$info.'">
                            <div class="panel-heading">
                                <span>'.$eachPost[2].'
                                    
                                </span>
                                <span class="pull-right text-muted">
                                    <a class="" href="delete.php?id='.$eachPost[0].'">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>
                                </span>
                            </div>
                            <div class="panel-body">
                                <p class="text-muted">
                                </p>
                                <p>
                                    '.$eachPost[3].'
                                </p>
                            </div>
                            <div class="panel-footer">
                                <p>
                                    '.$eachPost[1].' 
                                </p>
                            </div>
                        </div>
                    </div>
                    </div>';
                    echo $postCode;
                    }
            }
            }
        ?>
</body>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>
