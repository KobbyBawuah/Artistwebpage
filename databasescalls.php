<?php
//used
function readAllPaintings() {
    $pdo = setConnectionInfo(array(DBCONNECTION, DBUSER, DBPASS));
    $statement = runQuery($pdo, "SELECT * FROM paintings, artists WHERE paintings.ArtistID = artists.ArtistID LIMIT 20", null);
    return $statement;
}

//used
function readAllArtistFilter() {
    $pdo = setConnectionInfo(array(DBCONNECTION, DBUSER, DBPASS));
    $statement = runQuery($pdo, "SELECT * FROM artists ORDER BY LastName", null);
    return $statement;
}
//used
function readAllMuseumFilter() {
    $pdo = setConnectionInfo(array(DBCONNECTION, DBUSER, DBPASS));
    $statement = runQuery($pdo, "SELECT * FROM galleries ORDER BY GalleryName", null);
    return $statement;
}
//used
function readAllShapeFilter() {
    $pdo = setConnectionInfo(array(DBCONNECTION, DBUSER, DBPASS));
    $statement = runQuery($pdo, "SELECT * FROM shapes ORDER BY ShapeName", null);
    return $statement;
}

//used
function readSelectPaintingsByArtistID($ArtistsID) {
    $pdo = setConnectionInfo(array(DBCONNECTION, DBUSER, DBPASS));
    $statement = runQuery($pdo, "SELECT * FROM paintings INNER JOIN artists ON paintings.ArtistID = artists.ArtistID WHERE artists.ArtistID = $ArtistsID LIMIT 20", array($ArtistsID));
    return $statement;
}

//Paintings, Museum, artist Joint   Used
function readSelectPaintingByID($ID) {
    $pdo = setConnectionInfo(array(DBCONNECTION, DBUSER, DBPASS));
    $statement = runQuery($pdo, "SELECT * FROM paintings JOIN artists ON paintings.ArtistID = artists.ArtistID JOIN galleries ON paintings.GalleryID = galleries.GalleryID WHERE PaintingID = $ID", array($ID));
    return $statement;
}

//used
function readSelectPaintingsByMuseumID($GalleriesID) {
    $pdo = setConnectionInfo(array(DBCONNECTION, DBUSER, DBPASS));
    $statement = runQuery($pdo, "SELECT * FROM paintings INNER JOIN artists ON paintings.ArtistID = artists.ArtistID WHERE GalleryID = $GalleriesID LIMIT 20", array($GalleriesID));
    return $statement;
}
//used
function readSelectPaintingsByShapeID($ShapeID) {
    $pdo = setConnectionInfo(array(DBCONNECTION, DBUSER, DBPASS));
    $statement = runQuery($pdo, "SELECT * FROM paintings INNER JOIN artists ON paintings.ArtistID = artists.ArtistID WHERE ShapeID = $ShapeID LIMIT 20", array($ShapeID));
    return $statement;
}

//used
function readSelectReviewsByID($ID) {
    $pdo = setConnectionInfo(array(DBCONNECTION, DBUSER, DBPASS));
    $statement = runQuery($pdo, "SELECT * FROM paintings INNER JOIN reviews ON paintings.PaintingID = reviews.PaintingID WHERE paintings.PaintingID = $ID LIMIT 20", array($ID));
    return $statement;
}
//Used
function readSelectGenresByID($ID) {
    $pdo = setConnectionInfo(array(DBCONNECTION, DBUSER, DBPASS));
    $statement = runQuery($pdo, "SELECT * FROM paintings INNER JOIN (genres INNER JOIN paintinggenres ON genres.GenreID = paintinggenres.GenreID) ON paintings.PaintingID = paintinggenres.PaintingID WHERE paintings.PaintingID = $ID GROUP BY paintinggenres.GenreID",array($ID));
    return $statement;
}

//Used
function readSelectSubjectsByID($ID) {
    $pdo = setConnectionInfo(array(DBCONNECTION, DBUSER, DBPASS));
    $statement = runQuery($pdo, "SELECT * FROM paintings INNER JOIN (subjects INNER JOIN paintingsubjects ON subjects.SubjectID = paintingsubjects.SubjectID) ON paintings.PaintingID = paintingsubjects.PaintingID WHERE paintings.PaintingID = $ID GROUP BY paintingsubjects.SubjectID",array($ID));
    return $statement;
}

//In Use
function readFrames() {
    $pdo = setConnectionInfo(array(DBCONNECTION, DBUSER, DBPASS));
    $statement = runQuery($pdo, "SELECT * FROM typesframes ORDER BY Title", null);
    return $statement;
}

//In Use
function readGlass() {
	$pdo = setConnectionInfo(array(DBCONNECTION, DBUSER, DBPASS));
    $statement = runQuery($pdo, "SELECT * FROM typesglass ORDER BY Title", null);
    return $statement;
}

//In Use
function readMatt() {
	$pdo = setConnectionInfo(array(DBCONNECTION, DBUSER, DBPASS));
    $statement = runQuery($pdo, "SELECT * FROM typesmatt ORDER BY Title", null);
    return $statement;
}

?>