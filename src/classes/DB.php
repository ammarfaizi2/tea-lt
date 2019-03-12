<?php

defined("PDO_PARAMETERS") or exit("PDO_PARAMETERS is not defined!\n");

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com> https://www.facebook.com/ammarfaizi2
 * @license MIT
 * @version 0.0.1
 */
final class DB
{
	/**
	 * @var self
	 */
	private static $self;

	/**
	 * @var \PDO
	 */
	private $pdo;

	/**
	 * Constructor.
	 */
	private function __construct()
	{
		$this->pdo = new PDO(...PDO_PARAMETERS);
	}

	/**
	 * @return \DB
	 */
	public static function getInstance(): DB
	{
		if (!(self::$self instanceof DB)) {
			self::$self = new self;
		}
		return self::$self;
	}

	/**
	 * @return \PDO
	 */
	public static function pdo(): PDO
	{
		$pdo = self::getInstance()->pdo;

		if (!($pdo instanceof PDO)) {
			self::$self = new self;
			$pdo = self::getInstance()->pdo;

			if (!($pdo instanceof PDO)) {
				exit("Cannot create PDO instance\n");
			}
		}

		return $pdo;
	}

	/**
	 * @return void
	 */
	public static function close(): void
	{
		self::getInstance()->pdo = null;
	}

	/**
	 * Destructor.
	 */
	public function __destruct()
	{
		$this->pdo = null;
	}
}
