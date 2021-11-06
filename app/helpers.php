<?php

if(!function_exists("shorten_description"))
{
    function shorten_description($str, $length = 100)
    {
        return substr($str, 0, $length);
    }
}
