<?php
include 'db.php';
$id = $_GET['id'];
$sql = "DELETE FROM books WHERE book_id = $id";
mysqli_query($conn, $sql);
header("Location: index.php");
?>
