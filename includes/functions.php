<?php
include('db_connection.php');

function registerUser($userType) {
    global $conn;

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password, user_type) VALUES ('$username', '$hashedPassword', '$userType')";

    if(mysqli_query($conn, $sql)) {
        header("Location: login.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

function loginUser() {
    global $conn;

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_type'] = $row['user_type'];
            header("Location: index.php");
            exit;
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Invalid username or password.";
    }
}

function addCar() {
    global $conn;

    $vehicle_model = mysqli_real_escape_string($conn, $_POST['vehicle_model']);
    $vehicle_number = mysqli_real_escape_string($conn, $_POST['vehicle_number']);
    $seating_capacity = mysqli_real_escape_string($conn, $_POST['seating_capacity']);
    $rent_per_day = mysqli_real_escape_string($conn, $_POST['rent_per_day']);

    $agency_id = 1;

    $sql = "INSERT INTO cars (agency_id, vehicle_model, vehicle_number, seating_capacity, rent_per_day) 
            VALUES ('$agency_id', '$vehicle_model', '$vehicle_number', '$seating_capacity', '$rent_per_day')";

    if(mysqli_query($conn, $sql)) {
        echo "Car added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

function logoutUser() {
    session_destroy();
    header("Location: login.php");
    exit;
}

function rentCar() {
    global $conn;

    if(isset($_POST['user_id']) && isset($_POST['car_id']) && isset($_POST['start_date']) && isset($_POST['days'])) {
        $user_id = $_POST['user_id'];
        $car_id = $_POST['car_id'];
        $start_date = $_POST['start_date'];
        $number_of_days = $_POST['days'];

        $update_sql = "UPDATE cars SET rented = 1 WHERE id = '$car_id'";
        if(mysqli_query($conn, $update_sql)) {
            $insert_sql = "INSERT INTO bookings (user_id, car_id, start_date, number_of_days) 
                           VALUES ('$user_id', '$car_id', '$start_date', '$number_of_days')";
            if(mysqli_query($conn, $insert_sql)) {
                echo "Car rented successfully.";
            } else {
                echo "Error: " . $insert_sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Error: " . $update_sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Required fields are not set.";
    }
}

function getAvailableCars() {
    global $conn;

    $sql = "SELECT * FROM cars WHERE rented = 0";
    $result = mysqli_query($conn, $sql);

    return $result;
}

function getBookedCars($agency_id) {
    global $conn;

    $agency_id = mysqli_real_escape_string($conn, $agency_id);
    $sql = "SELECT users.username AS customer_name, cars.vehicle_model, cars.vehicle_number, bookings.start_date, bookings.number_of_days
            FROM bookings
            INNER JOIN users ON bookings.user_id = users.id
            INNER JOIN cars ON bookings.car_id = cars.id
            WHERE cars.agency_id = '$agency_id'";
    $result = mysqli_query($conn, $sql);

    return $result;
}

function getAgencyId($user_id) {
    global $conn;

    $user_id = mysqli_real_escape_string($conn, $user_id);
    $sql = "SELECT agency_id FROM cars WHERE id = (
                SELECT agency_id FROM users WHERE id = '$user_id'
            ) LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['agency_id'];
    } else {
        return null;
    }
}
?>