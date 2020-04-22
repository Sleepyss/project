<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Customer</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <!-- Load jquery adn bootstrap.js -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
    </head>
    <body id="bg">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h4>Login Customer</h4>
                </div>
                <div class="card-body">
                    <form action="proses_login_customer.php" method="post">
                        Username
                        <input type="text" name="username1" class="form-control" required />
                        Password
                        <input type="password" name="password1" class="form-control" required />
                        <button type="submit" name="login_customer" class="btn btn-block btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>