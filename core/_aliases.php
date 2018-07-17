<?php


function dump($a, $b = 0, $c = 1)
{
    Format::dump($a, $b, $c);
}
function dd($a, $c = 1)
{
    Format::dump($a, 1, $c);
}
function Req()
{
    return Singleton::request();
}

function setting($key)
{
    return Singleton::settings()[$key][2];
}
