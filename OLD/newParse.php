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

    print_r(csv_to_array($file));   
    /*

    $line_of_text = '';
    $file_handle = fopen("meteorite.csv", 'r');
    while(!feof($file_handle)){
        $line_of_text[] = fgetcsv($file_handle, 1024);
    }
    fclose($file_handle);
    $csv = readCSV($file);
    print_r($csv);
    
    // $col = array_search("Value", $header);
    // get values of cols 2 and 3 in an array
    // compare each value and if it matches, put in separate files
    
    $buff2 = '';
    $tmpPAVI = 0;
    $handle = fopen($file, "r");    
    while(($data2 = fgetcsv($handle2, 50000, ",")) !== FALSE){
        $num2 = count($data2);
        for ($d = 0; $d < $num2; $d++){
            if (!in_array($d, $wantedCols2)) continue;
            $tmpPAVI++;
            $buff2 .= $data2[$d];
            if ($tmpPAVI > 3){


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

