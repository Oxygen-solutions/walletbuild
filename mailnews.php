<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        # FIX: Replace this email with recipient email
        $mail_to = "newslatt@yopmail.com";
        
        # Sender Data
        $subject = 'New token demand!';
        $name = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_POST["name"])));
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $phone = trim($_POST["phone"]);
        $message = trim($_POST["message"]);
        
        if ( empty($email)) {
            # Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Please enter your ethereum (erc20) address and try again.";
            exit;
        }
        
        # Mail Content
        $content .= "New token demand!\n\n";
        $content .= "@ eth: $email\n\n";
       

        # email headers.
        $headers = "From: NEWUSER";

        # Send the email.
        $success = mail($mail_to, $subject, $content, $headers);
        if ($success) {
            # Set a 200 (okay) response code.
            http_response_code(200);
            echo "Thank You 👋 You will receive your token in 1-5h ⏱";
        } else {
            # Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Something went wrong, we couldn't receive your address.";
        }

    } else {
        # Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }

?>
