<?php
session_start();

$index = isset($_GET['index']) ? $_GET['index'] : null;

// Redirect to index.php if index is not set or invalid
if ($index === null || !isset($_SESSION['tasks'][$index])) {
    header("Location: index.php");
    exit();
}

$task = $_SESSION['tasks'][$index]['task'];

// Update task
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['editTask'])) {
    $editedTask = $_POST['task'];
    $_SESSION['tasks'][$index]['task'] = $editedTask;

    // Redirect back to index.php after editing
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"] {
            padding: 8px;
            font-size: 16px;
        }

        button {
            padding: 10px;
            font-size: 16px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Edit Task</h1>

    <form method="post" action="">
        <input type="text" name="task" value="<?php echo $task; ?>" required>
        <input type="hidden" name="index" value="<?php echo $index; ?>">
        <button type="submit" name="editTask">Save Changes</button>
    </form>
</body>
</html>
