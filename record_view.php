<?php
//record_view.php - shows details of a single album cover
?>
<?php include_once 'includes/config.php';?>
<?php

//process querystring here
if(isset($_GET['id']))
{//process data
    //cast the data to an integer, for security purposes
    $id = (int)$_GET['id'];
}else{//redirect to safe page
    header('Location:record_list.php');
}


$sql = "select * from BR_Albums where AlbumID = $id";
//we connect to the db here
$iConn = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

//we extract the data here
$result = mysqli_query($iConn,$sql);

if(mysqli_num_rows($result) > 0)
{//show records

    while($row = mysqli_fetch_assoc($result))
    {
        $AlbumName = stripslashes($row['AlbumName']);
        $MusicianName = stripslashes($row['MusicianFirst'] . ' ' . $row['MusicianLast']);
        $Year = stripslashes($row['Year']);
        
        $Label = stripslashes($row['Label']);
        $title = $AlbumName;
        $pageID = $MusicianName . " - " . $AlbumName;
        $Feedback = '';//no feedback necessary
    }    

}else{//inform there are no records
    $Feedback = '<p>This album does not exist</p>';
}

?>
<?php include_once 'includes/header.php';?>
<h1><?=$pageID?></h1>
<?php
    
    
if($Feedback == '')
{//data exists, show it

    echo '<p id="record-view-details">';
    echo '<img id="record-cover" src="assets/uploads/' . $id . '_album.jpg" /> <br />';
    echo 'Album: <b>' . $AlbumName . '</b> <br />';
    echo 'Musician: <b>' . $MusicianName . '</b> <br />';
    echo 'Label: <b>' . $Label . '</b> <br />';
    echo 'Year Released: <b>' . $Year . '</b> <br />';
    
    
    
    echo '</p>'; 
}else{//warn user no data
    echo $Feedback;
}    

echo '<p><a href="record_list-view-pager.php">Go Back</a></p>';

//release web server resources
@mysqli_free_result($result);

//close connection to mysql
@mysqli_close($iConn);

?>
<?php include_once 'includes/footer.php';?>