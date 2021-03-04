<?php

require_once("common.php");

echo '<a class="item" href="browse-paintings.php"><i class="paint brush icon"></i> Paintings</a>';
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


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if ( isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {  
        $results = readSelectPaintingByID($_GET['id']);
		$requestedPainting = $results->fetch();
		$reviewresult = readSelectReviewsByID($_GET['id']);
		$joint = readSelectGenresByID($_GET['id']);
		$joint2 = readSelectSubjectsByID($_GET['id']);		
		} else {
			//default painting
		$results = readSelectPaintingByID(5);
		$requestedPainting = $results->fetch();
		$reviewresult = readSelectReviewsByID($_GET['id']);
		$joint = readSelectGenresByID($_GET['id']);
		$joint2 = readSelectSubjectsByID($_GET['id']);
		}
		
$filterframe = readFrames();
$filterglass= readGlass();
$filtermatt = readMatt();

function outputframeRow($filterframe)  {
	echo '<option>'.$filterframe['Title'].'[$'.$filterframe['Price'].']</option>';	
}
function outputglassRow($filterglass)  {
	echo '<option>'.$filterglass['Title'].'[$'.$filterglass['Price'].']</option>';	
}
function outputmattRow($filtermatt)  {
	echo '<option>'.$filtermatt['Title'].'[$'.$filtermatt['ColorCode'].']</option>';	
}
?>
<main >
    <!-- Main section about painting -->
    <section class="ui segment grey100">
        <div class="ui doubling stackable grid container">
		
            <div class="nine wide column">
              <img src="images/art/works/medium/<?php echo $requestedPainting['ImageFileName']; ?>.jpg" alt="..." class="ui big image" id="artwork">
                
                <div class="ui fullscreen modal">
                  <div class="image content">
                      <img src="images/art/works/large/<?php echo $requestedPainting['ImageFileName'];?>.jpg" alt="Large file was not provided so Image was not found" class="image" >
                      <div class="description">
                      <p></p>
                    </div>
                  </div>
                </div>                
                
            </div>	<!-- END LEFT Picture Column --> 
            <div class="seven wide column">
                
                <!-- Main Info -->
                <div class="item">
					<h2 class="header"><?php echo $requestedPainting['Title'];?></h2>
					<h3 ><?php echo $requestedPainting['LastName'];?></h3>
					<div class="meta">
						<p>
						<i class="orange star icon"></i>
						<i class="orange star icon"></i>
						<i class="orange star icon"></i>
						<i class="orange star icon"></i>
						<i class="empty star icon"></i>
						</p>
						<p><?php echo $requestedPainting['Excerpt'];?></p>
					</div>  
                </div>                          
                  
                <!-- Tabs For Details, Museum, Genre, Subjects -->
                <div class="ui top attached tabular menu ">
                    <a class="active item" data-tab="details"><i class="image icon"></i>Details</a>
                    <a class="item" data-tab="museum"><i class="university icon"></i>Museum</a>
                    <a class="item" data-tab="genres"><i class="theme icon"></i>Genres</a>
                    <a class="item" data-tab="subjects"><i class="cube icon"></i>Subjects</a>    
                </div>
                
                <div class="ui bottom attached active tab segment" data-tab="details">
                    <table class="ui definition very basic collapsing celled table">
					  <tbody>
						  <tr>
						 <td>
							  Artist
						  </td>
						  <td>
							<a href="#"><?php echo $requestedPainting['LastName'];?></a>
						  </td>                       
						  </tr>
						<tr>                       
						  <td>
							  Year
						  </td>
						  <td>
							<?php echo $requestedPainting['YearOfWork'];?>
						  </td>
						</tr>       
						<tr>
						  <td>
							  Medium
						  </td>
						  <td>
							<?php echo $requestedPainting['Medium'];?>
						  </td>
						</tr>  
						<tr>
						  <td>
							  Dimensions
						  </td>
						  <td>
							<?php echo $requestedPainting['Width'];?> x <?php echo $requestedPainting['Height'];?>
						  </td>
						</tr>        
					  </tbody>
					</table>
                </div>
				
                <div class="ui bottom attached tab segment" data-tab="museum">
                    <table class="ui definition very basic collapsing celled table">
                      <tbody>
                        <tr>
                          <td>
                              Museum
                          </td>
                          <td>
							<?php echo $requestedPainting['GalleryName'];?>
                          </td>
                        </tr>       
                        <tr>
                          <td>
                              Assession #
                          </td>
                          <td>
                            <?php echo $requestedPainting['AccessionNumber'];?>
                          </td>
                        </tr>  
                        <tr>
                          <td>
                              Copyright
                          </td>
                          <td>
                            <?php echo $requestedPainting['CopyrightText'];?>
                          </td>
                        </tr>       
                        <tr>
                          <td>
                              URL
                          </td>
                          <td>
                            <a href="<?php echo $requestedPainting['MuseumLink'];?>">View painting at museum site</a>
                          </td>
                        </tr>        
                      </tbody>
                    </table>    
                </div>     
                <div class="ui bottom attached tab segment" data-tab="genres">
 
                        <ul class="ui list">
						<?php
						foreach ($joint as $join) {
							echo '<li class="item"><a href="#">'.$join['GenreName'].'</a></li>';
							}
						?>	
                        </ul>

                </div>  
                <div class="ui bottom attached tab segment" data-tab="subjects">
                    <ul class="ui list">
                        <?php 
						  foreach ($joint2 as $joi) {
							echo '<li class="item"><a href="#">'.$joi['SubjectName'].'</a></li>';
							}
						?>
                        </ul>
                </div>  
                
                <!-- Cart and Price -->
                <div class="ui segment">
                    <div class="ui form">
                        <div class="ui tiny statistic">
                          <div class="value">
                            $<?php echo $requestedPainting['Cost'];?>
                          </div>
                        </div>
                        <div class="four fields">
                            <div class="three wide field">
                                <label>Quantity</label>
                                <input type="number">
                            </div>                               
                            <div class="four wide field">
                                <label>Frame</label>
                                <select id="frame" class="ui search dropdown">
                                    <option>None</option>
                                    <?php
									foreach ($filterframe as $filt) {
									outputframeRow($filt);	
										}	
									?>
									

                                </select>
                            </div>  
                            <div class="four wide field">
                                <label>Glass</label>
                                <select id="glass" class="ui search dropdown">
                                    <option>None</option>
                                    <?php
									foreach ($filterglass as $filt) {
									outputglassRow($filt);	
										}
									?>	
                                </select>
                            </div>  
                            <div class="four wide field">
                                <label>Matt</label>
                                <select id="matt" class="ui search dropdown">
                                    <option>None</option>
                                     <?php
									foreach ($filtermatt as $filt) {
									outputmattRow($filt);	
										}
									?>
                                </select>
                            </div>           
                        </div>                     
                    </div>

                    <div class="ui divider"></div>
                    <button class="ui labeled icon orange button">
                      <i class="add to cart icon"></i>
                      Add to Cart
                    </button>
					<a href="addToFavorites.php?id=<?php echo $requestedPainting['PaintingID'];?>&name=<?php echo $requestedPainting['ImageFileName'];?>&title=<?php echo $requestedPainting['Title'];?>">
                    <button class="ui right labeled icon button">
                      <i class="heart icon"></i>
                      Add to Favorites
                    </button>
					</a>
                </div>     <!-- END Cart -->                      
                          
            </div>	<!-- END RIGHT data Column --> 
        </div>		<!-- END Grid --> 
    </section>		<!-- END Main Section --> 
    
    <!-- Tabs for Description, On the Web, Reviews -->
    <section class="ui doubling stackable grid container">
        <div class="sixteen wide column">
        
            <div class="ui top attached tabular menu ">
              <a class="active item" data-tab="first">Description</a>
              <a class="item" data-tab="second">On the Web</a>
              <a class="item" data-tab="third">Reviews</a>
            </div>
			
            <div class="ui bottom attached active tab segment" data-tab="first">
               <?php echo $requestedPainting['Description'];?>
            </div>	<!-- END DescriptionTab --> 
			
            <div class="ui bottom attached tab segment" data-tab="second">
				<table class="ui definition very basic collapsing celled table">
                  <tbody>
                      <tr>
                     <td>
                          Wikipedia Link
                      </td>
                      <td>
                        <a href="<?php echo $requestedPainting['WikiLink'];?>">View painting on Wikipedia</a>
                      </td>                       
                      </tr>                       
                      
                      <tr>
                     <td>
                          Google Link
                      </td>
                      <td>
                        <a href="<?php echo $requestedPainting['GoogleLink'];?>">View painting on Google Art Project</a>
                      </td>                       
                      </tr>
                      
                      <tr>
                     <td>
                          Google Text
                      </td>
                      <td>
							<?php echo $requestedPainting['GoogleDescription'];?>
                      </td>                       
                      </tr>                      
                      
   
       
                  </tbody>
                </table>
            </div>   <!-- END On the Web Tab --> 
			
            <div class="ui bottom attached tab segment" data-tab="third">                
				<div class="ui feed">    
				
				<?php
				function outputreviewRow($reviewresult)  {
				echo '<div class="event">';
					echo '<div class="content">';
						echo '<div class="date">'.$reviewresult['ReviewDate'].'</div>';
						echo '<div class="meta">';
							echo '<a class="like">';
							
							  echo '<i class="star icon"></i><i class="star icon"></i><i class="star icon"></i><i class="star icon"></i><i class="star icon"></i>';
							  
							echo '</a>';
						echo '</div>';                    
						echo '<div class="summary">';
							echo $reviewresult['Comment'];        
						echo '</div>';       
					echo '</div>';
				  echo '</div>';
				
				echo '<div class="ui divider"></div>';
				}
				
				foreach ($reviewresult as $rev) {
					outputreviewRow($rev);	
					}
				?>    
								
				</div>                                
            </div>   <!-- END Reviews Tab -->          
        
        </div>        
    </section> <!-- END Description, On the Web, Reviews Tabs --> 
    
    <!-- Related Images ... will implement this in assignment 2 -->    
    <section class="ui container">
    <h3 class="ui dividing header">Related Works</h3>
	<div class="row">
	  <div class="column">
		<a class="ui small image" href="single-painting.php?id=565" alt="First Image"><img src="images/art/works/square-medium/131040.jpg"></a>
		<div class="meta"><span class="cinema">View of St. Markís from the Punta della Dogana</span></div>
		<div class="meta"><span class="cinema">Canaleto</span></div>
	  </div>
	  <div class="column">
	  <a class="ui small image" href="single-painting.php?id=568" alt="Second Image"><img src="images/art/works/square-medium/137010.jpg"></a>
	  <div class="meta"><span class="cinema">Abbey among Oak Trees</a></span></div>
	  <div class="meta"><span class="cinema">Casper David Friedrich</span></div> 
	  </div>
	  <div class="column">
		<a class="ui small image" href="single-painting.php?id=420"><img src="images/art/works/square-medium/105010.jpg"></a>
		<div class="meta"><span class="cinema">The Anatomy Lesson of Dr. Nicolaes Tulp</a></span></div>
	  <div class="meta"><span class="cinema">Rembrandt Netherlands</span></div> 
	  </div>
	</div>
	</section>  
	
</main>    
    <?php 
                    
                 }  // // end if ( $_SERVER ... ?>

    
  <footer class="ui black inverted segment">
      <div class="ui container">footer</div>
  </footer>
</body>
</html>