<?php
session_start();

require_once ('../../core/classes/database.class.php');
require_once('../classes/posts.class.php');
require_once('../classes/socialmediausers.class.php');


$posts = new Posts();

$posts->rowid   = $_GET['post'];
$posts->user_id = $_GET['user'];
$posts->description = $_GET['msg'];

date_default_timezone_set('America/Argentina/Buenos_Aires');


$msg = $_GET['msg'];
$date = date('Y-m-d H:i:s');
$date = date('c', strtotime($date));

$posts->datec = $date;

if(isset($_GET)){
    
        $data = $posts->reject_post();
        
      	
        
            print '<div class="comments clearfix">
                    <div class="pull-left lh-fix">
                        <img src="http://www.akshitsethi.me/labs/comments/img/default.gif">
                    </div>

                    <div class="comment-text">
                        <span class="color strong" style="margin-left:5px;"><a href="#">'.$data->userFullName.'</a></span> &nbsp;'.$msg.'
                        <span class="info" style="margin-left:5px;"><abbr class="time" title="'.$date.'"></abbr></span>
                    </div>
                </div>';
         
        

    
}

                
                

        