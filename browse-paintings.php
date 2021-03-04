<?php
require_once("common.php");

echo '<a class="item"><i class="paint brush icon"></i> Paintings</a>';
                echo '<a class="item"><i class="cube icon"></i> Subjects</a>';
              echo '</div>';
            echo '</div>';        
            echo '<div class="right item">';
                echo '<div class="ui mini icon input">';
                  echo '<input type="text" placeholder="Search ...">';
                  echo '<i class="search icon"></i>';
                echo '</div>';
            echo '</div>';      

        echo '</div>';
    echo '</div>';       
echo '</header>';

require_once("databasescalls.php");

//$pdo = setConnectionInfo(array(DBCONNECTION, DBUSER, DBPASS));

// if we have a non-empty search string, search for employee matches
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['filter1']) && !empty($_GET['filter1']) ) {
   $paintings = readSelectPaintingsByArtistID($_GET['filter1']);
}
else if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['filter2']) && !empty($_GET['filter2']) ){
	//$paintings = readAllPaintings();
	$paintings = readSelectPaintingsByMuseumID($_GET['filter2']);    
}
else if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['filter3']) && !empty($_GET['filter3']) ){
	//$paintings = readAllPaintings();
	$paintings = readSelectPaintingsByShapeID($_GET['filter3']);    
}
else {
   $paintings = readAllPaintings();    
} 

$filterartist = readAllArtistFilter();
$filtermuseum = readAllMuseumFilter();
$filtershapes = readAllShapeFilter();

function outputPostRow($paintings)  {
	echo '<li class="item">';
            echo '<a class="ui small image" href="single-painting.php?id=' . $paintings['PaintingID'].'"><img src="images/art/works/square-medium/' . $paintings['ImageFileName'].'.jpg"></a>';
            echo '<div class="content">';
            echo '  <a class="header" href="single-painting.php?id=' . $paintings['PaintingID'].'">'.$paintings['Title'].'</a>';
			echo '  <div class="meta"><span class="cinema">'.$paintings['LastName'].'</span></div>';     
            echo '  <div class="description">';
            echo '    <p>'.$paintings['Excerpt'].'</p>';
            echo '  </div>';
            echo '  <div class="meta">';     
            echo '      <strong>$'.$paintings['MSRP'].'</strong>';        
            echo '  </div>';        
            echo '  <div class="extra">';
            echo '    <a class="ui icon orange button" href="cart.php?id='.$paintings['PaintingID'].'"><i class="add to cart icon"></i></a>';
            //Link to add to favorites 
			echo '    <a class="ui icon button" href="addToFavorites.php?id=' . $paintings['PaintingID'].'&name='. $paintings['ImageFileName'].'&title='.$paintings['Title'].'"><i class="heart icon"></i></a>';          
            echo '  </div>';        
            echo '</div>';      
          echo '</li>';
    
}

function outputartistRow($filterartist)  {
	//echo '<li class="item">';
    echo '<option value='. $filterartist["ArtistID"].'>'.$filterartist['LastName'].'</option>';        
}

function outputmuseumRow($filtermuseum)  {
	//echo '<li class="item">';
    echo '<option value='.$filtermuseum["GalleryID"].'>'.$filtermuseum['GalleryName'].'</option>';        
}

function outputshapesRow($filtershapes)  {
	//echo '<li class="item">';
    echo '<option value='.$filtershapes["ShapeID"].'>'.$filtershapes['ShapeName'].'</option>';        
}

echo '<main class="ui segment doubling stackable grid container">';

    echo '<section class="five wide column">';
        echo '<form class="ui form" action="browse-paintings.php" method="get">';
          echo '<h4 class="ui dividing header">Filters</h4>';

          echo '<div class="field">';
            echo '<label>Artist</label>';
            echo '<select class="ui fluid dropdown" name="filter1">';
                echo '<option value>Select Artist</option> '; 
                foreach ($filterartist as $filt) {
				outputartistRow($filt);	
				}
            echo '</select>';
          echo '</div>';
          echo '<div class="field">';
            echo '<label>Museum</label>';
            echo '<select class="ui fluid dropdown" name="filter2">';
                echo '<option value>Select Museum</option> '; 
                foreach ($filtermuseum as $filt) {
				outputmuseumRow($filt);	
				}
            echo '</select>';
          echo '</div> ';  
          echo '<div class="field">';
            echo '<label>Shape</label>';
            echo '<select class="ui fluid dropdown" name="filter3">';
                echo '<option value>Select Shape</option>';  
                foreach ($filtershapes as $filt) {
				outputshapesRow($filt);	
				}
            echo '</select>';
          echo '</div>';   

            echo '<button class="small ui orange button" type="submit" value="result">';
              echo '<i class="filter icon"></i> Filter'; 
            echo '</button>';    

        echo '</form>';
    echo '</section>'; 
	
	echo '<section class="eleven wide column">';
        echo '<h1 class="ui header">Paintings</h1>';
		echo '<p>ALL PAINTINGS[TOP 20]</p>';
	echo '<ul class="ui divided items" id="paintingsList">';

	foreach ($paintings as $pain) {
        outputPostRow($pain);	
        }

	echo '</ul>';        
    echo '</section>'; 
	
	echo '</main>  ';  
    
  echo '<footer class="ui black inverted segment">';
      echo '<div class="ui container">footer for later</div>';
  echo '</footer>';
echo '</body>';
echo '</html>';

?>