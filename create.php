<?php
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name']);
    $email   = trim($_POST['email']);
    $message = trim($_POST['message']);

    $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
    exit;
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Add Contact</title></head>
<body>
<h2>Add Contact</h2>
<form method="POST" action="create.php">
    <label>Name</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Message</label><br>
    <textarea name="message" required></textarea><br><br>

    <button type="submit">Save</button>
</form>
<br>
<a href="index.php">Back to list</a>
</body>
</html>
