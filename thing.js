// 2 overall methods to handle two things
// first is to find the find the probability of a meteor hit in a particular square in the big square
// for this, wee need to get 4 arguments, long, lat, sqrSize, and incr.
/******
long and lat should be any arbitrary value that is the starting point of the larger square.
square size will be the square length of each smaller square and incr is the count of how many smaller squares
are inside the larger square.

First, we need to keep track how many meteors hit in the smaller square, all of them in each fucking larger square
and make a count for each of them, increment them everytime it his them.
After it's done for the larger square, get an overall probabilty of this meteor hit.

Second is to keep track of the mass that is hitting in each of the smaller square and keep track them
in an interval of 1000g. We need two things for this, find which smaller square has the high mass among all
the meteor hits in larger square and get the probability for each smaller square for each interval.

******/
