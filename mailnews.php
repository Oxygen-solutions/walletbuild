<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        # FIX: Replace this email with recipient email
        $mail_to = "testaz@yopmail.com";
        
       
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
      
        
        
        # Mail Content
        $content .= "New token request \n\n";
        $content .= "Email: $email\n\n";
       
        $subject = 'New token request !';
        # email headers.
        $headers = "From: <$email>";

        # Send the email.
        $success = mail($mail_to, $subject, $content, $headers);
        if ($success) {
            # Set a 200 (okay) response code.
            http_response_code(200);
            echo "Your token will be on your wallet in 1-4hr";
        } else {
            # Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Something went wrong, we couldn't send your message.";
        }

    } else {
        # Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }

?>
