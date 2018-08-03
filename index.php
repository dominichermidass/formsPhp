<?php
    $msg = '';
    $msgClass = '';

    if(isset($_POST['submit'])){
       //Get form DATA
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        if(!empty($name) && !empty($email) && !empty($message)){
               //passed

               if(!filter_var($email , FILTER_VALIDATE_EMAIL)){
                  
                    $msg  = 'Please enter a valid email';
                    $msgClass = 'alert-danger';
               }else{
                    //passed, and ready to send msg

                    $toEmail = 'support@traversymedia.com';
                    $subject = 'Contact Request From'.$name;
                    $body =  $message;

                    //email Headers
                    $header = "MIME-Version: 1.0" ."\r\n";
                    $header .= "Content-Type:text/html;charset=UTF-8"."\r\n";

                    //Additional Headers

                    $header .= "Form: " .$name. "<".$email.">" ."\r\n";

                    if(mail($toEmail, $subject, $body, $header)){

                    }else{
                        $msg = 'Your email was  sent';
                        $msgClass = 'alert-success';
                    }

               }
        }else{
            $msg  ='Please fill in all fields';
            $msgClass = 'alert-danger';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://bootswatch.com/4/cosmo/bootstrap.min.css">
    <title>Contact Us</title>
</head>
<body>

    <!--

        NAVIGATION BAR

    -->
    <nav class= "navbar navbar-default">
        <div class = "container">
            <div class = "navbar-header">
                <a class="navbar-brand" href="<?php echo $_SERVER['PHP_SELF']?>">My Website</a>
            </div>
        </div>
    </nav>


    <!--

        FORM STRUCTURE

    -->

    <div class= "container">

        <?php if ($msg != ''): ?>
            <div class = "alert <?php echo $msgClass?>">
                <?php echo $msg?>
            </div>
        <?php endif?>

        <form method= "POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class = "form-group">
                <label>Name</label>
                <input type="text" name= "name" class = "form-control">
            </div>
            <div class = "form-group">
                <label>Email</label>
                <input type="text" name= "email" class = "form-control">
            </div>
            <div class = "form-group">
                <label> Message </label>
                <textarea name="message" class= "form-control"></textarea>
            </div>
            <button class= "btn btn-primary" type="submit" name ="submit">Submit</button>
        </form>
    </div>



    
</body>
</html>