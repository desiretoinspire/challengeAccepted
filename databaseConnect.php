<?php
	ini_set('display_errors', 1); error_reporting(E_ALL);
	$db = file_get_contents('databaseDetails.ini');
	$db = parse_ini_string($db);
	$dbConnection=new mysqli($db['host'],$db['user'],$db['password'], $db['dbName']);
	if ($dbConnection->connect_error):
	?>
			
		<script type="text/javascript">
			alert('Database Connection Error.');
			location.href = '<?php echo $db['questionMakerPage']?>' ;
		</script>	
	
	<?php
		else: 
	endif;		
?>
