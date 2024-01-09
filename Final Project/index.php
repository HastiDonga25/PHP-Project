<?php
session_start();
                 
// Initialize tasks array if not set
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}

// Add a new task
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['addTask'])) {
    $task = $_POST['task'];
    $_SESSION['tasks'][] = ['task' => $task, 'completed' => false];
}

// Mark a task as completed
if (isset($_GET['complete'])) {
    $index = $_GET['complete'];
    $_SESSION['tasks'][$index]['completed'] = true;
}

// Delete a task
if (isset($_GET['delete'])) {
    $index = $_GET['delete'];
    unset($_SESSION['tasks'][$index]);
}

// Edit a task
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['editTask'])) {
    $index = $_POST['index'];
    $editedTask = $_POST['task'];
    $_SESSION['tasks'][$index]['task'] = $editedTask;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System</title>
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

        ul {
            list-style: none;
            padding: 0;
            width: 300px;
        }

        li {
            background-color: #fff;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        li.completed {
            text-decoration: line-through;
        }

        a {
            text-decoration: none;
            color: #333;
            margin-left: 10px;
            cursor: pointer;
        }

        a:hover {
            color: #4caf50;
        }
    </style>
</head>
<body>
    <h1>Task Management System</h1>

    <form method="post" action="">
        <input type="text" name="task" placeholder="Enter task..." required>
        <button type="submit" name="addTask">Add Task</button>
    </form>

    <ul>
        <?php foreach ($_SESSION['tasks'] as $index => $task): ?>
            <li class="<?php echo $task['completed'] ? 'completed' : ''; ?>">
                <?php echo $task['task']; ?>
                <?php if (!$task['completed']): ?>
                    <a href="?complete=<?php echo $index; ?>">Mark as Completed</a>
                <?php endif; ?>
                <a href="?delete=<?php echo $index; ?>">Delete</a>
                <a href="edit.php?index=<?php echo $index; ?>">Edit</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
