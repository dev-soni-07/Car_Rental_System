<?php
session_start();
if(!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'agency') {
    header("Location: login.php");
    exit;
}
include('includes/functions.php');

if($_SERVER["REQUEST_METHOD"] == "POST") {
    addCar();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Car</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include('components/header.php'); ?>

    <div class="container mt-5">
        <h2>Add New Car</h2>
        <form method="post">
            <div class="form-group">
                <label for="vehicle_model">Vehicle Model:</label>
                <input type="text" class="form-control" id="vehicle_model" name="vehicle_model" required>
            </div>
            <div class="form-group">
                <label for="vehicle_number">Vehicle Number:</label>
                <input type="text" class="form-control" id="vehicle_number" name="vehicle_number" required>
            </div>
            <div class="form-group">
                <label for="seating_capacity">Seating Capacity:</label>
                <input type="number" class="form-control" id="seating_capacity" name="seating_capacity" required>
            </div>
            <div class="form-group">
                <label for="rent_per_day">Rent per Day:</label>
                <input type="number" step="0.01" class="form-control" id="rent_per_day" name="rent_per_day" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Car</button>
        </form>
    </div>

    <?php include('components/footer.php'); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>