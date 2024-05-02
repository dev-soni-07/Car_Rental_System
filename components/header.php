<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Car Rental Agency</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="available_cars.php">Available Cars</a></li>
                <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'customer'): ?>
                    <?php elseif(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'agency'): ?>
                        <li class="nav-item"><a class="nav-link" href="add_car.php">Add New Car</a></li>
                        <li class="nav-item"><a class="nav-link" href="view_booked_cars.php">View Booked Cars</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="register_customer.php">Register as Customer</a></li>
                    <li class="nav-item"><a class="nav-link" href="register_agency.php">Register as Agency</a></li>
                <?php endif; ?>
                <?php if(isset($_SESSION['user_type'])): ?>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>