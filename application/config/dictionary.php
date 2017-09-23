<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['dictionary']['account_status'] = [
	'pending' => 0,
	'active' => 1,
	'deactive' => 2,
	'banned' => 3,
	'blocked' => 4
];
$config['dictionary']['privacy'] = [
	0 => 'Private',
	1 => 'Public',
	2 => 'Protected'
];
$config['dictionary']['region'] = [
];
$config['dictionary']['group_type'] = [
	0 => 'System',
	1 => 'User'
];

$config['dictionary']['group_status'] = [
	0 => 'Deactive',
	1 => 'Active',
	2 => 'Block',
	3 => 'Banned'
];
