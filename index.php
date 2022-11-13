<?php 
    // initialize errors variable
	$errors = "";

	// connect to database
	$db = mysqli_connect("localhost", "root", "password", "tasks");

	// insert a quote if submit button is clicked
	if (isset($_POST['submit'])) {
		if (empty($_POST['task'])) {
			$errors = "You must fill in the task";
		}else{
			$task = $_POST['task'];
			$sql = "INSERT INTO todo_list (task) VALUES ('$task')";
			mysqli_query($db, $sql);
			header('location: index.php');

		
		}
	}


	// delete task	
	if (isset($_GET['del_task'])) {
	$id = $_GET['del_task'];

	mysqli_query($db, "DELETE FROM todo_list WHERE id=".$id);
	header('location: index.php');
}


?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
	<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
	<title>ToDo List using PHP & MySQL</title>
</head>
<body>
	
	<div class="container">
		<h2>ToDo List using PHP & MySQL</h2>
		<div class="form-group">
			<form method="post" action="index.php">
				<?php if (isset($errors)) { ?>
					<p><?php echo $errors; ?></p>
				<?php } ?>
				<input type="text" name="task" class="form-control" placeholder="Input Task">
				<button type="submit" name="submit" class="btn btn-primary">Add Task</button>
			</form>
			<br>
			<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>N</th>
				<th>Tasks</th>
				<th style="width: 60px;">Action</th>
			</tr>
		</thead>

		<tbody>
			<?php 
			// select all tasks if page is visited or refreshed
			$tasks = mysqli_query($db, "SELECT * FROM todo_list");

			$i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
				<tr>
					<td> <?php echo $i; ?> </td>
					<td> <?php echo $row['task']; ?> </td>
					<td> 
						<a href="index.php?del_task=<?php echo $row['id'] ?>">x</a> 
					</td>
				</tr>
			<?php $i++; } ?>	
		</tbody>
	</table>
		</div>
	</div>


</body>
</html>