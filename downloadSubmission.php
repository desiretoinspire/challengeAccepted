<?php
	$studentID = "daemondestudent";
	$db = parse_ini_file('databaseDetails.ini');
	$dbConnection=new mysqli($db['host'],$db['user'],$db['password'], $db['dbName']);
	if ($dbConnection->connect_error):
?>
		<script type="text/javascript">
			alert('The question you made was not uploaded to the database because the connection wasn\'t established. Please make sure you are authorized to add questions to the database.');
			location.href = '<?php echo db['questionMakerPage'] ?>' ;
		</script> 					
<?php
	else: 
	endif;
			
	$dbQuery = "SELECT * FROM ".$db['submissionTable']."	 WHERE ".$db['questionCodeColumn']." = '".$_GET['questionCode']."' AND ".$db['submissionTimeColumn']." = ".$_GET['submissionTime']." AND ".$db['studentIDColumn']." = '".$_GET['studentID']."'";
	$result = $dbConnection->query($dbQuery);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$fileName = "submission".$studentID.$_GET['questionCode'].$_GET['submissionTime'].".hdl";
	$breaks = array("<br />","<br>","<br/>");
	file_put_contents($fileName, str_ireplace($breaks, "\n", $row['uploadedCode']));
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$fileName");
    header("Content-Type: application/hdl");
    header("Content-Transfer-Encoding: binary");
	readfile($fileName);
	system("rm ".$fileName);
?>
