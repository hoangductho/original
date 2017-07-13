<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/
/*
| -------------------------------------------------------------------------
| Presystem Setup
| -------------------------------------------------------------------------
|
| Default setup for system befor running proccess
*/
$hook['pre_system'][] = array(
        'class'    => 'Presytem',
        'function' => 'init',
        'filename' => 'Presytem.php',
        'filepath' => 'hooks',
);
