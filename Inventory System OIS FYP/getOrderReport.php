<?php 

include 'config.php';

if($_POST) {


	$start = date("Y-m-d", strtotime($_POST['startDate']));



	$end = date("Y-m-d", strtotime($_POST['endDate']));



	$sql = mysqli_query($conn, "SELECT * FROM request WHERE (request.Date_Field BETWEEN '$start' AND '$end') AND request.Status='completed' ORDER BY Date_Field ASC;") or die('query failed');


	$table = '

	 

	<script>
	//Print Page
	window.onload = printPage();
	function printPage () {
	window.print();
	}
	</script>

	<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
		<tr>
			<th>Order Date</th>
			<th>Staff Name</th>
			<th>Request</th>
			<th>Authorizer</th>
		
		</tr>

		<tr>';

		
		while ($result = mysqli_fetch_assoc($sql)) {
			$table .= '<tr>
				<td><center>'.$result['Date_Field'].'</center></td>
				<td><center>'.$result['Name'].'</center></td>
				<td><center>'.$result['Request'].'</center></td>
				<td><center>'.$result['Authorizer'].'</center></td>
			</tr>';	
			
		
		}

		$table .= '
		</tr>

		<tr>

		</tr>
	</table>
	';	

	echo $table;
	
}

?>