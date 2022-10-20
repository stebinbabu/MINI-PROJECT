<?php
include("admindashtemp.php");
require_once ('connection.php');
  $sql = "SELECT * from `tbl_staff`";
// --   `rank` WHERE employee.id = rank.eid";

//echo "$sql";
 $result = mysqli_query($conn, $sql);

?>



<html>
<head>
	<title>View Employee </title>
<style>@import url('https://fonts.googleapis.com/css?family=Lobster');
@import url('https://fonts.googleapis.com/css?family=Montserrat:400,700');

body{
	margin: 0px;
}


header h1{
	display: inline;
	font-family: 'Lobster', cursive;
	font-weight: 400;
	font-size: 32px;
	float: left;
	margin-top: 0px;
	margin-right: 10px;
}

nav ul {
	display: inline;
	padding: 0px;
	float: right;
}

nav ul li{
	display: inline-block;
	list-style-type: none;
	color: white;
	float: left;
	margin-left: 12px;
	

}

nav ul li a{
	color: white;
	text-decoration: none;	
}


nav ul ul{
	display: none;
	position: absolute;
}

#navli ul li ul:hovar{
	visibility: visible;
	display: block;
}





#navli{
	font-family: 'Montserrat', sans-serif;
}

.homered{
	background-color: red;
	padding: 30px 10px 22px 10px;
}

/* .divider{
	background-color: red;
	height: 5px;
} */

.homeblack:hover{
	background-color: blue;
	padding: 30px 10px 21px 10px;

}

table {
margin: 0px;
  border-collapse: collapse;
  width: 100%;
  font-family: 'Montserrat', sans-serif;
}

th, td {
  text-align: center;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
tr:hover {background-color:#76D7C4;}

th {
  background-color: #4CAF50;
  color: white;
}
</style>
</head>
<body>
	<header>
	
	</header>
	
	<div class="divider"></div>

		<table>
			<tr>

				<th align = "center">Emp. ID</th>
				<th align = "center">Picture</th>
				<th align = "center">Name</th>
				<!-- <th align = "center">Email</th> -->
				<th align = "center">Date of Birth</th>
				<th align = "center">Gender</th>
				<th align = "center">Contact</th>
				<th align = "center">Department</th>
                <th align = "center">palce</th>
				<th align = "center">House Name</th>
				<th align = "center">pin</th>
				<!-- <th align = "center">Point</th> -->
				
				
				<th align = "center">Options</th>
			</tr>

			<?php
				while ($employee = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$employee['staff_id']."</td>";
					echo "<td><img src=''assets/images/'".$employee['pic']."' height = 60px width = 60px></td>";
					echo "<td>".$employee['firstName']." ".$employee['lastName']."</td>";
					// echo "<td>".$employee['email']."</td>";
					echo "<td>".$employee['dob']."</td>";
					 echo "<td>".$employee['gender']."</td>";
					echo "<td>".$employee['contact']."</td>";
					echo "<td>".$employee['Department']."</td>";
					echo "<td>".$employee['Palce']."</td>";
					echo "<td>".$employee['HouseName']."</td>";
					echo "<td>".$employee['pincode']."</td>";
					// echo "<td>".$employee['points']."</td>";

					echo "<td><a href=\"edit.php?id=$employee[staff_id]\">Edit</a> | <a href=\"delete.php?id=$employee[staff_id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";

				}


			?>

		</table>
		
	
</body>
</html>