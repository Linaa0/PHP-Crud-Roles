<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="../styles.css">
</head>

<body>

<div class="container">

<h1>Login</h1>

<form action="../includes/login_process.php" method="POST">

<input type="email" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit">Login</button>

</form>

<br>

<a href="register.php">Create account</a>

</div>

</body>
</html>