#vinylAlbums-02142018.sql

drop table if exists BR_Albums;
CREATE TABLE `BR_Albums` ( 
    `AlbumID` int(10) unsigned NOT NULL AUTO_INCREMENT, 
    `AlbumName` varchar(50) DEFAULT NULL, 
    `Musician` varchar(50) DEFAULT NULL, 
    `Year` datetime,  
    `Price` int(10), 
    PRIMARY KEY (`AlbumID`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
