<?php

use Phalcon\Loader;

$loader = new Loader();

/**
 * We're registering a set of directories taken from the configuration file
 */
$loader->registerNamespaces([
    'Timetracker\Models'      => $config->application->modelsDir,
    'Timetracker\Controllers' => $config->application->controllersDir,
    'Timetracker\Forms'       => $config->application->formsDir,
    'Timetracker'             => $config->application->libraryDir
]);

$loader->register();
date_default_timezone_set('Asia/Bishkek');

// Use composer autoloader to load vendor classes
require_once BASE_PATH . '/vendor/autoload.php';


if (!function_exists('print_arr')) {
    function print_arr($var, $return = false, $special = true)
    {
        $type = gettype($var);
        $out = print_r($var, true);
        if ($special) {
            $out = htmlspecialchars($out);
        }
        $out = str_replace(' ', '&nbsp;', $out);
        if ($type == 'boolean') {
            $content = $var ? 'true' : 'false';
        } else {
            $content = nl2br($out);
        }

        $count = '';
        if ($type == 'array') {
            $count = ' (' . count($var) . ' items)';
        }
        $out = '<div style="
       border:2px inset #666;
       background:black;
       font-family:monospace;
       font-size:12px;
       color:#6F6;
       text-align:left;
       margin:20px;
       word-break: break-word;
       padding:16px">
         <span style="color: #F66">(' . $type . ')</span>' . $count . ' ' . $content . '</div><br /><br />';
        if (!$return)
            echo $out;
        else
            return $out;
    }
    function print_die($var, $return = false, $special = true)
    {
        print_arr($var, $return, $special);
        $info = debug_backtrace();
        print_arr("File: {$info[0]['file']} Line: {$info[0]['line']}");
        die ();
    }
}