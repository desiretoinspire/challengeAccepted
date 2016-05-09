<!DOCTYPE html>
<html>
<head>
	<title>Practice Session</title>
</head>
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
	$dbQuery = "SELECT ".$db['questionCodeColumn']." FROM ".$db['questionTable'];			
	$result = $dbConnection->query($dbQuery);
	
?>

        <form action="practiceSectionEvaluator.php" method="POST" enctype="multipart/form-data">
            
			<label for="questionCode">Choose the question you'd like to attempt<br/></label>
			<select id="questionCode" name="questionCode" required="required">
			<?php			
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
			{
			?>	<option><?php echo $row[$db['questionCodeColumn']]?></option>
			<?php
			}
			?> 
			</select>
            <input type="file" accept=".hdl" name="codeFile" id="codeFile" required="required"/>
            <input class="submit" type="submit" value="Confirm" />
        </form>


<body>
	<br/><br/><button onclick="location.href = 'index.html';" id="homePageButton" >Back to Homepage</button>
</body>
</html>
