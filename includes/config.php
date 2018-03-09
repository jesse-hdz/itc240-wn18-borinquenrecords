<?php
/**
 * config.php provides a place to store configuration info, 
 * such as your reCAPTCHA site keys
 *
 * @package nmCAPTCHA2
 * @author Bill & Sara Newman <williamnewman@gmail.com>
 * @version 1.01 2015/11/17
 * @link http://www.newmanix.com/
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @see contact_include.php 
 * @see recaptchalib.php
 * @see util.js 
 * @todo none
 */

//Here are the keys for the server: seattlecentral.edu
//CAN USE FOR EDISON!
$siteKey = "6LcYiEEUAAAAAD1wrQodfmWYtRqnh-wIbNyjUnY1";
$secretKey = "6LcYiEEUAAAAAMYc27aLZEK3Mpll9SfH-tYnnViS";

//this helps eliminate PHP date errors
date_default_timezone_set('America/Los Angeles');

//name of the file of the current url
//echo basename($_SERVER['PHP_SELF']); 
//die;

define('DEBUG',TRUE); #we want to see all errors
define('THIS_PAGE', basename($_SERVER['PHP_SELF'])); 
//define(words that define it, content);

//echo "constant: " . THIS_PAGE;
//die;

$curYear = date('Y');

$siteID = 'Borinquen Records';
// $logo = 'image()';

$nav1['index.php'] = "HOME";
$nav1['record_list-view-pager.php'] = "RECORDS";
$nav1['daily.php'] = "DAILY";
$nav1['contact.php'] = "CONTACT";

switch(THIS_PAGE)
{
    case 'index.php':
        $title = 'Welcome';
        // $logoID = 'fa-home';
        $PageID = 'HOME';
    break;
    
    case 'record_list-view-pager.php':
        $title = 'Our Collection';
        // $logo = 'fa-home';
        $PageID = 'RECORDS';
    break;     
        
    case 'contact.php':
        $title = 'Contact Us';
//        $logo = '';
        $PageID = 'CONTACT';
    break;    
        
    case 'daily.php':
        $title = 'Daily';
        $logo = '';
        $PageID = 'DAILY';
    break;
        
   /* case 'fp/index.php':
        $title = 'Final Project: Flowchart and Layout';
        $logo = 'fa-file-text-o';
        $PageID = 'Final Project: Flowchart and Layout';
    break;

    case 'contactme.php':
        $title = 'Contact Jesse';
        $logo = 'fa-pencil-square-o';
        $PageID = 'Contact Jesse';
    break;        */
        
    default:
        $title = THIS_PAGE;
        $logo = '';
        $PageID = '';
}

//database credentials file
include_once 'credentials.php';


//safe error messages
function myerror($myFile, $myLine, $errorMsg)
{
    if(defined('DEBUG') && DEBUG)
    {
       echo "Error in file: <b>" . $myFile . "</b> on line: <b>" . $myLine . "</b><br />";
       echo "Error Message: <b>" . $errorMsg . "</b><br />";
       die();
    }else{
        echo "I'm sorry, we have encountered an error.";
        die();
    }
}

function br_links($nav1) 
{
    foreach($nav1 as $url => $text) {
//        echo '<li><a href="' . $url . '">' . $text . '</a></li>';
        
        if(THIS_PAGE == $url) {
            echo '
            <li class="nav-item active px-lg-4">
                <a class="nav-link text-uppercase text-expanded" href="' . $url . '">' . $text . '</a>
            </li>
        ';   
        } else {
            echo '
            <li class="nav-item px-lg-4">
                <a class="nav-link text-uppercase text-expanded" href="' . $url . '">' . $text . '</a>
            </li>
        ';   
        } 
    }
    
} //end br_links

?>