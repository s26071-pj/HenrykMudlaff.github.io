<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket System</title>
    <link rel="stylesheet" href="./support/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./support/assets/css/app.css">
</head>
<?php
$success=false;
$error=false;
require_once('./support/int.php');
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $subject=$_POST['subject'];
    $mobile=$_POST['mobile'];
    $message=$_POST['message'];
    $date = date('Y-m-d');

    $unid=random_bytes(10);
    $unid=bin2hex($unid);

    $db=new DB();

    $sql = "INSERT INTO tickets (ticket_id, status, name, mobile, email, subject, message, date) VALUES ('$unid', '0', '$name', '$mobile', '$email', '$subject', '$message', '$date')";
    $insert = $db->conn->query($sql);
    if($insert){
        $success='Your ticket has been created. Your ticket id is '.$unid;
        $to = $email;
        $subject = "Support Ticket";
        $txt = "Dear $name your tickets has been sent to our support team and we will back you shortly. and here your ticket id $unid ";
        $headers = "From: iwantm8@gmail.com" . "\r\n";
        // mail($to,$subject,$txt,$headers);
    }else{
        $error='Ticket not sent to our team, please try again later';
    }
}
?>
<body>
<form method="POST">
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header"> Contact Our Support Center</div>
                    <div class="card-body">
                        <?php
                        if(isset($error) && $error != false){
                            echo '<div class="alert alert-danger">'.$error.'</div>';
                        }
                        ?>
                        <?php
                        if(isset($success) && $success != false){
                            echo '<div class="alert alert-success">'.$success.'</div>';
                        }
                        ?>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Your name <span class="text-danger">*</span> </label>
                                    <input type="text" required name="name" id="name" placeholder="Your full name" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Your E-Mail Address <span class="text-danger">*</span></label>
                                    <input type="email" required name="email" id="email" placeholder="Your Email Address" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Subject <span class="text-danger">*</span></label>
                                    <input type="text" required name="subject" id="subject" placeholder="Subject About Support" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>You Mobile Number <span class="text-danger">*</span></label>
                                    <input type="text" required name="mobile" id="mobile" placeholder="Your Mobile Number" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea name="message" class="form-control" id="message" cols="30" rows="5" placeholder="Enter your description about help"></textarea>
                                </div>
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="text-right">
                                    <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>">
                                    <input type="hidden" name="submit" value="form">
                                    <button class="btn btn-primary btn-lg" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</body>
<script src="./support/assets/js/jquery-3.6.0.min.js"></script>
<script src="./support/assets/js/popper.min.js"></script>
<script src="./support/assets/js/bootstrap.min.js"></script>
</html>
