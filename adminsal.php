<?php

include 'adminconfig.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:adminlogin.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:adminlogin.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Monthly Salary of Employee</title>
	<style>
		table {
			border-collapse: collapse;
			width: 100%;
		}

		th, td {
			text-align: left;
			padding: 8px;
			border-bottom: 1px solid #ddd;
		}

		th {
			background-color: #4CAF50;
			color: white;
		}
	</style>
</head>
<body>
	<h2>Monthly Salary of Employee</h2>
	<table>
		<thead>
			<tr>
				<th>Employee ID</th>
				<th>Employee Name</th>
				<th>Phone Number</th>
				<th>Department Name</th>
				<th>Salary</th>
			</tr>
		</thead>
		<tbody>
			<?php
			//Connect to the database
			

			$conn = mysqli_connect('localhost','root','','admin_db');

			//Check the connection
			if (!$conn) {
			    die("Connection failed: " . mysqli_connect_error());
			}
           
			//Query the database to get the monthly bills
			$sql = "SELECT * FROM admin_sal where emp_id='$user_id'";
			$result = mysqli_query($conn, $sql);

			//Display the bills in an HTML table
			if (mysqli_num_rows($result) > 0) {
			    // output data of each row
			    while($row = mysqli_fetch_assoc($result)) {
			        echo "<tr><td>" . $row["emp_id"]. "</td><td>" . $row["emp_name"]. "</td><td>" . $row["phone_number"]. "</td><td>" . $row["dept_name"]. "</td><td>" . $row["salary"]. "</td></tr>";
			    }
			} else {
			    echo "0 results";
			}

			mysqli_close($conn);
			?>
		</tbody>
	</table>
</body>
</html>
