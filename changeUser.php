<?php
require('db.php');
?>
<?php
	$id = $_GET['id'];
	$result = mysqli_query($mysqli,"SELECT * FROM users WHERE id = $id");
	$row = mysqli_fetch_array($result);
	mysqli_query($mysqli,"set names cp1251"); 
?>

<!DOCTYPE html>
<html>
		<link rel="import" href="bootstrap.html">
		<link rel="stylesheet" type="text/css" href="design.css">
<head>
	<title>Изменить данные пользователя</title>
</head>
<body>
<center>
	<h2><br><br>
<br><br><br>		Изменить профиль
	</h2><br>
	<form method = "POST" action = "">
		<table>
		<tr>
		<th><h5>Имя сотрудника</h5></th>
		<th><h5>Фамилия сотрудника</h5></th>
		<th><h5>Отдел сотрудника</h5></th>
		<th><h5>Должность сотрудника</h5></th>
		</tr>
		<tr>
			<td>
				<h5><input name = "user_name" type="text" class="form-control" id="user" size = "25" value="<?php echo $row['name']?>"></h5>
			</td>
			<td>
				<h5><input name = "user_surname" type="text" class="form-control" id="user" size = "25" value="<?php echo $row['surname']?>"></h5>
			</td>
			<td>
				<h5><select name="user_department" value="<?php echo $row['department']?>">
					<option value="<?php echo $row['department']?>"><?php echo $row['department']?></option>
				    <option value="Advertisement">Реклама</option>
				    <option value="Marketing">Маркетинг</option>
				    <option value="Maintenance 1C">Сопровождение 1С</option>
				</select>
			</h5>
			</td>
			<td>
				<h5>
					<select name="user_position" value ="<?php echo $row['position']?>">
					<option value="<?php echo $row['position']?>"><?php echo $row['position']?></option>
				    <option value="Marketer">Маркетолог</option>
				    <option value="Advertiser">Рекламодатель</option>
				    <option value="Developer">Разработчик</option>
					</select>
				</h5>
			</td>
		</tr>
		</table>
		<br>
		<button type="submit" class="btn btn-outline-success"><h5>Сохранить</h5></button>
	</form><br>
	<a href="http://localhost/dashboard/panel/main.php">Главная страница</a>
	<?php
		mysqli_query($mysqli,'set names cp1251');
		if (isset($_POST['user_name']) && isset($_POST['user_surname']) && isset($_POST['user_department']) && isset($_POST['user_position'])){
		$newName = $_POST['user_name'];
		$newSurname = $_POST['user_surname'];
		$newPosition = $_POST['user_position'];
		$newDepartment = $_POST['user_department'];
		$resultOfChange = mysqli_query($mysqli, "UPDATE users SET  name = '$newName', surname = '$newSurname', position = '$newPosition', department = '$newDepartment' WHERE id = $id");
		$resRow = mysqli_fetch_array($result);
		}
		
	?>
</center>
</body>
</html>