<?php
	use KrameWork\Database\Database;
	use KrameWork\Storage\JSONFile;

	class RequestHandler {
		private $db;

		public function __construct(Database $db) {
			$this->db = $db;
		}

		public function handle($request) {
			$response = new JSONFile(null, true, false);
			$response->success = false;
			return $response;
		}
	}