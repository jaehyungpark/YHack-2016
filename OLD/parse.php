<?php
$row = 0;
// get connected device counts (user) from browser
$count = 3;
$file = "temp.csv";
if (($handle = fopen("meteorite.csv", "r")) !== FALSE){
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
                $buff .= ", ";
            }
        }
    }
    file_put_contents($file, $buff);
    $linecount = 0;
    $handle2 = fopen($file, "r");
    $line = '';
    while(!feof($handle2)){
        $line = fgets($handle2);
        $linecount++;
    }
    $numRows = $linecount - 1;
    // echo $numRows;
    $mod = $numRows % $count;
    $buff2 = '';
    $div = $numRows/$count;
    while(($data2 = fgetcsv($handle2, 50000, ",")) !== FALSE){
    if($mod == 0){
        $tempPAVI = 0;
        for ($d = 0; $d < $div; $d++){
            $tmpPAVI++;
            $buff2 .= $data2[$d];
            if ($tmpPAVI > 3){
                $tmpPAVI = 0;
                $buff2 .= ",";
            }else{
                $buff2 .= ", ";
        }
        file_put_contents("file1.csv", $buff2);
        /*
        for ($d = $numRows/$count; $d < 2*$numRows/$count; $d++){
            $buff2 .= $line[$d]."\n";
        }
        file_put_contents("file2.csv", $buff2);
        for ($d = 2*$numRows/$count; $d < 3*$numRows/$count; $d++){
            $buff2 .= $line[$d]."\n";
        }
        file_put_contents("file3.csv", $buff2);
    } elseif ($mod < $count){        
    $numRows += $mod;
        // copy line by line for 1/3 each except the last file
    }
    */
    fclose($handle2);
    fclose($handle);
}
?>

