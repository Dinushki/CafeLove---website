<?php
require_once __DIR__ . "/storage.php";
session_start();
$admins = load_json_file("admin.json");
if (empty($admins)) {
    $admins[] = [
        "username" => "admin",
        "password" => password_hash("admin123", PASSWORD_DEFAULT)
    ];
    save_json_file("admin.json", $admins);
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = sanitize_input($_POST['username']);
    $pass = $_POST['password'];
    foreach ($admins as $a) {
        if ($a["username"] === $user && password_verify($pass, $a["password"])) {
            $_SESSION["admin_logged_in"] = true;
            header("Location: admin.php");
            exit;
        }
    }
    $error = "Invalid credentials.";
}
?>
<!DOCTYPE html><html><head><title>Admin Login</title></head><body>
<h2>Admin Login</h2>
<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="POST">
<input name="username" placeholder="Username">
<input name="password" placeholder="Password" type="password">
<button>Login</button>
</form></body></html>