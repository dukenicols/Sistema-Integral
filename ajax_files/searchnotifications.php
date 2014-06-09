<?php

require_once('../../core/classes/database.class.php');
require_once('../classes/notifications.class.php');
$notificaciones = new Notifications();
$data = $notificaciones->get_new_notifications($_GET['id'],$_GET['last']);


print $data;




?>