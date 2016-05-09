<?php
	include 'databaseConnect.php';
	$dbQuery = "SELECT ".$db['questionCodeColumn']." FROM ".$db['questionTable'];			
	$result = $dbConnection->query($dbQuery);
?>
<!DOCTYPE html>

<head>
	<title>Create Assignment</title>
	<script type="text/javascript" src="index.js"></script> 
</head>

<body>
	<form action="sessionMaker.php" method="POST" enctype="multipart/form-data">
            <h1>Create Session</h1>
			<fieldset class="row1">
                <legend>Time Information</legend>
				<p>
					Session Code
                    <br/><br/><input id="sessionCode" name="sessionCode" type="text" required="required"/>
                </p>
				<p>
					Start Time for Session
                    <br/><br/><input id="startTime" name="startTime" value = "YYYY-MM-DD HH:mm:ss"type="text" required="required"/>
                </p>
				<p><br/>End Time for Session
                   <br/><br/><input id="endTime" name="endTime" value = "YYYY-MM-DD HH:mm:ss" type="text" required="required"/>
                </p>
            </fieldset>
            
            <fieldset class="row2">
				<legend>Question</legend>
				<p> 
					<input type="button" value="Add question" onClick="addRow('questionCodeTable')" /> 
				</p>
               <table id="questionCodeTable">
					<tr>
						<td>
							<select id="questionCode" name="questionCode[]" required="required">
							<?php			
								while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
								{
								?>	<option><?php echo $row[$db['questionCodeColumn']]?></option>
								<?php
								}
							?> 
							</select>
						</td>
						<td>
							<label for="mark">Marks</label>
							<input id="mark" name="mark[]" type="text" required="required">
						</td>
					</tr>
				</table>
            </fieldset>
            
			<input class="submit" type="submit" value="Confirm" />
        </form>
</body>

</html>
