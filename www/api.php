<?php
	require_once('../server/bootstrap.php');

	header('Content-type: application/json');

	$handler = $root->getComponent('RequestHandler');
	$handler->handle(\KrameWork\HTTP\HTTPContext::getJSON())->sendToBuffer();