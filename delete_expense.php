<?php
$conn = new mysqli("localhost", "root", "", "expenses");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

$sql = "DELETE FROM expenses WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Error deleting expense: " . $conn->error;
}

$conn->close();
?>
