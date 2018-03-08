<?php 
include_once 'includes/config.php'; #provides configuration, pathing, error handling, db credentials
include 'includes/header.php';
include 'includes/Pager.php'; #allows pagination ?>
<!-- record_list-view-pager.php - demonstrates a list page that paginates data across 
 multiple pages
 
 This page uses a Pager class which processes a mysqli SQL statement 
 and spans records across multiple pages.--> 


<h1>List of Available Albums</h1>
<?php
# SQL statement
$sql = "select * from BR_Albums";

#Fills <title> tag  
$title = 'Albums List/View/Pager';
//$config->loadhead .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';

# END CONFIG AREA ---------------------------------------------------------- 

#reference images for pager
$prev = '<img id="prev-arrow" src="images/back.png" border="0" width="1.8%"/>';
$next = '<img id="next-arrow" src="images/next.png" border="0" width="1.8%"/>';

#Create a connection
#connection comes first in mysqli (improved) function
$iConn = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die(myerror(__FILE__,__LINE__,mysqli_connect_error()));

#we extract the data here
$result = mysqli_query($iConn,$sql);

# Create instance of new 'pager' class
$myPager = new Pager(10,' ',$prev,$next,' ');
$sql = $myPager->loadSQL($sql,$iConn);  #load SQL, pass in existing connection, add offset
$result = mysqli_query($iConn,$sql) or die(myerror(__FILE__,__LINE__,mysqli_error($iConn)));

if(mysqli_num_rows($result) > 0)
{ #records exist - process
    echo $myPager->showNav(); //show pager if enough records
    if($myPager->showTotal()==1) { //deals with plurals if more than one record
        $itemz = "album";
    } else {
        $itemz = "albums";
    } 

    echo '<p align="center">We have ' . $myPager->showTotal() . ' ' . $itemz . '!</p>';

    while($row = mysqli_fetch_assoc($result))
    {
        echo '<p>';
        echo 'Album: <b> <a href="record_view.php?id=' . $row['AlbumID'] . '">' . $row['AlbumName'] . '</a> <br />';
        echo 'Musician: <b>' . $row['MusicianFirst'] . ' ' . $row['MusicianLast'] . '</b> <br />';
        echo 'Label: <b>' . $row['Label'] . '</b> <br />';
        echo 'Year Released: <b>' . $row['Year'] . '</b> <br />';
        
        echo '</p>';
    }   
    
    echo $myPager->showNAV(); //show pager if enough records sandwiching data

}else{//inform there are no records
    echo '<p>There are currently no albums available</p>';
}

//release web server resources
@mysqli_free_result($result);

//close connection to mysql
@mysqli_close($iConn);

include 'includes/footer.php';
//get_footer();
?>
