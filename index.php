<?php
	//error handlers
	$errors = "";
	$sql = "";
	//connect to database
	$db = mysqli_connect('localhost', 'root', '', 'mytodolist');

	if(isset($_POST['submit'])){
		$task = $_POST['task'];
		if (empty($task)){
			$errors = "Please fill in the blank";
		} else {
			$sql = mysqli_query($db, "INSERT iNTO tasks(task) VALUES ('$task')");
			header('Location: index.php');
		}
	}

	//Delete Task
	if(isset($_GET['del_task'])){
		$id = $_GET['del_task'];
		mysqli_query($db,"DELETE FROM tasks WHERE id = $id");
		header('Location: index.php');
	}


	$task = mysqli_query($db, "SELECT * FROM tasks");
?>

<!DOCTYPE html>
<html>
<head>
	<title>My Todo List APP</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script>
		if()
	</script>
</head>
<body>
	<div class="heading">
		<h2>My Todo List</h2>
	</div>

	<form id="myForm" method="POST" action="index.php">
	<?php if (isset($errors)){ ?>
		<p><?php echo $errors; ?></p>
	<?php }?>

		<input type="text" name="task" class="task_input">

		<button id="sub" type="submit" class="add_btn" name="submit">Add Task</button>
	</form>

	<span id="result"></span>
	<table>
		<thead>
			<tr>
				<th>No.</th>
				<th>Task</th>
				<th>Action</th>
			</tr>
		</thead>

		<tbody>
			<?php $i = 1; while ($row = mysqli_fetch_array($task)){ ?>
				<tr>
					<td><?php echo $i; ?></td>
					<td class="task"><?php echo $row['task']; ?></td>
					<td class="delete">
						<a href="index.php?del_task=<?php echo $row['id']; ?>">x</a>
					</td>
				</tr>				
			<?php $i++; } ?>
		</tbody>
	</table>
	<script src="my_script.js" type="text/javascript"></script>
</body>
</html>