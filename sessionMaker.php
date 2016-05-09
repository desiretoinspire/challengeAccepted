<!DOCTYPE html>
<html>
    <head>
        <title>Session Maker</title> 
          			
		<?php 
              
			if(isset($_POST)==true && empty($_POST)==false): 
				$sessionCode = ($_POST['sessionCode']);
				$questionCode = serialize($_POST['questionCode']);
				$questionMark = serialize($_POST['mark']);
				$sessionStart = strtotime($_POST['startTime']);
				$sessionStop = strtotime($_POST['endTime']);
			else: 
				header("Location: index.html");
			endif;
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
			
			$dbQuery = "INSERT INTO ".
			$db['sessionTable'].
			"(`".
				$db['sessionCodeColumn']."`,`".
				$db['sessionStartColumn']."`,`".
				$db['sessionStopColumn']."`,`".
				$db['sessionQuestionCodeColumn']."`,`".
				$db['sessionQuestionMarksColumn'].
			"`) 
				VALUES 
			('".
				$sessionCode."',".
				$sessionStart.",".
				$sessionStop.",'".
				$questionCode."','".
				$questionMark.
			"')";
			echo nl2br("Session Created Successfully\n");
			$dbConnection->query($dbQuery);
?>				
	<br/><br/><button onclick="location.href = 'instructorPage.html';" id="instructorPageButton" >Back to Instructor Page</button>
    </head>
</html>
