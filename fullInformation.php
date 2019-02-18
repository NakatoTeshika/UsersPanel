<?php
	require('db.php');
?>
<!DOCTYPE html>
<html>
		<link rel="import" href="bootstrap.html">
		<link rel="stylesheet" type="text/css" href="block.css">
		<link rel="stylesheet" type="text/css" href="design.css">
<head>
	<title>Полная информация</title>
</head>
<body>
	<center>
		<?php
			mysqli_query($mysqli,'set names cp1251');
			$id = $_GET['id'];
			$result = mysqli_query($mysqli, "SELECT * FROM users WHERE id = $id");
			$row = mysqli_fetch_array($result);

		?>
		<br>
		<h2>Информация о <?php echo $row['surname'] ?> <?php echo $row['name'] ?></h2><br>
	</center>
	
	<center>
		<img src="photoes/<?php echo $row['photo']; ?>" width = "200" height = "250">
	</center>
		<br>
	<table class="table table-striped table-dark">
		<tr>
			<th>Фамилия сотрудника</th>
			<th>Имя сотрудника</th>
			<th>Дата прихода</th>
			<th>Отдел</th>
			<th>Должность</th>
			<th>Изменить данные</th>
		</tr>
		<tr>
			<td > <?php echo $row['surname'] ?> </td>
			<td> <?php echo $row['name'] ?></td>
			<td><?php echo $row['date']?></td>
			<td><?php echo $row['department']?></td>
			<td><?php echo $row['position']?></td>
			<form method="post"><td><a href="changeUser.php?id=<?php echo $row['id']?>">Изменить</a></td></form>
			</tr>
	
	</table><br>
	<center>
		<form method="post">
		<input type="button" class="btn btn-success" value="+ Добавить новое задание" onClick='location.href="newMission.php?id=<?php echo $row['id']?>"'>
		</form>
	
		<?php
			$mission = mysqli_query($mysqli, "SELECT * FROM mission mis INNER JOIN users us ON mis.user_id = us.id WHERE id = $id");
			while($row = mysqli_fetch_array($mission))
			{?>
				<div class="block">
				<p><?php echo $row['title']; ?></p> 
				<p><?php echo $row['mission']; ?></p> 
				</div>
			<?php
		}
		?>

	</center>
	

</body>
</html>
