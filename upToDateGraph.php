<?php
	$files = array();
	$lats = array();
	$longs = array();
	$file = __DIR__ . "/Data/DBInfo.csv";
	if(($file_handle = fopen($file, "r")) !== FALSE){
	while(($data = fgetcsv($file_handle, 5000, ",")) !== FALSE){
		if ( $data[1] == "ANALYZED"){
			array_push($files,$data[0]);
			array_push($lats,$data[2]);
			array_push($longs,$data[3]);
			$found = true;
			}
	}
	fclose($file_handle);
	}

	$file = __DIR__ . "/Parsed/Compiled.csv";
	fopen($file, 'w');
	chmod($file, 777);
	for ($i = 0; $i < count($files); $i++) {
	if (($handle = fopen(__DIR__ . "/Parsed/".$files[$i], "r")) !== FALSE){
    while(($data = fgetcsv($handle, 50000, ",")) !== FALSE){
        $num = count($data);

        for ($c = 0; $c < $num; $c++){
        	echo $data[$c];
            if ($data[$c]>0){
            	echo ($lats[$i]+$c).','.($longs[$i]+$c).','.ceil($data[$c])."\n";
            	 file_put_contents($file, ($lats[$i]+$c).','.($longs[$i]+$c).','.ceil($data[$c])."\n",FILE_APPEND);
            }
        }
    }
}
}
?>