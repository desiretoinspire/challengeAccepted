<!DOCTYPE html>
<html>

<head>
	<title>Practice Section Evaluator</title>
	<?php
	$report = "";
	$defaultWidth = 10;
	$uploadOk = 1;
	$uploadsDirectory = 'uploads/';
	if(isset($_POST)==true && empty($_POST)==false): 
		$studentID="daemondestudent";
		$questionCode = $_POST['questionCode'];
		$submissionTime = time();
		$uploadedCode = file_get_contents($_FILES['codeFile']['tmp_name']);
		$fileType = "hdl";
		$fileName = $questionCode.".".$fileType;
		$tmpCodeFile = $_FILES['codeFile']['tmp_name'];
		move_uploaded_file($tmpCodeFile, "$uploadsDirectory/$fileName");
	else: 
		header("Location: index.html");
	endif;
	
	$db = parse_ini_file('databaseDetails.ini');
	$dbConnection=new mysqli($db['host'],$db['user'],$db['password'], $db['dbName']);
	$hardwareSimulatorPath = $db['hardwareSimulatorPath'];
	if ($dbConnection->connect_error): 
		?>
		<script type="text/javascript">
			alert('There is an error with connecting to the database. Please contact your administrator.');
			location.href = '<?php echo db['practiceSectionPage.html'] ?>' ;
		</script> 					
		<?php
	else: 
	endif;
	
	$testCaseQuery = "SELECT * FROM ".$db['testCaseTable']." WHERE ".$db['questionCodeColumn']." = '".$questionCode."'";
	$testCaseResult = $dbConnection->query($testCaseQuery);
	$variableDataQuery = "SELECT * FROM ".$db['questionTable']." WHERE ".$db['questionCodeColumn']." = '".$questionCode."'";
	
	while ($row = mysqli_fetch_array($testCaseResult, MYSQLI_ASSOC)) 
	{
		$testCaseFile = $uploadsDirectory.$questionCode.".cmp";
		$testCaseFileHandle = fopen($testCaseFile, 'w');
		
		$variableDataResult = $dbConnection->query($variableDataQuery);
		$variableData = mysqli_fetch_array($variableDataResult, MYSQLI_ASSOC);
		$inputVariable = unserialize($variableData[$db['inputVariableColumn']]);
		$outputVariable = unserialize($variableData[$db['outputVariableColumn']]);
		
		$inputVariableType = unserialize($variableData[$db['inputVariableTypeColumn']]);
		$outputVariableType = unserialize($variableData[$db['outputVariableTypeColumn']]);
	
		$inputData = unserialize($row[$db['inputDataColumn']]);
		$outputData = unserialize($row[$db['outputDataColumn']]);
		
		
		fwrite($testCaseFileHandle, "|");
		
		$inputDataLength = strlen(trim($inputData[0]));
		$outputDataLength = strlen(trim($outputData[0]));
		foreach ($inputVariable as $x)
		{	
			$x = trim($x);
			$inputVariableLength = strlen($x);
			if (($inputDataLength + $defaultWidth) % 2 == 0)
				$numberSpaces = ($inputDataLength + $defaultWidth - $inputVariableLength)/2 - 1;
			else $numberSpaces = ($inputDataLength + $defaultWidth - $inputVariableLength)/2;
			for ($i = 0;$i < $numberSpaces;$i++)
				fwrite($testCaseFileHandle, " ");
			fwrite($testCaseFileHandle, $x);
			for ($i = 0;$i < ($inputDataLength + $defaultWidth - $inputVariableLength)/2;$i++)
				fwrite($testCaseFileHandle, " ");
			fwrite($testCaseFileHandle, "|");
		}
		
		
		foreach ($outputVariable as $x)
		{
			$x = trim($x);
			$outputVariableLength = strlen($x);
			if (($outputDataLength + $defaultWidth) % 2 == 0)
				$numberSpaces = ($outputDataLength + $defaultWidth - $outputVariableLength)/2 - 1;
			else $numberSpaces = ($outputDataLength + $defaultWidth - $outputVariableLength)/2;
			for ($i = 0;$i < $numberSpaces;$i++)
				fwrite($testCaseFileHandle, " ");
			fwrite($testCaseFileHandle, $x);
			for ($i = 0;$i < ($outputDataLength + $defaultWidth - $outputVariableLength)/2;$i++)
				fwrite($testCaseFileHandle, " ");
		}
		fwrite($testCaseFileHandle, "|\n|");
		
		foreach ($inputData as $x)
		{
			$x = trim($x);
			fwrite($testCaseFileHandle, "     ");
			fwrite($testCaseFileHandle, $x);
			fwrite($testCaseFileHandle, "     |");
		}
		foreach ($outputData as $x)
		{
			$x = trim($x);
			fwrite($testCaseFileHandle, "     ");
			fwrite($testCaseFileHandle, $x);
			fwrite($testCaseFileHandle, "     |");
		}
		fclose($testCaseFileHandle);
		
		
		$testScript = $uploadsDirectory.$questionCode.".tst";
		$testScriptHandle = fopen($testScript, 'w');
		$outputFile = $uploadsDirectory.$questionCode.".out";
		
		fwrite($testScriptHandle, "load ".$questionCode.".hdl".",\n");
		fwrite($testScriptHandle, "output-file ".$questionCode.".out".",\n");
		fwrite($testScriptHandle, "compare-to ".$questionCode.".cmp".",\n");
		fwrite($testScriptHandle, "output-list ");
		
		
		for ($i=0;$i<sizeof($inputVariableType); $i++)
		{
			fwrite($testScriptHandle, $inputVariable[$i]."%");
			fwrite($testScriptHandle, strtoupper($inputVariableType[$i])[0]);
			fwrite($testScriptHandle, "5.".strlen(trim($inputData[$i])).".5 ");
		}
		
		for ($i=0;$i<sizeof($outputVariableType); $i++)
		{
			fwrite($testScriptHandle, $outputVariable[$i]."%");
			fwrite($testScriptHandle, strtoupper($outputVariableType[$i])[0]);
			fwrite($testScriptHandle, "5.".strlen(trim($outputData[$i])).".5 ");
		}
		
		fwrite($testScriptHandle, ";\n\n");
		
		for ($i=0;$i<sizeof($inputVariable); $i++)
		{
			fwrite($testScriptHandle, "set ".$inputVariable[$i]." ");
			fwrite($testScriptHandle, "%");
			fwrite($testScriptHandle, strtoupper($inputVariableType[$i])[0]);
			fwrite($testScriptHandle, trim($inputData[$i]).",\n");
		}
		fwrite($testScriptHandle, "eval,\n");
		fwrite($testScriptHandle, "output;\n\n");
		
		fclose($testScriptHandle);
		$retval = exec($hardwareSimulatorPath." ".$testScript);
		
		if ($retval) 
		{
			$report = $report."TestCase #".$row[$db['testCaseNumberColumn']]." Output correct\n";
		}
		else 
		{
			$report = $report."TestCase #".$row[$db['testCaseNumberColumn']]." Output incorrect\n";
		}
	}
	$retval = exec("rm ".$uploadsDirectory."*");
	print(nl2br($report));
	$dbQuery = "INSERT INTO ".
	$db['submissionTable'].
	"(`".
		$db['studentIDColumn']."`,`".
		$db['questionCodeColumn']."`,`".
		$db['submissionTimeColumn']."`,`".
		$db['uploadedCodeColumn']."`,`".
		$db['resultColumn'].
	"`) 
		VALUES 
	('".
		$studentID."','".
		$questionCode."',".
		$submissionTime.",'".
		$uploadedCode."','".
		$report.
	"')";
	$result = $dbConnection->query($dbQuery);
	
?>
</head>

<body>
	<br/><br/><button onclick="location.href = 'index.html';" id="homePageButton" >Back to Homepage</button>
</body>

</html>
