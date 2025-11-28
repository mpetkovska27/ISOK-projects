<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Task</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form {
            border: 1px solid #ddd;
            padding: 20px 25px;
            border-radius: 4px;
            width: 300px;
        }
        label{
            display: block;
            margin-bottom: 4px;
        }
        input{
            width: 100%;
            padding: 6px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

    </style>
</head>
<body>
<form action="add_task.php" method="POST">
    <label for="naslov">Naslov:</label>
    <input type="text" name="naslov" id="naslov" required>
    <br />
    <label for="rok">Rok:</label>
    <input type="date" name="rok" id="rok" required>
    <br />
    <label for="prioritet">Prioritet:</label>
    <input type="text" name="prioritet" id="prioritet" required>
    <br />
    <label for="status">Status:</label>
    <input type="text" name="status" id="status" required>
    <br />
    <button type="submit">Add Task</button>
</form>
</body>