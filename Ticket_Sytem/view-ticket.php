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

$success = false;
$error = false;
require_once('./support/int.php');

if (isset($_POST['id'])) {
    $db = new DB();
    // Retrieve the ticket details from the database based on the ticket_id
    $ticket_q = $db->conn->query("SELECT * FROM tickets WHERE ticket_id='" . $_POST['id'] . "'");
    if ($ticket_q->num_rows > 0) {
        while ($row = $ticket_q->fetch_assoc()) {
            // Redirect to the ticket.php page with the corresponding ticket's id
            header("Location: ./ticket.php?id=" . $row['id']);
        }
    } else {
        $error = "Invalid ticket id";
    }
}

?>
<body>
<form method="POST">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-header"> View Your Ticket</div>
                    <div class="card-body">
                        <?php
                        // Display error message if an error occurred
                        if (isset($error) && $error != false) {
                            echo '<div class="alert alert-danger">' . $error . '</div>';
                        }
                        ?>
                        <?php
                        // Display success message if the ticket was successfully retrieved
                        if (isset($success) && $success != false) {
                            echo '<div class="alert alert-success">' . $success . '</div>';
                        }
                        ?>
                        <div class="form-group">
                            <label>Enter Your Ticket ID</label>
                            <input type="text" name="id" id="id" required class="form-control" autocomplete="off"
                                   list="ticketIdSuggestions">
                            <datalist id="ticketIdSuggestions">
                                <?php
                                // Generate the options for ticket_id suggestions based on the data from the database
                                $ticketIds = getTicketIdsFromDatabase();
                                foreach ($ticketIds as $ticketId) {
                                    echo '<option value="' . $ticketId . '">';
                                }
                                ?>
                            </datalist>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-lg">Submit</button>
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
<?php

function getTicketIdsFromDatabase()
{
    $host = '5.39.83.70';
    $user = 'heniu';
    $password = 'Doopa2137!';
    $database = 'ticket_system_1';
    $table = 'tickets';
    $column = 'ticket_id';

    // Establish a connection to the database
    $conn = new mysqli($host, $user, $password, $database);

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    $sql = "SELECT $column FROM $table";
    $result = $conn->query($sql);

    $ticketIds = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Retrieve ticket_id values and store them in an array
            $ticketIds[] = $row[$column];
        }
    }

    $conn->close();

    return $ticketIds;
}

?>

</html>
