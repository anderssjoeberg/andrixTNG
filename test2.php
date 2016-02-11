<?php

$output = null;

exec('/usr/bin/tdtool --list-devices', $output);

foreach ($output as $row) {
    $columns = explode("\t", $row);
	$columns[1]=substr($columns[1], 3);
	$columns[3]=substr($columns[3], 16);
    print_r($columns);

}

