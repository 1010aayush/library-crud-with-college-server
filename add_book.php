<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize inputs to prevent SQL injection
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $quantity = (int)$_POST['quantity'];
    
    // Insert book into database
    $sql = "INSERT INTO books (title, author, category, quantity) 
            VALUES ('$title', '$author', '$category', $quantity)";
    
    if (mysqli_query($conn, $sql)) {
        header('Location: index.php?msg=Book added successfully');
    } else {
        header('Location: index.php?error=Failed to add book');
    }
    
    mysqli_close($conn);
} else {
    header('Location: index.php');
}
?>
