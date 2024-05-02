<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Agency</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include('components/header.php'); ?>

<section class="container">
    <div class="bg-secondary bg-gradient p-5 text-white">
        <h1 class="display-4">Welcome to our Car Rental Agency</h1>
        <?php if(isset($_SESSION['user_type'])): ?>
            <p class="lead">You are logged in as <?php echo $_SESSION['user_type']; ?>.</p>
        <?php else: ?>
            <p class="lead">Please login or register to continue.</p>
        <?php endif; ?>
    </div>
</section>

<?php include('components/footer.php'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/index.js"></script>
</body>
</html>