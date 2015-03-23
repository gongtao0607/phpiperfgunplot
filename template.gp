set terminal png enhanced font 'Verdana,9'
set output 'output.png'

set datafile sep ','
set ylabel 'Bandwidth(Mbps)' font 'Verdana, 14'
set xlabel 'Time(UTC)' font 'Verdana, 14'

set xdata time
set timefmt "%Y%m%d%H%M%S"
set format x "%m/%d\n%H:%M"

set key below
set grid
plot "output.csv" using 1:($2/1000000) notitle with lines
