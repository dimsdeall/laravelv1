<?php
function setActive($path, $active = 'active') {
    return call_user_func_array('Request::is', (array)$path) ? $active : '';
}
/*
function alert($message = null, $title = '') {
    return call_user_func_array('Alert::', $path.';
}
*/
function setShow($path, $show = 'show') {
    return call_user_func_array('Request::is', (array)$path) ? $show : '';
}

function setOpen($path, $open = 'has-treeview menu-open') {
    return call_user_func_array('Request::is', (array)$path) ? $open : '';
}

function formatDate($array) {
    $string = date('Y-m-d', strtotime($array));
    return $string;
}

if (! function_exists('num_row')) {
	function num_row($page, $limit) {
		if (is_null($page)) {
			$page = 1;
		}

		$num = ($page * $limit) - ($limit - 1);
		return $num;
	}
}
