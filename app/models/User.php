<?php

use lib\DAO\SuperDAO;

class User {

	static $table = 'users';

//	private $username, $id;

	public function setId ( $id ) {
		$this->id = $id;
	}

	public function setUsername ( $username ) {
		$this->username = $username;
	}

	public function getId () {
		return $this->id;
	}

	public function getUsername () {
		return $this->username;
	}

	public static function all () {
		return SuperDAO::all( User::$table );
	}

	public static function find ( $id ) {
		$result = SuperDAO::findById ( User::$table, $id );
		
		if ( !empty ( $result ) ) {
			$user = new User();
			$user->setId( $id );
			$user->setUsername( $result->username );
			return $user;
		}
		return null;
	}

	public static function findByFields( $fields, $values) {
		return SuperDAO::findByFields( User::$table, $fields, $values);
	}
}
