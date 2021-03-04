<?php
session_start(); 

define('DBCONNECTION', 'mysql:host=localhost;dbname=art');
define('DBUSER', 'testuser');
define('DBPASS', 'mypassword');

/* localhost mysql setup */
$pdo = new PDO(DBCONNECTION, DBUSER, DBPASS);

function setConnectionInfo($values=array()) {
      $connString = $values[0];
      $user = $values[1]; 
      $password = $values[2];

      $pdo = new PDO($connString,$user,$password);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;      
}


function runQuery($pdo, $sql, $parameters=array())     {
    // Ensure parameters are in an array
    if (!is_array($parameters)) {
        $parameters = array($parameters);
    }

    $statement = null;
    if (count($parameters) > 0) {
        // Use a prepared statement if parameters 
        $statement = $pdo->prepare($sql);
        $executedOk = $statement->execute($parameters);
        if (! $executedOk) {
            throw new PDOException;
        }
    } else {
        // Execute a normal query     
        $statement = $pdo->query($sql); 
        if (!$statement) {
            throw new PDOException;
        }
    }
    return $statement;
}

	
	echo '<!DOCTYPE html>';
	echo '<html lang=en>';
	echo '<head>';
	echo '<meta charset=utf-8>';
		echo '<link href="http://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet" type="text/css">';
		echo '<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">';
		echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>';
		echo '<script src="css/semantic.js"></script>';
		echo '<script src="js/misc.js"></script>';
		echo '<link href="css/semantic.css" rel="stylesheet" >';
		echo '<link href="css/icon.css" rel="stylesheet" >';
		echo '<link href="css/styles.css" rel="stylesheet">';
		echo '<style>';
		echo '* {';
		echo '  box-sizing: border-box;';
		echo '}';

		echo '.column {';
		echo '  float: left;';
		echo '  width: 33.33%;';
		echo '  padding: 5px;';
		echo '}';

		echo '.row::after {';
		echo '  content: "";';
		echo '  clear: both;';
		echo '  display: table;';
		echo '}';
		echo '</style>';
	echo '</head>';
	echo '<body>';
	
	echo '<header>';
    echo '<div class="ui attached stackable grey inverted  menu">';
        echo '<div class="ui container">';
            echo '<nav class="right menu">';            
                echo '<div class="ui simple  dropdown item">';
                  echo '<i class="user icon"></i>';
					echo 'Account';
                    echo '<i class="dropdown icon"></i>';
                  echo '<div class="menu">';
                    echo '<a class="item"><i class="sign in icon"></i> Login</a>';
                    echo '<a class="item"><i class="edit icon"></i> Edit Profile</a>';
                    echo '<a class="item"><i class="globe icon"></i> Choose Language</a>';
                    echo '<a class="item"><i class="settings icon"></i> Account Settings</a>';
                  echo '</div>';
                echo '</div>';
                echo '<a class=" item">';
				$favcount = 0;
				if (isset($_SESSION['favorites'])){
				$favcount = count($_SESSION['favorites']);
                  echo '<i class="heartbeat icon"></i> Favorites<div style="background-color:red;">';
				}else {
					echo '<i class="heartbeat icon"></i> Favorites<div style="background-color:red;">';
				}
				echo $favcount;
                echo '</div></a>';        
                echo '<a class=" item">';
                  echo'<i class="shop icon"></i> Cart';
                echo '</a>';                                     
            echo '</nav>';            
        echo '</div>';     
    echo '</div>';
	
	echo '<div class="ui attached stackable borderless huge menu">';
        echo '<div class="ui container">';
            echo '<h2 class="header item">';
              echo '<img src="images/logo5.png" class="ui small image" >';
            echo '</h2>';  
            echo '<a class="item">';
              echo '<i class="home icon"></i> Home';
            echo '</a>';       
            echo '<a class="item">';
              echo '<i class="mail icon"></i> About Us';
            echo '</a>';      
            echo '<a class="item">';
              echo '<i class="home icon"></i> Blog';
            echo '</a>';      
            echo '<div class="ui simple dropdown item">';
              echo '<i class="grid layout icon"></i>';
              echo 'Browse';
                echo '<i class="dropdown icon"></i>';
              echo '<div class="menu">';
                echo '<a class="item"><i class="users icon"></i> Artists</a>';
                echo '<a class="item"><i class="theme icon"></i> Genres</a>';
                

?>