<!DOCTYPE html>
<html>

<head>
    <title>Simple Website Template</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <?php include 'inc_nav.php'; ?>
    <form method="post" action="register.php">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email"required>
        <input type="password" name="password" placeholder="Password"required>
        <input type="text" name="role" placeholder="Role"required>
        <input type="submit" value="Register">
    </form>
    <footer>Copyright © 2021 Simple Website Template</footer>
</body>

</html>