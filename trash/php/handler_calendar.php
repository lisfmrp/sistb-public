<?
if($_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest'){
	$month = intval($_POST['month']);
	$year = intval($_POST['year']);
	if($month==0){
		$month = 12;
		$year = $year -1;
	}
	if($month<10) $month = "0".$month;
	$days = array();
	
	// For example, at the moment the script generates random days with events
	for($i=0;$i<mt_rand(2,30);$i++) $days[] = mt_rand(1,28);
	
	
	$days = array_unique($days);
	sort($days);
	for($i=0;$i<count($days);$i++){
		if($days[$i]<10) $days[$i] = "0".$days[$i];
		else settype($days[$i], "string");
	}
	$return = array("days" => $days, "year" => $year, "month" => $month);
	echo json_encode($return);
}
?>