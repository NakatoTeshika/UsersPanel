<?php
	require('db.php');
		mysqli_query($mysqli,'set names cp1251');
		if(isset($_REQUEST["submit"]))
		{
			$check = $_REQUEST["check"];
			$a = implode(",", $check);
			mysqli_query($mysqli, "DELETE FROM $db_table WHERE id in ($a)");
		}	
		// $mainResult->query("SELECT * FROM $db_table");
?>
<!DOCTYPE html>
<html>
		<link rel="import" href="bootstrap.html">
		<link rel="stylesheet" type="text/css" href="design.css">
<head>
	<style type="text/css">
		.Default
        {
            font-family:Pacifico;
            color: #F0F8FF;
          
        } 
		.Default2
        {
            font-family:Pacifico;
            font-size:20px;
            color:#C0C0C0;
            background: #5F9EA0;
            cursor: hand;
       } 
	</style>
	<title>
		Список пользователей
	</title>
</head>
<body>
	 <center>
	 	<br>
	 	<form name="search" method="post" action="">
		    <input type="search" name="query" placeholder="Поиск">
		    <button type="submit" class="btn btn-outline-primary">Найти</button> 
		</form>
	    <div>
	    	<?php

require('db.php');

mysqli_query($mysqli, 'set names cp1251');

function search ($query) 
{ 
     $db_host = 'localhost';
     $db_user = 'root';
     $db_password = '';
     $db_base = 'test_php';
     $db_table = 'users';
    $mysqli = new mysqli($db_host,$db_user,$db_password, $db_base);
    $query = trim($query); 
    $query = mysqli_real_escape_string($mysqli, $query);
    $query = htmlspecialchars($query);

    if (!empty($query)) 
    { 
        if (strlen($query) < 3) {
            $text = '<p>Слишком короткий поисковый запрос.</p>';
        } else if (strlen($query) > 128) {
            $text = '<p>Слишком длинный поисковый запрос.</p>';
        } else { 
            $q = "SELECT *
                  FROM $db_table WHERE name LIKE '%$query%'
                  OR surname LIKE '%$query%'";

            $result = mysqli_query($mysqli,$q);

            if (mysqli_affected_rows($mysqli) > 0) { 
                $row = mysqli_fetch_assoc( $result); 
                $num = mysqli_num_rows($result);

                $text = '<p>По запросу <b>'.$query.'</b> найдено совпадений: '.$num.'</p>';
                while($row = mysqli_fetch_array($result))
                {
                	$text .= '<p><a href = "fullInformation.php?id= '. $row["id"] .' " > '.$row['surname'].' '.$row['name'].' </a></p>';
                }
                do {
                    // $row = mysqli_fetch_assoc( $result);
                    // $id = $row['id'];
                    $result1 = mysqli_query($mysqli, "SELECT *
                  FROM `users` WHERE `name` LIKE '%$query%'
                  OR `surname` LIKE '%$query%'");
                    if (mysqli_affected_rows($mysqli) > 0) {
                        $row1 = mysqli_fetch_assoc($result1);
                    }

                    $text .= '<p><a href = "fullInformation.php?id= '. $row1["id"] .' " > '.$row1['surname'].' '.$row1['name'].' </a></p>';

                } while ($row = mysqli_fetch_assoc($result)); 

            } else {
                $text = '<p>По вашему запросу ничего не найдено.</p>';
            }
        } 
    } else {
        $text = '<p>Задан пустой поисковый запрос.</p>';
    }
    return $text; 
} 
?>
<?php 
if (!empty($_POST['query'])) { 
    $search_result = search ($_POST['query']); 
    echo $search_result; 
}
?>

	    </div>

	 	<h2>	
			<br>Список сотрудников<br><br>
		</h2>
	</center>
	<!-- <div>
		<a href="#" class="department"></a>
		<a href="#" class="department_marketing">Маркетинг</a>
		<a href="#" class="department_adverts">Реклама</a>
		<a href="#" class="department_maintence">Сопровождение1С</a>
	</div><br>
	<div>
		<a href="#" class="position"></a>
		<a href="#" class="position_developer">Разработчик</a>
		<a href="#" class="position_marketer">Маркетолог</a>
		<a href="#" class="position_advertiser">Рекламодатель</a>

	</div> -->
	<form method = "post">
	<table id = "users_data" class="table table-striped table-dark">
		<tr>
			<th>Фамилия пользователя</th>
			<th>Имя пользователя</th>
			<th>Подробная информация</th>
			<th><button type="submit" class="btn btn-outline-danger" value = "submit" name = "submit">Уволить</button>  </th>
		</tr>
		<?php
		$result = mysqli_query($mysqli,"SELECT * FROM $db_table");
		while ($row = mysqli_fetch_array($result)) {
		?>
			<tr class = "Default" onMouseOver="className='Default2'" onMouseOut="className='Default'">
			<td > <?php echo $row['surname'] ?> </td>
			<td> <?php echo $row['name'] ?></td>
			<td><a href="fullInformation.php?id=<?php echo $row['id'] ?>">Подробно</a></td>
			<td>
				<input type = "checkbox" name = "check[]" value="<?php echo $row['id'] ?>">
			</td>
			</tr>
			<?php
			}
		?>
	</table>
</form>
</body>
</html>

