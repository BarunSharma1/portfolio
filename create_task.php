<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$project_id = $_GET['project_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $assigned_to = $_POST['assigned_to'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    $sql = "INSERT INTO tasks (project_id, name, description, assigned_to, due_date, status) VALUES ('$project_id', '$name', '$description', '$assigned_to', '$due_date', '$status')";
    if ($conn->query($sql) === TRUE) {
        header("Location: view_project.php?id=$project_id");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Task</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1>IT Project Tracker</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="create_project.php">Create Project</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="container">
        <h1>Create Task</h1>
        <form method="POST">
            <label>Name</label>
            <input type="text" name="name" required>
            <label>Description</label>
            <textarea name="description" required></textarea>
            <label>Assigned To</label>
            <input type="text" name="assigned_to" required>
            <label>Due Date</label>
            <input type="date" name="due_date" required>
            <label>Status</label>
            <select name="status">
                <option value="Not Started">Not Started</option>
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
            </select>
            <input type="submit" value="Create Task">
        </form>
    </div>
</body>
</html>
