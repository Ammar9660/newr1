<!DOCTYPE html>
<html>
<head>
    <title>Expense Tracker</title>
</head>
<body>
    <h1>Expense Tracker</h1>

    <h2>Create Expense</h2>
    <form action="process_expense.php" method="POST">
        <label for="expense_name">Name:</label>
        <input type="text" id="expense_name" name="expense_name" required><br><br>

        <label for="expense_category">Category:</label>
        <select id="expense_category" name="expense_category" required>
            <option value="Food">Food</option>
            <option value="Transportation">Transportation</option>
            <option value="Utilities">Utilities</option>
            <option value="Entertainment">Entertainment</option>
            <option value="Other">Other</option>
        </select><br><br>

        <label for="expense_amount">Amount:</label>
        <input type="number" id="expense_amount" name="expense_amount" step="0.01" required><br><br>

        <label for="expense_date">Date:</label>
        <input type="date" id="expense_date" name="expense_date" required><br><br>

        <input type="submit" value="Submit">
    </form>
    <h2>Expense List</h2>
    <ul>
        <?php
        $conn = new mysqli("localhost", "root", "", "expenses");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM expenses";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<li>";
                echo "<strong>Name:</strong> " . $row["name"] . ", ";
                echo "<strong>Category:</strong> " . $row["category"] . ", ";
                echo "<strong>Amount:</strong> $" . $row["amount"] . ", ";
                echo "<strong>Date:</strong> " . $row["date"];
                echo " [<a href='edit_expense.php?id=" . $row["id"] . "'>Edit</a>]";
                echo " [<a href='delete_expense.php?id=" . $row["id"] . "'>Delete</a>]";
                echo "</li>";
            }
        } else {
            echo "<p>No expenses found.</p>";
        }

        $conn->close();
        ?>
    </ul>
</body>
</html>
