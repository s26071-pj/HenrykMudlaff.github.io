<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket System - Admin Login</title>
    <link rel="stylesheet" href="./support/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./support/assets/css/app.css">
</head>
<?php 
require_once('./support/int.php');
if(isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] == true){
   header('Location: ./admin-dashboard.php');
}
$erro=false;
if(isset($_POST['username'])){
   
    $password=$_POST['password'];
    $username=$_POST['username'];

    $db=new DB();
    $query="SELECT * FROM admin WHERE username='$username'";
    $result=$db->conn->query($query);print_r($query);
    if($result->num_rows > 0){
        while ($row = $result->fetch_assoc()) {
            if($row['password'] == md5($password)){
                $_SESSION['admin_logged'] =true;
                $_SESSION['admin']=$row;
                header('Location: ./admin-dashboard.php');
                exit();
            }else{
                $erro='Invalid username, please try again'; 
            }
        }
    }else{
        $erro='Invalid username, please try again';
    }
}
?>
<body>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="POST">
                        <?php 
                            if(isset($erro) && $erro != false){
                                echo '<div class="alert alert-danger">'.$erro.'</div>';
                            }
                        ?>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" id="username" required placeholder="Admin username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" id="password" required placeholder="Admin password" class="form-control">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger btn-block" type="submit">Login</button>
                        </div>
                        <div class="form-group">
                            <a href="index.php" class="btn btn-primary btn-block">Back to Home</a>
                        </div>
                    </form>
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