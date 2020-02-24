<?php
$amount = 2018;
$notes = [50, 10, 5, 1];
rsort($notes);
$remainder = $amount;
foreach ($notes as $note) {
    echo "$note : ".intval(floor($remainder / $note)). '<br>';
    $remainder = ($remainder % $note);
}