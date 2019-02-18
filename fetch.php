<?php
//fetch.php
		$connect = mysqli_connect("localhost", "root", "", "testing1");
		$column = array("users.surname", "users.name", "users.department", "product.price");
		$query = "
		 SELECT * FROM users
		";
		$query .= " WHERE ";
		if(isset($_POST["is_category"]))
		{
		 $query .= "users.department LIKE'".$_POST["is_category"]."' AND ";
		}

		$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

		$result = mysqli_query($connect, $query . $query1);

		$data = array();

		while($row = mysqli_fetch_array($result))
		{
		 $sub_array = array();
		 $sub_array[] = $row["name"];
		 $sub_array[] = $row["surname"];
		 $sub_array[] = $row["department"];
		 $sub_array[] = $row["position"];
		 $data[] = $sub_array;
		}

		function get_all_data($connect)
		{
		 $query = "SELECT * FROM users";
		 $result = mysqli_query($connect, $query);
		 return mysqli_num_rows($result);
		}

		$output = array(
		 "draw"    => intval($_POST["draw"]),
		 "recordsTotal"  =>  get_all_data($connect),
		 "recordsFiltered" => $number_filter_row,
		 "data"    => $data
		);

		echo json_encode($output);

?>
