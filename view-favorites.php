<?php
session_start();

	// echo "<pre>";
	// print_r($_SESSION['favorites']);
	// echo "</pre>";
	if (isset($_SESSION['favorites']) && count($_SESSION['favorites'])>0){
	for ($i = 0; $i<count($_SESSION['favorites']); $i++){
		//due to the small picture not downloading i used the mediums
            //echo '<a><img src="images/art/works/square-medium/'.$_SESSION['favorites'][$i][1].'.jpg"></a>';
			echo '<a><img src="images/art/works/small-square/'.$_SESSION['favorites'][$i][1].'.jpg" alt = "No image found"></a>';
            echo '<div>';
            echo ' <a href="single-painting.php?id=' . $_SESSION['favorites'][$i][0].'">'.$_SESSION['favorites'][$i][2].'</a>';
			echo '<br>';
            echo ' <a href="remove-favorites.php?id=' . $_SESSION['favorites'][$i][0].'"> Remove All Painting of this type from List</a>';
			echo '</div>';      
	}
	echo '<br>';
	echo ' <a href="remove-favorites.php"> Clear List</a>';
	echo '<br>';
	echo ' <a href="browse-paintings.php?">You can use this link to return to the main page of the website!</a>';
	}else {
	echo "Favorites is empty!";
	echo ' <a href="browse-paintings.php?">You can use this link to return to the main page of the website!</a>';
	}
?>