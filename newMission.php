<!DOCTYPE html>
<html>
		<link rel="import" href="bootstrap.html">
		<link rel="stylesheet" type="text/css" href="design.css">
		<center>
		<head>
			<title>Постановка задачи</title>
		</head>
<body>
	<center>
	<div class="form-group col-lg-6">
	<form method="post" action="">
		<h2>Задание для сотрудника</h2>
		<br><input class="form-control" type="text" name="title" placeholder="Заголовок задания"><br>
	    <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" name = "text" placeholder="Задание"></textarea><br>
	    <button type="submit" class="btn btn-outline-success" name = "give"><h5>Дать задание</h5></button>
	</form>
	</div>
	</center>
</body>
</html>
<?php
	require('db.php');
	$id = $_GET['id'];
	$result_zero = mysqli_query($mysqli, "SELECT * FROM users WHERE id = $id");
	$row = mysqli_fetch_array($result_zero);
	mysqli_query($mysqli,"set names cp1251");

	if(isset($_POST['give']))
	{
		$title = $_POST['title'];
		$text = $_POST['text'];
		$result = mysqli_query($mysqli, "INSERT INTO mission (title, mission, user_id) VALUES ('$title','$text', '$id')");
	}
?>