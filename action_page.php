<?php
if($_POST) {
    $fname = "";
    $lname = "";
    $email = "";
    $Field = "";
    $subject = "";
    $email_body = "<div>";

    if(isset($_POST['fname'])) {
        $fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Visitor First Name:</b></label>&nbsp;<span>".$fname."</span>
                        </div>";
    }

    if(isset($_POST['email'])) {
        $email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $email_body .= "<div>
                           <label><b>Visitor Email:</b></label>&nbsp;<span>".$email."</span>
                        </div>";
    }

    if(isset($_POST['Field'])) {
        $Field = filter_var($_POST['Field'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Reason For Contacting Us:</b></label>&nbsp;<span>".$Field."</span>
                        </div>";
    }

    if(isset($_POST['subject'])) {
        $subject = htmlspecialchars($_POST['subject']);
        $email_body .= "<div>
                           <label><b>Visitor Message:</b></label>
                           <div>".$subject."</div>
                        </div>";
    }

    $recipient = "tyler.mccue@icloud.com";

    $email_body .= "</div>";

    $headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $visitor_email . "\r\n";

    if(mail($recipient, $email_title, $email_body, $headers)) {
        echo "<p>Thank you for contacting us, $visitor_name. You will get a reply within 24 hours.</p>";
    } else {
        echo '<p>We are sorry but the email did not go through.</p>';
    }

} else {
    echo '<p>Something went wrong</p>';
}
?>
