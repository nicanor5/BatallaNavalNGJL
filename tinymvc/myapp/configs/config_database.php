<?php

/**
 * database.php
 *
 * application database configuration
 *
 * @package		TinyMVC
 * @author		Monte Ohrt
 */

$config['default']['plugin'] = 'TinyMVC_PDO'; // plugin for db access
$config['default']['type'] = 'mysql';      // connection type
$config['default']['host'] = 'localhost';  // db hostname
$config['default']['name'] = 'BatallaNaval';     // db name
$config['default']['user'] = 'rootBatallaNaval';     // db username
$config['default']['pass'] = 'batalla';     // db password
$config['default']['persistent'] = false;  // db connection persistence?

?>
