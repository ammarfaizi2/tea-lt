<?php

defined("APP_KEY") or exit("APP_KEY is not defined!\n");

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com> https://www.facebook.com/ammarfaizi2
 * @license MIT
 * @version 0.0.1
 */
final class Session
{
	/**
	 * @var self
	 */
	private static $self;

	/**
	 * @var array
	 */
	private $r = [];

	/**
	 * @var bool
	 */
	private $flushed = false;

	/**
	 * @param string 
	 */
	private function __construct()
	{
		$this->r = [
			&$_COOKIE[COOKIE_PREFIX."c"],
			&$_COOKIE[COOKIE_PREFIX."1"],
			&$_COOKIE[COOKIE_PREFIX."2"],
			&$_COOKIE[COOKIE_PREFIX."3"]
		];
		
		if (isset($this->r[0], $this->r[1], $this->r[2], $this->r[3])) {

			$this->r[0] = (int)$this->r[0];
			$this->r[1] = json_decode(dencrypt($this->r[1], APP_KEY), true);
			$this->r[2] = json_decode(dencrypt($this->r[2], APP_KEY), true);
			$this->r[3] = json_decode(dencrypt($this->r[3], APP_KEY), true);

			if (is_array($this->r[1]) && is_array($this->r[2]) && is_array($this->r[3])) {
				return;
			}
		}

		$this->r[0] = 0;
		$this->r[1] = $this->r[2] = $this->r[3] = [];
	}

	/**
	 * @param string $key
	 * @param string $val
	 * @return void
	 */
	public function set(string $key, string $val): void
	{
		$this->r[1][$key] = $val;
	}

	/**
	 * @param string $key
	 * @param mixed $default_val
	 * @return mixed
	 */
	public function &get(string $key, $default_val = null)
	{
		if ($this->flushed) {
			throw new Error("Trying to get property after flushed");
		}
		if (array_key_exists($key, $this->r[1])) {
			return $this->r[1][$key];
		}
		return $default_val;
	}

	/**
	 * @param string $key
	 * @return mixed
	 */
	public function unset(string $key): void
	{
		if ($this->flushed) {
			throw new Error("Trying to unset property after flushed");
		}
		unset($this->r[1][$key]);
	}

	/**
	 * @return void
	 */
	public function destroy(): void
	{
		$this->r[1] = [];
	}

	/**
	 * @param string $key
	 * @param string $val
	 * @return void
	 */
	public function set2(string $key, string $val): void
	{
		if ($this->flushed) {
			throw new Error("Trying to set property after flushed");
		}
		$this->r[2][$key] = $val;
	}

	/**
	 * @param string $key
	 * @param mixed $default_val
	 * @return mixed
	 */
	public function &get2(string $key, $default_val = null)
	{
		if ($this->flushed) {
			throw new Error("Trying to get property after flushed");
		}
		if (array_key_exists($key, $this->r[2])) {
			return $this->r[2][$key];
		}
		return $default_val;
	}

	/**
	 * @param string $key
	 * @return mixed
	 */
	public function unset2(string $key): void
	{
		if ($this->flushed) {
			throw new Error("Trying to unset property after flushed");
		}
		unset($this->r[2][$key]);
	}

	/**
	 * @return void
	 */
	public function flush(): void
	{
		if ($this->flushed) {
			return;
		}
		foreach ($this->r as &$r) {
			$r = cencrypt(json_encode($r, JSON_UNESCAPED_SLASHES), APP_KEY);
		}
		unset($r);
		setcookie(COOKIE_PREFIX."c", $this->r[0], ...SET_COOKIE_PARAM);
		setcookie(COOKIE_PREFIX."1", $this->r[1], ...SET_COOKIE_PARAM);
		setcookie(COOKIE_PREFIX."2", $this->r[2], ...SET_COOKIE_PARAM);
		setcookie(COOKIE_PREFIX."3", $this->r[3], ...SET_COOKIE_PARAM);
		$this->flushed = true;
	}

	/**
	 * Destructor.
	 */
	public function __destruct()
	{
		$this->flush();
	}

	/**
	 * @return \Session
	 */
	public static function getInstance(): Session
	{
		if (!(self::$self instanceof Session)) {
			self::$self = new self;
		}
		return self::$self;
	}
}
