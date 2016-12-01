<?php
header('Content-type: application/json');
$data= $_POST['data'];
$decoded = json_encode($data);
//$json =  '{"longitude":"90","latitude":"30","length":"10","Probs":[["0","0","0","0","0","0","0","0","0","0"],["0","0","0","0","0","0","0","0","0","0"],["0","0","0","0","0","0","0","0","0","0"],["0","0.01762114537444934","0.013215859030837005","0","0","0","0","0","0","0"],["0","0","0.00881057268722467","0","0","0","0.004405286343612335","0","0","0.9559471365638766"],["0","0","0","0","0","0","0","0","0","0"],["0","0","0","0","0","0","0","0","0","0"],["0","0","0","0","0","0","0","0","0","0"],["0","0","0","0","0","0","0","0","0","0"],["0","0","0","0","0","0","0","0","0","0"]]}';
//var_dump(json_decode($json));
$vals = json_decode($decoded, true);

echo $vals["longitude"];
echo $vals["latitude"];
$len = $vals["length"] ;
echo $vals["Probs"][0][0];


$file = __DIR__ . "/Parsed/Lat".$vals["longitude"]."Long".$vals["latitude"].".csv";
//echo $file;
 fopen($file, "w") or die("Unable to open file!");
 chmod($file, 0777);
for ($x=0; $x<$len; $x++){
	$outStr = $vals["Probs"][$x][0];
	for ($y =1; $y < $len; $y++){
		$outStr.=','.$vals["Probs"][$x][$y];
	}
	$outStr.="\n";
file_put_contents($file,$outStr,FILE_APPEND);
//echo $outStr;
}

//find raw data and send it out for processing
	$file = __DIR__ . "/Data/DBInfo.csv";
	$fileTMP = __DIR__ . "/Data/tmp.csv";
	fopen($fileTMP, "w");
	chmod($fileTMP, 0777);
	$found = false;
	$outFile = "NONE";

	//check for files no other computer is using
	if(($file_handle = fopen($file, "r")) !== FALSE){
	while(($data = fgetcsv($file_handle, 5000, ",")) !== FALSE){
		if (!$found &&  $data[0] == ("Lat".$vals["longitude"]."Long".$vals["latitude"].".csv")){
				$found = true;
				$outFile = $data;
				$data[1] = "ANALYZED";
			}
		
		file_put_contents($fileTMP,$data[0].','.$data[1].','.$data[2].','.$data[3]."\n",FILE_APPEND);
	}
	fclose($file_handle);
	}
	if ($found){
		shell_exec ("cp ".$fileTMP." ".$file);
		shell_exec ("rm ".$fileTMP);
	}

	echo $decoded;
?>


