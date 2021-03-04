<?php
session_start();
	if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && !empty($_GET['id']) ) {
	$id = $_GET['id'];
	//find and remove
	$count = count($_SESSION['favorites']);
	for ($i = 0; $i< $count; $i++){
			if ($_SESSION['favorites'][$i][0]==$id){
			unset($_SESSION['favorites'][$i]);
			}
	}
	$_SESSION['favorites'] = array_values($_SESSION['favorites']);
	
	header("Location: view-favorites.php");
	
	} else {
	//clear everything
	
	$_SESSION = array();
    session_destroy();
	
	header("Location: view-favorites.php");
	}
?>