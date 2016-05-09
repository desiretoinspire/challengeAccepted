<!DOCTYPE html>
<html>
    <head>
        <title>Question Maker</title> 
          			
		<?php 
            include 'databaseConnect.php';  
			$uploadOk = 1;
			if(isset($_POST)==true && empty($_POST)==false): 
				$questionCode = $_POST['questionCode'];
				$questionStatement = $_POST['questionStatement'];
				$inputVariable = serialize($_POST['inputVariable']);
				$numberInput = sizeof($_POST['inputVariable']);
				$inputDataType = serialize($_POST['inputDataType']);
				$outputVariable = serialize($_POST['outputVariable']);
				$numberOutput = sizeof($_POST['outputVariable']);
				$outputDataType = serialize($_POST['outputDataType']);
				$testCaseFile = $_FILES['testCaseFile']['tmp_name'];
				$testCaseFileContent = file_get_contents($testCaseFile);
				$questionCreator="daemon";
				$createTime = time();
				$variableDelimiter = "|";
			else: 
				header("Location: index.html");
			endif;
			$dbQuery = "SELECT questionCode FROM ".$db['questionTable']." WHERE ".$db['questionCodeColumn']." = ".$questionCode;
			$result = $dbConnection->query($dbQuery);
			if ($result): ?>
					
				<script type="text/javascript">
					alert('The question you made was not uploaded to the database because there is already a question in the database with the same question code. Please make sure you use a unique question code.');
					location.href = '<?php echo $db['questionMakerPage']?>' ;
				</script>
			
			
			<?php
				else: 
			endif;
			
			$dbQuery = "INSERT INTO ".
			$db['questionTable'].
			"(`".
				$db['questionCodeColumn']."`,`".
				$db['questionStatementColumn']."`,`".
				$db['numberInputColumn']."`,`".
				$db['inputVariableColumn']."`,`".
				$db['inputVariableTypeColumn']."`,`".
				$db['numberOutputColumn']."`,`".
				$db['outputVariableColumn']."`,`".
				$db['outputVariableTypeColumn']."`,`".
				$db['questionCreatorColumn']."`,`".
				$db['createTimeColumn'].
			"`) 
				VALUES 
			('".
				$questionCode."','".
				$questionStatement."',".
				$numberInput.",'".
				$inputVariable."','".
				$inputDataType."',".
				$numberOutput.",'".
				$outputVariable."','".
				$outputDataType."','".
				$questionCreator."',".
				$createTime.
			")";
			$dbConnection->query($dbQuery);
			$dbQuery = "SELECT questionCode FROM ".$db['questionTable']." WHERE ".$db['questionCodeColumn']." = '".$questionCode."'";
			$result = $dbConnection->query($dbQuery);
			if ($result->num_rows == 0):
			?>
				<script type="text/javascript">
					alert('The question you made was not uploaded to the database because of an unknown error.');
					location.href = '<?php echo $db['questionMakerPage']?>' ;
				</script>
			<?php
				else:
			endif;
			
			$testCaseArray = explode("\n",$testCaseFileContent); //contains the test cases as unformatted strings.
			$numberTestCase = count($testCaseArray);
			$testCase = array();
			for ($x = 1; $x < $numberTestCase - 1; $x++)
			{
				$temp = explode($variableDelimiter, $testCaseArray[$x]); //here we use x - 1 because the first row of the .cmp file contains the variable names. Note to remove it when this isn't the case.
				array_pop($temp); //because the test case string starts with | and ends with | resulting in an additional variable
				array_shift($temp); //because the test case string starts with | and ends with | resulting in an additional variable
				array_push($testCase, $temp);
				?> <br/> <?php
			}
			for ($x = 0; $x < count($testCase); $x++)
			{
				$inputData = serialize(array_slice($testCase[$x],0,$numberInput));
				$outputData = serialize(array_slice($testCase[$x],$numberInput, $numberOutput));
				$dbQuery = "INSERT INTO ".
				$db['testCaseTable'].
				"(`".
					$db['questionCodeColumn']."`,`".
					$db['testCaseNumberColumn']."`,`".
					$db['inputDataColumn']."`,`".
					$db['outputDataColumn']."`".
				") 
					VALUES 
				('".
					$questionCode."',".
					$x.",'".
					$inputData."','".
					$outputData."'".
				")";
				echo $dbQuery ?><br/><?php
				$dbConnection->query($dbQuery);
				}
			?>
				
	<br/><br/><button onclick="location.href = 'instructorPage.html';" id="instructorPageButton" >Back to Instructor Page</button>			
    </head>
</html>
