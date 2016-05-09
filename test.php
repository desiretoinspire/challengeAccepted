<?php
	$date = '2016-07-06 5:1:2';
	$date2 = '2016-12-06 23:2:2';
	$date = strtotime($date);
	$date2 = strtotime($date2);
	$date = $date2 - $date;
	echo date('m-d H:i:s', $date);
?>
