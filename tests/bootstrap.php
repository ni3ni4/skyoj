<?php
define('IN_SKYOJSYSTEM', 1);
$loader = require_once __DIR__.'/../vendor/autoload.php';
if( is_object ($loader) )
    $loader->add('',__DIR__.'/../library/TFcis');
$_E = [];
//load real file in ./
function g__loadthis(string $file):void
{
    static $my;
    $filename = basename($file);
    if( !isset($my) )
    {
        $my = strlen(realpath(__DiR__));
    }
    $path = dirname(substr($file,$my));
    $filename = substr($filename,0,-8).'.php';
    $open = realpath('.').$path.'/'.$filename;
    require_once($open);
}
