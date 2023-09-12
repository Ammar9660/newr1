<?php
$conn = new mysqli("localhost", "root", "", "expenses");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['expense_name'];
$category = $_POST['expense_category'];
$amount = $_POST['expense_amount'];
$date = $_POST['expense_date'];

$sql = "INSERT INTO expenses (name, category, amount, date) VALUES ('$name', '$category', '$amount', '$date')";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
