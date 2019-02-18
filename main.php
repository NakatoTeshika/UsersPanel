<html>
<head>
<!-- подключение css-файла -->
		<link rel="import" href="bootstrap.html">
		<link rel="stylesheet" type="text/css" href="design.css">
<title>Отправить данные</title>
</head>
<body>
	<center>
		<h2 class="back">Форма для отправки данных</h2><br>
		<form method="post" action="main.php" enctype="multipart/form-data">
		  
		    <div class="col">
		     <h5><input name = "user_name" type="text" class="form-control" id="user" size = "25" placeholder="Имя"></h5><br>
		    </div>
		    <div class="col">
		     <h5> <input name = "user_surname" type="text" class="form-control" id = "user" size="25" placeholder="Фамилия"></h5>
			 </div>
			 <div class="col">
			 	<input type="hidden" name="size" value="1000000">
			 	<h5><input type="file" name="user_photo" id="user" size="25" placeholder="Файл"></h5>
			 </div>
			 <div class="col">
			 	<h5>Дата прихода</h5>
			 	<h5><input type = "text" name="user_comedate" id="datetimepicker" size="20" placeholder="____/__/__ --:--" readonly /></h5>
			 </div>
				<script src="jquery.js"></script>
				<script src="jquery.datetimepicker.full.js"></script>
				<script src="jquery.datetimepicker.min.js"></script>
			 	<script> 
					$("#datetimepicker").datetimepicker();
			 	</script>
		     <label><h5>Выберите отдел:</h5> </label>
		     
			  	<select name="user_department">
				    <option value="Advertisement">Реклама</option>
				    <option value="Marketing">Маркетинг</option>
				    <option value="Maintenance 1C">Сопровождение 1С</option>
				</select><br><br>
			<label><h5>Выберите должность:</h5> </label>
		     
			  	<select name="user_position">
				    <option value="Marketer">Маркетолог</option>
				    <option value="Advertiser">Рекламодатель</option>
				    <option value="Developer">Разработчик</option>
				</select>
			<br><button type="submit" class="btn btn-outline-success" name = "upload"><h5>Отправить</h5></button>
		</form>
		<a href="http://localhost/dashboard/panel/users.php">Список пользователей</a>
	</center>
	<?php
	require('db.php');
	// ini_set('display_errors',1);
	// error_reporting(E_ALL);
	if (isset($_POST['upload'])){
		$msg = "";
		$name = $_POST['user_name'];
		$surname = $_POST['user_surname'];
		// $photo = $_FILES['user_photo'];
		$date = $_POST['user_comedate'];
		$position = $_POST['user_position'];
		$department = $_POST['user_department'];
		$image = $_FILES['user_photo']['name'];
		$target = "photoes/".basename($image);
		//var_dump($image);
		if ($mysqli->connect_error) {
		    die('Ошибка : ('. $mysqli->connect_errno .') '. $mysqli->connect_error); 
		}

		mysqli_query($mysqli,'set names cp1251');
		$result = $mysqli->query("INSERT INTO ".$db_table." (name, surname, date, photo,position, department, pos_id) VALUES ('$name','$surname', '$date','$image','$position','$department','1')");
			if (move_uploaded_file($_FILES['user_photo']['tmp_name'], $target)) {
		  		$msg = "Image uploaded successfully";
		  	}else{
		  		$msg = "Failed to upload image";
  	}
		mysqli_close($mysqli); 
	}
	?>
	
	<!-- <?php if ($result == true): ?>
	 <center> 
	 	<h5>
	 		Добавлен новый пользователь, <?php echo "{$name} {$surname}" ?>
	 	</h5>
	 	<a href="http://localhost/dashboard/panel/users.php">Список пользователей</a></center>
	<?php else: ?>
	  <center><h2>Не записано, но вы можете посмотреть список всех пользователей</h2>
	  	<a href="http://localhost/dashboard/panel/users.php">Список пользователей</a></center>
	<?php endif; ?> -->

</body>
</html>