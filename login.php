<?php
session_start();
if(isset($_SESSION['user_type'])) {
    header("Location: index.php");
    exit;
}

include('includes/functions.php');

$errors = [];

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST['username'])) {
        $errors[] = "Username is required.";
    }

    if(empty($_POST['password'])) {
        $errors[] = "Password is required.";
    }

    if(empty($errors)) {
        loginUser();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include('components/header.php'); ?>

    <div class="container mt-5">
        <h2>Login</h2>
        <?php if(!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form method="post" id="loginForm">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

    <?php include('components/footer.php'); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').submit(function(event) {
                var username = $('#username').val();
                var password = $('#password').val();

                if(username.trim() == '') {
                    alert('Username is required.');
                    event.preventDefault();
                } else if(password.trim() == '') {
                    alert('Password is required.');
                    event.preventDefault();
                }
            });
        });
    </script>
</body>
</html>