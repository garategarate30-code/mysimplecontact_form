<?php
include "db.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int)$_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name']);
    $email   = trim($_POST['email']);
    $message = trim($_POST['message']);

    $stmt = $conn->prepare("UPDATE contacts SET name = ?, email = ?, message = ? WHERE id = ?");
    $stmt->bind_param("sssi", $name, $email, $message, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
    exit;
}

$stmt = $conn->prepare("SELECT name, email, message FROM contacts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($name, $email, $message);
$stmt->fetch();
$stmt->close();
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Edit Contact</title></head>
<body>
<h2>Edit Contact</h2>
<form method="POST" action="edit.php?id=<?= $id ?>">
    <label>Name</label><br>
    <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required><br><br>

    <label>Message</label><br>
    <textarea name="message" required><?= htmlspecialchars($message) ?></textarea><br><br>

    <button type="submit">Update</button>
</form>
<br>
<a href="index.php">Back to list</a>
</body>
</html>
