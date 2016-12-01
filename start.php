<!DOCTYPE html>
<meta charset="utf-8">
<html style="width: 100%; height: 100%; padding: 0px; margin: 0px;">
<head>
 <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body style=" width: 100%; height: 100%; padding: 0px; margin: 0px; overflow: hidden; background-color: rgba(0, 0, 0, 0.8); display: table">
<div style="color: white; vertical-align: middle; display: table-cell; text-align: center">

<h1 id="supfamo" > das</h1>
<a style="color: white;  padding-left: 5px; padding-right: 5px;outline: #cccccc solid thin;" href="viewData.php" >Thanks for the Help</a>
</div>
<script>
function process(dataIn){
var tmpData = dataIn[0].split(",");	
var longS = parseInt(tmpData[0]) -180;
var latS = parseInt(tmpData[1]) -180;
var incr = parseInt(tmpData[2]);
var steps = parseInt(tmpData[3]);

console.log(longS);
console.log(latS);

var probability = new Array(steps);
for (x =0; x < steps; x++){
	probability[x] = new Array(steps);
	for (y = 0; y < steps; y++){
		probability[x][y] = 0;
	}
}

totalData = 0;

for ( i=1; i< dataIn.length; i++){
tmpData = dataIn[i].split(",");
metorSize = parseInt(tmpData[0]);
try{
x = Math.floor((parseInt(tmpData[3])-latS)/incr);
y = Math.floor((parseInt(tmpData[2])-longS)/incr);


probability[y][x]+=1;

totalData++;
}catch(e){

}
}

console.log(probability);

for (x =0; x < steps; x++){
	for (y = 0; y < steps; y++){
		if (!probability[y][x]){
			probability[y][x] = 0;
		}
		probability[y][x] /= totalData;
	}
}

console.log(probability);

var dataObject = {longitude: longS+180,
				  latitude: latS+180,
				  length: steps,
				  Probs :probability
				};

var send = $.ajax({
        type: "POST",
        dataType: "json",
        cache: false,
        url: "recieve.php",
        data: {data:dataObject},
        success: function(data){ // <-- note the parameter here, not in your code
       console.log(data);
    }  
});

document.getElementById("supfamo").innerHTML = "COMPLETE";
}

$.ajax({  
    type: "POST",  
    url: "download.php?q=help",  
    data: { 'Score':72 },      
    success: function(data){ // <-- note the parameter here, not in your code
      //console.log(data);
      
       process(data.split("\n"));
    } 
});
</script>
</body>
</html>