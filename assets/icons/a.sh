#!/bin/bash
for i in {0..9}
do
curl "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=0$i|FE6256|000000" > 0$i.png
done
