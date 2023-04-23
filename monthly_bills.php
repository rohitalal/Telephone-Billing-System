<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login1.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login1.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Monthly Telephone Bills</title>
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
	<h2>Monthly Telephone Bills</h2>
	<table>
		<thead>
			<tr>
				<th>Customer ID</th>
				<th>Customer Name</th>
				<th>Phone Number</th>
				<th>Plan Name</th>
				<th>Monthly Charges</th>
			</tr>
		</thead>
		<tbody>
			<?php
			//Connect to the database
			

			$conn = mysqli_connect('localhost','root','','telephone_bills_db');

			//Check the connection
			if (!$conn) {
			    die("Connection failed: " . mysqli_connect_error());
			}
           
			//Query the database to get the monthly bills
			$sql = "SELECT * FROM monthly_bills where customer_id='$user_id'";
			$result = mysqli_query($conn, $sql);

			//Display the bills in an HTML table
			if (mysqli_num_rows($result) > 0) {
			    // output data of each row
			    while($row = mysqli_fetch_assoc($result)) {
			        echo "<tr><td>" . $row["customer_id"]. "</td><td>" . $row["customer_name"]. "</td><td>" . $row["phone_number"]. "</td><td>" . $row["plan_name"]. "</td><td>" . $row["monthly_charges"]. "</td></tr>";
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
