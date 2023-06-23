<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket System - Admin Dashboard</title>
    <link rel="stylesheet" href="./support/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./support/assets/css/app.css">
    <link rel="stylesheet" href="./support/assets/css/admin.css">
</head>
<?php 
require_once('./support/int.php');
if(!isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] != true){
    header('Location: ./admin-login.php');
}

$new_status=0;
$waiting_reply_status=1;
$closed_status=2;

$new_count=0;
$reply_count=0;
$closed_count=0;

$db=new DB();

$new_tickets_query="SELECT COUNT(*) AS new_tickets FROM tickets WHERE status=$new_status";
$ntr=$db->conn->query($new_tickets_query); 
if($ntr->num_rows > 0){
    while ($row = $ntr->fetch_assoc()) {
        $new_count=$row['new_tickets'];
    }
}

$reply_tickets_query="SELECT COUNT(*) AS new_tickets FROM tickets WHERE status=$waiting_reply_status";
$rtc=$db->conn->query($reply_tickets_query);
if($rtc->num_rows > 0){
    while ($row = $rtc->fetch_assoc()) {
        $reply_count=$row['new_tickets'];
    }
}

$closed_tickets_query="SELECT COUNT(*) AS new_tickets FROM tickets WHERE status=$closed_status";
$ctr=$db->conn->query($closed_tickets_query);
if($ctr->num_rows > 0){
    while ($row = $ctr->fetch_assoc()) {
        $closed_count=$row['new_tickets'];
    }
}
$latest=[];
$recodes=$db->conn->query("SELECT * FROM tickets ORDER BY 'date' DESC LIMIT 10 ");
if($recodes->num_rows >0){
    while ($row = $recodes->fetch_assoc()) {
        $latest[]=$row;
    }
}

?>
<body>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <h3>Welcome Admin</h3>
                    <p>admin@admin.com</p>
                    <a href="./logout.php" class="btn btn-dark">Logout</a>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="list-inline admn_ul">
                        <a href="./admin-dashboard.php" class="list-inline-item">Dashboard</a>
                        <a href="./admin-new-tickets.php" class="list-inline-item">New Tickets</a>
                        <a href="./admin-waiting-tickets.php" class="list-inline-item">Waiting For Reply</a>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="card bg-info">
                                <div class="card-body text-white">
                                    <h3>New Tickets</h3>
                                    <h2><?php echo $new_count;?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="card bg-warning">
                                <div class="card-body text-white">
                                    <h3>Waiting Tickets</h3>
                                    <h2><?php echo $reply_count;?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="card bg-dark">
                                <div class="card-body text-white">
                                    <h3>Closed</h3>
                                    <h2><?php echo $closed_count;?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Latest Tickets
                </div>
                <div class="card-body">
                    <?php if(count($latest) > 0){?>
                    <table class="table table-striped table-inverse">
                        <thead class="thead-inverse">
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php 
                                foreach ($latest as $k => $v) {
                                    echo '
                                    <tr>
                                        <td>'.$v['id'].'</td>
                                        <td>'.$v['name'].'</td>
                                        <td>'.$v['email'].'</td>
                                        <td>'.$v['subject'].'</td>
                                        <td>'.$v['date'].'</td>
                                        <td><a href="./admin-ticket-view.php?id='.$v['id'].'" class="btn btn-sm btn-info">View<a/></td>
                                    </tr>
                                    ';
                                }
                                ?>
                            </tbody>
                    </table>
                    <?php }else{
                        echo '<div class="alert alert-info">No any new tickets</div>';
                    } ?>
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