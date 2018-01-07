<?php
	use KrameWork\AutoLoader;
	use KrameWork\Runtime\ErrorDispatchers\MailDispatcher;
	use KrameWork\Runtime\ErrorFormatters\HTMLErrorFormatter;
	use KrameWork\Runtime\ErrorHandler;

	require_once('../KrameWork7/src/AutoLoader.php');

	// Initialize auto-loading..
	new AutoLoader();

	// Set-up error handling..
	$errGenerator = function() { return 'Error Report: ' . md5(time() + mt_rand()); };
	$errDispatch = new MailDispatcher(['kruithne@gmail.com' => 'Kruithne'], 'error@collectors-of-azeroth.net', 'Error Reporter', $errGenerator);
	$errHandler = new ErrorHandler($errDispatch, new HTMLErrorFormatter());