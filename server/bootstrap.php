<?php
	use KrameWork\AutoLoader;
	use KrameWork\Database\ConnectionString;
	use KrameWork\Database\Database;
	use KrameWork\DependencyInjector;
	use KrameWork\Runtime\ErrorDispatchers\MailDispatcher;
	use KrameWork\Runtime\ErrorFormatters\HTMLErrorFormatter;
	use KrameWork\Runtime\ErrorHandler;

	require_once('../KrameWork7/src/AutoLoader.php');

	// Initialize auto-loading..
	new AutoLoader([__DIR__], null, AutoLoader::INCLUDE_KRAMEWORK_DIRECTORY | AutoLoader::RECURSIVE_SOURCING);

	// Set-up error handling..
	$errGenerator = function() { return 'Error Report: ' . md5(time() + mt_rand()); };
	$errDispatch = new MailDispatcher(['kruithne@gmail.com' => 'Kruithne'], 'error@collectors-of-azeroth.net', 'Collectors of Azeroth', $errGenerator);
	new ErrorHandler($errDispatch, new HTMLErrorFormatter());

	// Set-up database..
	$dbConfig = json_decode(file_get_contents('db.conf.json'));
	$dbDSN = new ConnectionString($dbConfig->dsn, $dbConfig->user, $dbConfig->pass);

	// Set-up dependency injection..
	$root = new DependencyInjector(DependencyInjector::AUTO_ADD_DEPENDENCIES);
	$root->addComponent(new Database($dbDSN, Database::DB_DRIVER_PDO));

	// Clean-up to prevent leakage..
	unset($errGenerator, $errDispatch);
	unset($dbConfig, $dbDSN);