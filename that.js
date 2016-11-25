function meteorCount(X, Y, long, lat, sqrSize, incr){
  var count = 0;
  
  return count;
}


function meteorRangeCount(mass){
  var count = 0;
  for (i = 0; i <= 100; i++){
    if (i*1000 < mass && mass <= (i+1)*1000){
      count++;
    }
  }
  return count;
}
