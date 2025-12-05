<?php
include "db.php";

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM contacts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
    exit;
}

$result = $conn->query("SELECT * FROM contacts ORDER BY id DESC");
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Contact List</title></head>
<body>
<h2>Contact List</h2>
<a href="create.php">Add New Contact</a>
<br><br>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th><th>Name</th><th>Email</th><th>Message</th><th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['id']) ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
        <td>
            <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
            <a href="index.php?delete=<?= $row['id'] ?>"
               onclick="return confirm('Delete this contact?');">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>
