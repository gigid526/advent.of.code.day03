<?php

$lines = file( __DIR__ . '/input.txt', FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
$claims = array_map(function($line) {
    return array_slice(preg_split('/\s@\s|,|:\s|x/', $line), 1);
}, $lines);
// The first puzzle
$fabric = [];
$sum = 0;
foreach ($claims as $claim) {
    for ($i = 0; $i < $claim[2]; $i++) {
        for ($j = 0; $j < $claim[3]; $j++) {
            $x = $i + $claim[0];
            $y = $j + $claim[1];
            isset($fabric[$x][$y]) ? $fabric[$x][$y]++ : ($fabric[$x][$y] = 1);
            if ($fabric[$x][$y] === 2) {
                $sum++;
            }
        }
    }
}
echo $sum . PHP_EOL;
// The second puzzle
$fabric = [];
foreach ($claims as $id => $claim) {
    for ($i = 0; $i < $claim[2]; $i++) {
        for ($j = 0; $j < $claim[3]; $j++) {
            $x = $i + $claim[0];
            $y = $j + $claim[1];
            if (isset($fabric[$x][$y])) {
                unset($claims[$id]);
                unset($claims[$fabric[$x][$y]]);
            } else {
                $fabric[$x][$y] = $id;
            }
        }
    }
}
echo count($claims) . PHP_EOL;
reset($claims);
echo key($claims) + 1 . PHP_EOL;