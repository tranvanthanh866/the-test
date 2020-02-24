<?php
/**
 * @param $arr array
 * @return string
 */
function find2LargestNumber($arr) {
    $arr = array_filter($arr, function ($number) {
       return is_numeric($number);
    });
    if (count($arr) < 2) return "Error";
    $max = max($arr);
    $arr_2 = array_diff($arr, [max($arr)]);
    if (count($arr_2) == 0) return "Error";
    $second = max($arr_2);
    return "$max and $second";
}
echo find2LargestNumber([0, 6, 100, 46, 47]);