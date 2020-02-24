<?php

/**
 * @param $array array
 * @return string
 */
function findNumberRepeats1Time ($array) {
    $array = array_filter($array, function ($number) {
        return is_numeric($number);
    });
    $array_2 = array_unique( array_diff_assoc( $array, array_unique( $array ) ) );
    $arrayRepeats1Time = array_diff($array, $array_2);
    return join(" ",$arrayRepeats1Time);
}
echo findNumberRepeats1Time([4, 8, 9, 5, 8, 9, 4, 1, 9, 5]);