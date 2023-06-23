<!-- HTML Document -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket System - Admin Dashboard</title>
    <link rel="stylesheet" href="./support/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./support/assets/css/app.css">
</head>
<?php 
    $success=false;
    $error=false;
    if(!isset($_GET['id'])){
        header('Location: ./admin-dashboard');
    }

    // Include necessary files
    require_once('./support/int.php');

    // Check if the admin is not logged in, if not, redirect to the admin login page
    if(!isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] != true){
        header('Location: ./admin-login.php');
    }

    $db=new DB();
    $ticket='';
    $this_ticket_query=$db->conn->query("SELECT * FROM tickets WHERE id=".$_GET['id']);

    // Fetch the selected ticket from the database
    if($this_ticket_query->num_rows > 0){
        while ($row = $this_ticket_query->fetch_assoc()) {
            $ticket=$row;
        }
    }else{
        header('Location: ./admin-dashboard');
    }
    $ticket_id=$ticket['id'];
    $reps=[];

    // Fetch the replies for the selected ticket
    if($ticket != ''){
        $replies=$db->conn->query("SELECT * FROM ticket_reply WHERE ticket_id =$ticket_id");
        if($replies->num_rows > 0){
            while ($row = $replies->fetch_assoc()) {
                $reps[]=$row;
            }
        }
    }

    // Reply Send Method
    if(isset($_POST['submit'])){
        $message=$_POST['message'];
        
        if($db->conn->query("INSERT INTO ticket_reply (ticket_id,send_by,message) VALUES('$ticket_id','1','$message')")){
            $success="Reply has been sent";
            $db->conn->query("UPDATE tickets  SET status=2 WHERE id=$ticket_id");
            $to = $ticket['email'];
            $subject = "New Reply";
            $txt = "Dear ".$ticket['name']." your tickets got a reply from our support team";
            $headers = "From: iwantm8@gmail.com" . "\r\n";
            // mail($to,$subject,$txt,$headers);
        }else{
            $error="Can not send reply";
        }
    }
?>
<body>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <!-- Navigation links -->
                    <div class="list-inline admn_ul">
                        <a href="./admin-dashboard.php" class="list-inline-item">Dashboard</a>
                        <a href="./admin-new-tickets.php" class="list-inline-item">New Tickets</a>
                        <a href="./admin-waiting-tickets.php" class="list-inline-item">Waiting For Reply</a>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    Ticket ID : <?php  echo $ticket['ticket_id'] ;?>
                </div>
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
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <td><?php  echo $ticket['name'] ;?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php  echo $ticket['email'] ;?></td>
                        </tr>
                        <tr>
                            <th>Subject</th>
                            <td><?php  echo $ticket['subject'] ;?></td>
                        </tr>
                        <tr>
                            <th>Mobile</th>
                            <td><?php  echo $ticket['mobile'] ;?></td>
                        </tr>
                    </table>
                    <p><?php  echo $ticket['message'] ;?></p>
                    <div class="reply-area">
                        <ul>
                            <?php if(count($reps) > 0) { ?>
                                <?php foreach ($reps as $k => $v) {
                                    if($v['send_by'] == 0){
                                        ?>
                                         <li class="reply-user">
                                            <div class="card bg-info text-white">
                                                <div class="card-body">
                                                    <p><?php echo $v['message']; ?></p>
                                                    <div class="text-right">
                                                        <span><?php echo $v['date'];?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                    }else{
                                        ?>
                                        <li class="reply-me">
                                            <div class="card bg-gray text-dark">
                                                <div class="card-body">
                                                    <p><?php echo $v['message']; ?></p>
                                                    <div class="text-right">
                                                        <small>Send by support team at <?php echo $v['date'];?></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                }
                            ?>
                            
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="send-area">
                        <form method="POST">
                            <div class="form-group">
                                <textarea name="message" class="form-control" placeholder="Reply" id="message" cols="30" rows="4"></textarea>
                            </div>
                            <div class="form-group text-right">
                                <input type="hidden" name="submit" value="send">
                                <button class="btn btn-success" type="submit">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="./support/assets/js/jquery-3.6.0.min.js"></script>
<script src="./support/assets/js/popper.min.js"></script>
<script src="./support/assets/js/bootstrap.min.js"></script>
</html>
