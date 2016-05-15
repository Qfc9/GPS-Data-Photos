<?php
$exif = exif_read_data('test1.jpg', 0, true);
echo "<h2>Image Metadata:<br /></h2>";
//Prints all the Metadata
print_r($exif);

//Parses Metadata for key things
foreach ($exif as $key => $section) {
    foreach ($section as $name => $val) {

		//Get Longitude Direction
		if($name == 'GPSLongitudeRef'){
			$longRef = $val;
		}
		
		//Get Latitude Direction
		if($name == 'GPSLatitudeRef'){
			$latRef = $val;
		}
		
		//Get Longitude 
		if($name == 'GPSLongitude'){
			$long = $val;
		}
		
		//Get Latitude
		if($name == 'GPSLatitude'){
			$lat = $val;
		}
    }
}

//Translation Math
$latDegree = eval('return '.$lat[0].';');
$latMinute = eval('return '.$lat[1].';')/60;
$latSecond = eval('return '.$lat[2].';')/3600;

if(strtolower($latRef) == "n"){
	$latDirection = 1;
}
else{
	$latDirection = -1;
}

//Finishing Up the Coordinates
$latCoor = $latDirection*($latDegree+$latMinute+$latSecond);


//Translation Math
$longDegree = eval('return '.$long[0].';');
$longMinute = eval('return '.$long[1].';')/60;
$longSecond = eval('return '.$long[2].';')/3600;

if(strtolower($longRef) == "e"){
	$longDirection = 1;
}
else{
	$longDirection = -1;
}

//Finishing Up the Coordinates
$longCoor = $longDirection*($longDegree+$longMinute+$longSecond);

?>


<h2>
	Latitude: <?php echo $latCoor; ?>
</h2>
<h2>
	Longitude: <?php echo $longCoor; ?>
</h2>












