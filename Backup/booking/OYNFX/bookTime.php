<?php
/*  NOTER:
I php svarer ' til " i SQL. Ingenting svarer til � i SQL.
*/

mysql_connect("mysqlsuper1.webhosting.dk","mysqluser17282","apvhxfhk");
mysql_select_db("mysqluser17282");

$year = $_POST["year"];
$month = $_POST["month"];
$date = $_POST["date"];
$time = $_POST["time"];
$info = $_POST["info"];

$send = "succes=true";


$query = "
	SELECT year, ". $time ." FROM booking_OYNFX
	WHERE year = ". $year ." AND month = ". $month ." AND date = ". $date .";
";

$qr = mysql_query($query);
$row = mysql_fetch_array($qr);


// Hvis datoen ikke er oprettet (year er tom):
if (strcmp($row[0], "")==0) {
	// Ny dato oprettes og bookede tid inds�ttes.
	$query = "
		INSERT INTO booking_OYNFX(year, month, date, ". $time .")
		VALUES (". $year .",". $month .",". $date .",'". $info ."');
	";
	$qr = mysql_query($query);
}
// Ellers er datoen oprettet, og hvis tiden ikke er besat (tiden er tom):
else if (strcmp($row[1], "")==0){
	$query = "
		UPDATE booking_OYNFX
		SET ". $time ." = '". $info ."'
		WHERE year = ". $year ." AND month = ". $month ." AND date = ". $date .";
	";
	$qr = mysql_query($query);
}
// Ellers er datoen oprettet men tiden er besat:
else {
	$send = "succes=false";
}

echo $send."&";
?>