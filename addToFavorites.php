<?php 
session_start();

	if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['name']) && !empty($_GET['name']) && isset($_GET['title']) && !empty($_GET['title'])) {
   $id = $_GET['id'];
   $name = $_GET['name'];
   $title = $_GET['title']; 
   
   if (!(isset($_SESSION['favorites']))){
	   //when not created
	$_SESSION['favorites'] = array(array($id,$name,$title));
   
   // $_SESSION = array();
   // session_destroy();
   
   header("Location: view-favorites.php");
	
   }else { 
   //when created already
   $_SESSION['favorites'][]=array($id,$name,$title);
	
	
	header("Location: view-favorites.php");
	
	// $_SESSION = array();
	// session_destroy();
   }
} else {
	echo 'ERROR one of your values is Either not set of the your server did not send a get mothod!';   
}



?>