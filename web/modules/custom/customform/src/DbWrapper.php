<?php

namespace Drupal\customform;

use Drupal\Core\Database\Connection;

class DbWrapper {
	public function __construct(Connection $connection) {
		$this->connection = $connection;
	}
	public function getData() {
		$result = $this->connection->select ( 'customform', 'dd' )->fields ( 'dd' )->range ( 0, 1 )->execute ();
		return $result->fetchAssoc ();
	}
	public function setData($fname, $lname) {
		$this->connection->insert ( 'customform' )->fields ( [
				'First_Name',
				'Last_Name'
		], [
				$fname,
				$lname
		] )->execute ();
	}
}