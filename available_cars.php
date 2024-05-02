<?php
session_start();
include('includes/functions.php');

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rent_car'])) {
    if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'customer') {
        if(isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            if(isset($_POST['car_id']) && isset($_POST['days']) && isset($_POST['start_date'])) {
                $car_id = $_POST['car_id'];
                $days = $_POST['days'];
                $start_date = $_POST['start_date'];
                rentCar($user_id, $car_id, $start_date, $days);
            } else {
                echo "Required fields are not set.";
            }
        } else {
            header("Location: login.php");
            exit;
        }
    } else {
        echo "Only customers can rent cars.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Cars</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include('components/header.php'); ?>

<div class="container mt-5 mb-5">
    <h2>Available Cars</h2>
    <?php
    $cars = getAvailableCars();
    if($cars && mysqli_num_rows($cars) > 0) {
        while($row = mysqli_fetch_assoc($cars)) {
            echo "<div class='card mb-3'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>{$row['vehicle_model']}</h5>";
            echo "<p class='card-text'>Vehicle Number: {$row['vehicle_number']}</p>";
            echo "<p class='card-text'>Seating Capacity: {$row['seating_capacity']}</p>";
            echo "<p class='card-text'>Rent per Day: {$row['rent_per_day']}</p>";
            if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'customer') {
                echo "<form method='post'>";
                echo "<div class='form-group'>";
                echo "<label for='days'>Number of Days:</label>";
                echo "<select class='form-control' id='days' name='days' required>";
                echo "<option value='1'>1 Day</option>";
                echo "<option value='2'>2 Days</option>";
                echo "<option value='3'>3 Days</option>";
                echo "<option value='4'>4 Days</option>";
                echo "<option value='5'>5 Days</option>";
                echo "<option value='6'>6 Days</option>";
                echo "<option value='7'>7 Days</option>";
                echo "</select>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='start_date'>Start Date:</label>";
                echo "<input type='date' class='form-control' id='start_date' name='start_date' required>";
                echo "</div>";
                echo "<input type='hidden' name='car_id' value='{$row['id']}'>";
                echo "<input type='hidden' name='user_id' value='{$_SESSION['user_id']}'>";
                echo "<button type='submit' class='btn btn-primary' name='rent_car'>Rent Car</button>";
                echo "</form>";
            }
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>No available cars.</p>";
    }
    ?>
</div>

<?php include('components/footer.php'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>