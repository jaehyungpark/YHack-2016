 <?php
$row = 0;
// get connected device counts (user) from browser
$count = 3;
$file = __DIR__ . "/Data/temp.csv";
if (($handle = fopen(__DIR__ . "/Data/DataIn.csv", "r")) !== FALSE){
    $buff = '';
    $wantedCols = array(4,6,7,8);
    $dataCount = count($wantedCols);
    $tmpPAVI = 0;
    while(($data = fgetcsv($handle, 50000, ",")) !== FALSE){
        $num = count($data);
        for ($c = 0; $c < $num; $c++){
            if (!in_array($c, $wantedCols)) continue;
            $tmpPAVI++;
            $buff .= $data[$c];
            if ($tmpPAVI > 3){
                $tmpPAVI = 0;
                $buff .= "\n";
            }else{
                $buff .= ",";
            }
        }
    }
    file_put_contents($file, $buff);
    chmod($file, 0777);

    //print_r(csv_to_array($file)); 

    fclose($handle);
}



//create a config file listing files that have been cread and not used yet system
 $file = __DIR__ . "/Data/Config.csv";
 fopen($file, "w") or die("Unable to open file!");
 chmod($file, 0777);
file_put_contents($file, "Sqr Size,1\nIncr,10\n");
      

//Write all inital files
for ($lat = 0; $lat < 360; $lat+=10) {
    for ($long = 0; $long < 360; $long+=10) {
        $file = __DIR__ . "/Data/Lat".$lat."Long".$long.".csv";
        fopen($file, "w") or die("Unable to open file!");
        chmod($file, 0777);  //changed to add the zero
    }
} 

//Write all inital files
for ($lat = 0; $lat < 360; $lat+=10) {
    for ($long = 0; $long < 360; $long+=10) {
        $file = __DIR__ . "/Parsed/Lat".$lat."Long".$long.".csv";
        fopen($file, "w") or die("Unable to open file!");
        chmod($file, 0777);  //changed to add the zero
    }
} 

//Write all inital files
    $file = __DIR__ . "/Parsed/Compiled.csv";
    fopen($file, "w") or die("Unable to open file!");
    chmod($file, 0777);  //changed to add the zero


// read in world csv data nd put into 10x10 lat long files
if(($file_handle = fopen((__DIR__ . "/Data/temp.csv"), "r")) !== FALSE){
//dump first line we dont care for headers
if (!feof($file_handle)){
    $line = fgets($file_handle);
}
 while(($data = fgetcsv($file_handle, 5000, ",")) !== FALSE){
    //echo (floor(($data[2]/10)+18)*10)." || ".(floor(($data[3]/10)+18)*10) . "\n"; 
    $nameFile =  __DIR__ . "/Data/Lat".(floor(($data[2]/10)+18)*10)."Long".(floor(($data[3]/10)+18)*10).".csv";
    file_put_contents($nameFile,$data[0].','.$data[1].','.$data[2].','.$data[3]."\n",FILE_APPEND);
 }
fclose($file_handle);
}

//create a config file listing files that have been cread and not used yet system
 $file = __DIR__ . "/Data/DBInfo.csv";
 fopen($file, "w") or die("Unable to open file!");
 chmod($file, 0777);
 for ($lat = 0; $lat < 360; $lat+=10) {
    for ($long = 0; $long < 360; $long+=10) {
        if (filesize ( __DIR__ . "/Data/Lat".$lat."Long".$long.".csv") > 0){
            file_put_contents($file, "Lat".$lat."Long".$long.".csv,RAW,".$lat.",".$long."\n",FILE_APPEND);
        }else{
            file_put_contents($file, "Lat".$lat."Long".$long.".csv,EMPTY,".$lat.",".$long."\n",FILE_APPEND);
        }
    }
}


function csv_to_array($filename='', $delimiter=',')
{
    if(!file_exists($filename) || !is_readable($filename))
    {
        return FALSE;
    }
    $header = NULL;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== FALSE)
    {
        while (($row = fgetcsv($handle, 0, $delimiter)) !== FALSE)
        {
            if(!$header)
            {
                $header = array();
                foreach ($row as $val)
                {
                    $header_raw[] = $val;
                    $hcounts = array_count_values($header_raw);
                    $header[] = $hcounts[$val]>1?$val.$hcounts[$val]:$val;
                }
            }
            else
            {
                $data[] = array_combine($header, $row);
            }
        }
        fclose($handle);
    }
    return $data;
}
?>

