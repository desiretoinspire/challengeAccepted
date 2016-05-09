<?php
	include 'databaseConnect.php';
	$uploadOk = 1;
	$currentTime = time(); 
	#finding the ongoing sessions
	$dbQuery = "SELECT * FROM ".$db['sessionTable']." WHERE ".$db['sessionStartColumn']." < ".$currentTime." AND ".$db['sessionStopColumn']." > ".$currentTime;
	$result = $dbConnection->query($dbQuery);
	if ($result->num_rows == 0)
			header("Location: resultPage.php");
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);		 
	$sessionCode = ($row[$db['sessionCodeColumn']]);
	$questionCode = unserialize($row[$db['sessionQuestionCodeColumn']]);
	$questionMarks = unserialize($row[$db['sessionQuestionMarksColumn']]);
	$sessionStart = $row[$db['sessionStartColumn']];
	$sessionStop = $row[$db['sessionStopColumn']];
	?>
	<form action="questionMaker.php" method="POST" enctype="multipart/form-data">
	<?php
	for ($i=0 ; $i<sizeof($questionCode) ;$i++)
	{
		 ?>
		 <table cellpadding=5 border=1 width=200>
			 <tr>
				 <td width = 75>
					 <p><?php echo $questionCode[$i]; ?></p>
				 </td><br/>
				 <td>
					 <p><?php echo $questionMarks[$i]; ?></p>
				 </td>
			 </tr>
		 </table>
		 
		 <?php
	}
	?> 
	</form>
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Assignment Page</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.24.1" />
</head>

<body>
	
</body>

</html>
