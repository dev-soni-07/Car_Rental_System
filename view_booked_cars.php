<?php
session_start();
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'agency') {
    header("Location: login.php");
    exit;
}
include('includes/functions.php');

$agency_id = getAgencyId($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Booked Cars</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include('components/header.php'); ?>

<div class="container mt-5">
    <h2>View Booked Cars</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Customer Name</th>
                <th>Vehicle Model</th>
                <th>Vehicle Number</th>
                <th>Start Date</th>
                <th>Number of Days</th>
            </tr>
            </thead>
            <tbody>
            <?php
            
            $booked_cars = getBookedCars($agency_id);
            
            if ($booked_cars && mysqli_num_rows($booked_cars) > 0) {
                while ($row = mysqli_fetch_assoc($booked_cars)) {
                    echo "<tr>";
                    echo "<td>{$row['customer_name']}</td>";
                    echo "<td>{$row['vehicle_model']}</td>";
                    echo "<td>{$row['vehicle_number']}</td>";
                    echo "<td>{$row['start_date']}</td>";
                    echo "<td>{$row['number_of_days']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No cars booked yet.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('components/footer.php'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>