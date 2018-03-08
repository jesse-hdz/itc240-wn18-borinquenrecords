<?php include 'includes/header.php'?>
<?php
//contact template

if(isset($_POST['Submit']))
{//send email?
    
    /*echo '<pre>';
    var_dump($_POST);
    echo '</pre>';*/
    
    
    $to = "jessi.hernandez@seattlecentral.edu";
    
    $subject = "My WebSite Feedback " . date("m/d/y, G:i:s");
    
    //collect and clean $POST data
    $FirstName = br_clean_post('FirstName');
    $LastName = br_clean_post('LastName');
    $Email = br_clean_post('Email');
    $Comments = br_clean_post('Comments');
    
    
    
    //build body of email
    $text = '';//initialize variable
    $text .= 'First Name: ' . $FirstName . PHP_EOL . PHP_EOL; 
    $text .= 'Last Name: ' . $LastName . PHP_EOL . PHP_EOL; 
    //PHP_EOL = white space / margin / padding
    $text .= 'Email: ' . $Email . PHP_EOL . PHP_EOL;
    $text .= 'Comments: ' . $Comments . PHP_EOL . PHP_EOL;
    
    $headers = 'From: noreply@jesseh-codes.com' . PHP_EOL .
                'Reply-To: ' .$Email . PHP_EOL .
                'X-Mailer: PHP/' . phpversion();
    
    mail($to,$subject,$text,$headers);
    
    echo '
    <div class="row">
        <div class="col-lg-12">
            <h3>Message Sent</h3>
            <p>Thank you for your interest in our records!</p>
            <p>We will contact you within 24 hours!</p>
        </div>
    </div>
    ';

}else{//show form!
    echo '
        <form class="contact-form" action="" method="post">
			<div class="row">
				<h2>Contact Us</h2>
                
                <div class="form-group three-col">
                    <input class="form-control" type="text" name="FirstName" id="FirstName" placeholder="First Name" autofocus required/>
                </div>
                
                <div class="form-group three-col">
                    <input class="form-control" type="text" name="LastName" id="LastName" placeholder="Last Name" autofocus required/>
                </div>
                
                <div class="form-group three-col">
                    <input class="form-control" type="email" name="Email" id="Email" placeholder="Email" autofocus required/>
                </div>
                
                <label class="form-group three-col">
                    How Did You Hear About Us?:
                    <br />
                    <select name="How_Did_You_Hear_About_Us?" required="required" title="How You Heard is required" tabindex="30"><br />
                        <option value="">Choose How You Heard</option>
                        <option value="Phone">Phone</option>
                        <option value="Web">Web</option>
                        <option value="Magazine">Magazine</option>
                        <option value="A Friend">A Friend</option>
                        <option value="Other">Other</option>
                    </select>
                </label>
                
                <label class="form-group three-col">
                    What Can We Help You With Today?
                    <br />
                    <label for="help_checkbox">
                    <input type="checkbox" id="help_checkbox" value="Purchase Inquiry" />Purchase Inquiry 
                    </label>
                    
                    <input type="checkbox" value="Sell Us Your Collection" />Sell Us Your Collection <br />
                    <input type="checkbox" name="Interested_In[]" value="Sell Us An Album" /> Sell Us An Album <br />
                    <input type="checkbox" name="Interested_In[]" value="Album Inquiry" /> Album Inquiry <br />
                    <input type="checkbox" name="Interested_In[]" value="Other" /> Other <br />
                </label>    
                
                <label class="form-group three-col">
                    Want to know when we get a new collection in?
                    <br />
                    <input type="radio" name="New collection?" value="Yes" 
                    required="required" title="New collection mailing list." tabindex="50" checked="checked"
                    /> Yes! <br /> 
                    <input type="radio" name="New collection?" value="No" />No, thank you!<br />
                    
                </label>
                
                    <textarea class="form-control" name="Comments" id="Comments" placeholder="Comments"></textarea>
                </section>    
                    
               <section class="form-submit">
                    <button type="submit" class="btn btn-secondary" name="Submit">Submit</button>
                </section>
            </div>
        </form>
    ';
}

?>




<?php include 'includes/footer.php';

function br_clean_post($key){
    if(isset($_POST[$key])){
        return strip_tags(trim($_POST[$key]));
    } else {
        return '';
    }
}
?>
