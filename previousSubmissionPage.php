<!DOCTYPE html>

<head>
	<title>Previous Submissions</title>
</head>

<body>
<?php
	$db = parse_ini_file('databaseDetails.ini');
	$dbConnection=new mysqli($db['host'],$db['user'],$db['password'], $db['dbName']);
	if ($dbConnection->connect_error): 
		?>
		<script type="text/javascript">
			alert('There is an error with connecting to the database. Please contact your administrator.');
			location.href = '<?php echo db['studentPage.html'] ?>' ;
		</script> 					
		<?php
	else: 
	endif;
	$studentID = "daemondestudent";
	$dbQuery = "SELECT * FROM ".$db['submissionTable']." WHERE ".$db['studentIDColumn']." = '".$studentID."'";
	$result = $dbConnection->query($dbQuery);
?>
	<table id="inputVariableTable" cellpadding = 20>
	<?php   
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
		{
	?>
		<tr>
			<td>
				<p>
					<?php echo $row[$db['studentIDColumn']]?>
				</p>
			</td>
			<td>
				<p>
					<?php echo $row[$db['questionCodeColumn']]?>
				</p>
			</td>
			<td>
				<p>
					<?php echo date("Y-m-d H:i:s", $row[$db['submissionTimeColumn']]);?>
				</p>
			</td>
			<td>
				<button onclick="location.href = 'downloadSubmission.php?questionCode=<?php echo $row[$db['questionCodeColumn']]?>&studentID=<?php echo $studentID?>&submissionTime=<?php echo $row[$db['submissionTimeColumn']]?>'" id="homePageButton" >Download Submission</button>
			</td>
			<td>
				<button onclick="location.href = 'downloadReport.php?questionCode=<?php echo $row[$db['questionCodeColumn']]?>&studentID=<?php echo $studentID?>&submissionTime=<?php echo $row[$db['submissionTimeColumn']]?>'" id="homePageButton" >Download Report</button>
			</td>
		</tr>
	<?php
		}
	?> 
	</table>

	<br/><br/><button onclick="location.href = 'index.html';" id="homePageButton" >Back to Homepage</button>
    
</body>

</html>
