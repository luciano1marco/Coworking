<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Base Site URL
|--------------------------------------------------------------------------
|
*/
// Possible hosts locally. You can add some if needed.
$config['host_dev'] = array('localhost', '127.0.0.1', '192.168.0.14', '192.168.0.9', '::1', '192.168.0.116');

// Fill in the file of your project here when you develop locally.
$host_dev = 'coworking';

// Fill in the domain name here when your project is online.
// Example : www.johndoe.com
//           johndoe.com
//$host_prod = 'riogrande.rs.gov.br';
$host_prod = 'www.riogrande.rs.gov.br/coworking';

// WARNING: Do not modify the lines below
$domain = (in_array($_SERVER['HTTP_HOST'], $config['host_dev'], TRUE)) ? $_SERVER['HTTP_HOST'] . '/' . $host_dev : $host_prod;


$WEB_PROTOCOL = (@$_SERVER['SERVER_PORT'] == '443' || @$_SERVER['REQUEST_SCHEME'] == 'https' || @$_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') ? 'https://' : 'http://';
$config['base_url'] = $WEB_PROTOCOL . $domain;

/*  
|--------------------------------------------------------------------------
| Index File
|--------------------------------------------------------------------------
|
*/
$config['index_page'] = '';

/*
|--------------------------------------------------------------------------
| Assets
|--------------------------------------------------------------------------
|
*/
$config['assets_dir']     = 'assets';
$config['frameworks_dir'] = $config['assets_dir'] . '/frameworks';
$config['plugins_dir']    = $config['assets_dir'] . '/plugins';

/*
|--------------------------------------------------------------------------
| Upload
|--------------------------------------------------------------------------
|
*/
$config['upload_dir']     = 'upload';
$config['avatar_dir']     = $config['upload_dir'] . '/avatar';
