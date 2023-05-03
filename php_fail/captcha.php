<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Recaptcha Demo</title>
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body> 

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
    <form action="recaptcha-v2.php" method="post">
        <label for="fname">First Name*</label><br>
        <input type="text" name="fname" id="fname" required autofocus><br><br>

        <label for="lname">Last Name*</label><br>
        <input type="text" name="lname" id="lname" required><br><br>

        <label for="email">Email Address*</label><br>
        <input type="email" name="email" id="email" required><br><br>

        <div class="g-recaptcha" data-sitekey="_______________PUBLIC_KEY_______________"></div>
        <br>
        <input type="submit" id="submit" value="Submit">
    </form>

<?php } ?>

</body>
</html>