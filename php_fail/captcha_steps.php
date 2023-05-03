----------------------------------
How to add reCAPTCHA to your forms
----------------------------------

UPDATED: 5/12/2018

STEP 1:
Paste this in header,

<script src='https://www.google.com/recaptcha/api.js'></script>


STEP 2:
Paste this in the form where you want the widget to appear,

<div class="g-recaptcha" data-sitekey="_______________PUBLIC_KEY_______________"></div>


STEP 3:

EDIT: The code below is updated from the video so that you only need one page. With an if/else statement, you can check if the form has been submitted. If it has, the reCAPTCHA success or error message will appear. If not, the form will appear. 

<?php
// Checks if form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    function post_captcha($user_response) {
        $fields_string = '';
        $fields = array(
            'secret' => '_______________PRIVATE_KEY_______________',
            'response' => $user_response
        );
        foreach($fields as $key=>$value)
        $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    // Call the function post_captcha
    $res = post_captcha($_POST['g-recaptcha-response']);

    if (!$res['success']) {
        // What happens when the CAPTCHA wasn't checked
        echo '<p>Please go back and make sure you check the security CAPTCHA box.</p><br>';
    } else {
        // If CAPTCHA is successfully completed...

        // Paste mail function or whatever else you want to happen here!
        echo '<br><p>CAPTCHA was completed successfully!</p><br>';
    }
} else { ?>
    
<!-- FORM GOES HERE -->
<form></form>

<?php } ?>