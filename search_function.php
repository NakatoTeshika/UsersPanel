<?php
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