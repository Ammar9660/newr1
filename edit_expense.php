<!DOCTYPE html>
<html>
<head>
    <title>Edit Expense</title>
</head>
<body>
    <h1>Edit Expense</h1>

    <?php
    $conn = new mysqli("localhost", "root", "", "expenses");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_GET['id'];


    $sql = "SELECT * FROM expenses WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Expense not found.";
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
       
        $name = $_POST['expense_name'];
        $category = $_POST['expense_category'];
        $amount = $_POST['expense_amount'];
        $date = $_POST['expense_date'];

        $updateSql = "UPDATE expenses SET name='$name', category='$category', amount='$amount', date='$date' WHERE id='$id'";

        if ($conn->query($updateSql) === TRUE) {
            header("Location: index.php"); 
        } else {
            echo "Error updating expense: " . $conn->error;
        }
    }
    ?>

    <form action="" method="POST">
        <label for="expense_name">Name:</label>
        <input type="text" id="expense_name" name="expense_name" value="<?php echo $row['name']; ?>" required><br><br>

        <label for="expense_category">Category:</label>
        <select id="expense_category" name="expense_category" required>
        <option value="Food">Food</option>
            <option value="Transportation">Transportation</option>
            <option value="Utilities">Utilities</option>
            <option value="Entertainment">Entertainment</option>
            <option value="Other">Other</option>
          
        </select><br><br>

        <label for="expense_amount">Amount:</label>
        <input type="number" id="expense_amount" name="expense_amount" step="0.01" value="<?php echo $row['amount']; ?>" required><br><br>

        <label for="expense_date">Date:</label>
        <input type="date" id="expense_date" name="expense_date" value="<?php echo $row['date']; ?>" required><br><br>

        <input type="submit" value="Update">
    </form>
</body>
</html>
