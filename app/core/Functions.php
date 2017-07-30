<?php

/**
 * Function of hiding email
 *
 * @param [type] $email
 * @return void
 */
function hide_email($email)
{
    $em = explode("@", $email);
    $name = implode(array_slice($em, 0, count($em)-1), '@');
    $len = strlen($name);
    $show = floor($len / 3);

    return substr($name, 0, $show) . str_repeat('*', $len-$show) . "@" . end($em);   
}