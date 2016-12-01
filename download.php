<?php

function provideDataForNode(){
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
		if (!$found &&  $data[1] == "RAW"){
			$found = true;
				$outFile = $data;
				$data[1] = "ANALYZING";
			}
		
		file_put_contents($fileTMP,$data[0].','.$data[1].','.$data[2].','.$data[3]."\n",FILE_APPEND);
	}
	fclose($file_handle);
	}
	if ($found){
		shell_exec ("cp ".$fileTMP." ".$file);
		shell_exec ("rm ".$fileTMP);
		return $outFile;
	}

	//if none found try and find a file computers are using
	if(($file_handle = fopen($file, "r")) !== FALSE){
	while(($data = fgetcsv($file_handle, 5000, ",")) !== FALSE){
		if ($data[1] == "ANALYZING"){
			fclose($file_handle);
			return $data[0];
			}
		}
	}
	fclose($file_handle);
	return $outFile;
}

$val = $_REQUEST['q'];
if ($val == "help"){



$tmp = provideDataForNode();
if ($tmp == "NONE"){

}else{
	$outStr ="";
	$file = __DIR__ . "/Data/Config.csv";
	if(($file_handle = fopen($file, "r")) !== FALSE){
	while(($data = fgetcsv($file_handle, 5000, ",")) !== FALSE){
		$outStr.=",".$data[1];
		}
	}
	$OUT = $tmp[2].",".$tmp[3].$outStr."\n";
	$file = __DIR__."/Data/".$tmp[0];
	$myfile = fopen($file, "r") or die("Unable to open file!");
	$OUT .=  fread($myfile,filesize("./Data/temp.csv"));
	fclose($myfile);
	//echo $OUT;
	echo $OUT;
}
}else{
	$file = __DIR__ . "/Parsed/Compiled.csv";
	$myfile = fopen($file, "r") or die("Unable to open file!");
	$OUT .=  fread($myfile,filesize("./Parsed/Compiled.csv"));
	fclose($myfile);
	echo $OUT;
}
?>
