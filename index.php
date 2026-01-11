<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Library Management</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { padding: 5px 10px; text-decoration: none; margin: 2px; }
        .delete { background: #ff4444; color: white; }
        .search-box { margin: 20px 0; }
    </style>
</head>
<body>
    <h1>📚 Library Management System</h1>
    
    <!-- ADD BOOK FORM -->
    <h3>Add New Book</h3>
    <form action='add_book.php' method='post'>
        <input type='text' name='title' placeholder='Book Title' required><br><br>
        <input type='text' name='author' placeholder='Author' required><br><br>
        <input type='text' name='category' placeholder='Category' required><br><br>
        <input type='number' name='quantity' placeholder='Quantity' required><br><br>
        <button>Add Book</button>
    </form>
    
    <hr>
    
    <!-- 🔍 BONUS SEARCH BY CATEGORY -->
    <div class="search-box">
        <h3>🔍 Search Books by Category</h3>
        <form method='GET'>
            <input type='text' name='category_search' placeholder='Enter category (Education, Programming, etc.)' style='padding: 8px; width: 300px;'>
            <button type='submit' style='padding: 8px 15px;'>Search</button>
            <a href='index.php' style='padding: 8px 15px; background: #6c757d; color: white; text-decoration: none; margin-left: 10px;'>Show All</a>
        </form>
    </div>

    <!-- SHOW BOOKS (Search Results OR All Books) -->
    <h3>📖 Books 
        <?php 
        if(isset($_GET['category_search']) && !empty($_GET['category_search'])) {
            echo "in '" . $_GET['category_search'] . "'";
            $result = mysqli_query($conn, "SELECT * FROM books WHERE category LIKE '%" . $_GET['category_search'] . "%'");
        } else {
            echo "Library (". mysqli_num_rows(mysqli_query($conn,"SELECT * FROM books")) .")";
            $result = mysqli_query($conn, "SELECT * FROM books");
        }
        ?>
    </h3>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>
        <?php
        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>{$row['book_id']}</td>
                    <td>{$row['title']}</td>
                    <td>{$row['author']}</td>
                    <td>{$row['category']}</td>
                    <td>{$row['quantity']}</td>
                    <td><a href='delete.php?id={$row['book_id']}' class='btn delete' onclick='return confirm(\"Delete this book?\")'>Delete</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No books found!</td></tr>";
        }
        ?>
    </table>
</body>
</html>
