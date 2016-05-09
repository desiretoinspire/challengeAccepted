<!DOCTYPE html>
<html>
    <head>
        <title>Session Maker</title> 
          			
		<?php 
			include 'databaseConnect.php';  
			if(isset($_POST)==true && empty($_POST)==false): 
				$sessionCode = ($_POST['sessionCode']);
				$questionCode = serialize($_POST['questionCode']);
				$questionMark = serialize($_POST['mark']);
				$sessionStart = strtotime($_POST['startTime']);
				$sessionStop = strtotime($_POST['endTime']);
			else: 
				header("Location: ".$db['homePage']);
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
