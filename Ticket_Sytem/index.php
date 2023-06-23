<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket System</title>
    <link rel="stylesheet" href="./support/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./support/assets/css/app.css">
    <style>
        body,html{
            background-image:url(support/assets/img/bg.jpeg);
            background-size: cover;
        }



        .button-container {
            background-color: transparent;
            padding: 0;
        }
    </style>
</head>
<body>
    <form method="POST">
        <div class="container mt-4">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h3>View Your Ticket</h3>
                            <p>We are sent you ticket id when you submit a new ticket and if you have ticket id you can view it easly</p>
                            <a href="./view-ticket.php" class="btn btn-success">View Ticket</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h3>Submit New Ticket</h3>
                            <p>Get 24/7 support from our help team.We are sent you ticket id when you submit a new ticket</p>
                            <a href="./submit-ticket.php" class="btn btn-success">Submit Ticket</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-4">
            <div class="row">
                <div class="col-2">
                    <div class="card button-container">
                        <div class="card-body">
                            <a href="./admin-login.php" class="btn btn-danger">Admin Panel</a>
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