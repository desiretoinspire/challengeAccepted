<?php
	include 'databaseConnect.php';
	$studentID = "daemondestudent";
			
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
