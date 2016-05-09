<?php
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
			
?>
<head>
	<title>untitled</title>
</head>

<body>
	
</body>

</html>
