<?php
function formatCOP($value)
{
    $x = number_format($value, 0, '', '.');
    return $x;
}
