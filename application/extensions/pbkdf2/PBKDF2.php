<?php

class PBKDF2 {
	
	const HASH_ALGORITHM = "sha256";
	const ITERATIONS = 1024;
	const SALT_BYTES = 32;
	const HASH_BYTES = 32;
	const STATIC_SALT = 'aPzMkl7y99vUDZWWyoflnYGkBi8ZoSCXDiDo/7MH+Iw=';
	
	private $_string;
	private $_iv;
	
	public function __construct($string = null, $iv = null) {
		$this->_iv = $iv;
		$this->_string = $this->hash($string);
	}
	
	public function __set($name, $value) {
		if($name === 'string')
			$this->_string = $this->hash($value);
		else if($name === 'iv')
			$this->_iv = $value;
	}
	
	public function __get($name) {
		if($name === 'iv') {
			if($this->_iv === null)
				$this->_iv = $this->generateIV();
			return $this->_iv;
		} else if($name === 'hashed') {
			return $this->_string;
		}
	}	
	
	public function generateIV($replaceCurrentIv = true) {
		$iv = base64_encode(mcrypt_create_iv(self::SALT_BYTES, MCRYPT_DEV_URANDOM));
		if($replaceCurrentIv)
			$this->_iv = $iv;
		return $iv;
	}
	
	protected function hash($string) {
		return base64_encode($this->pbkdf2(
						self::HASH_ALGORITHM,
						$string,
						$this->iv,
						self::ITERATIONS,
						self::HASH_BYTES,
						true
				));
	}
	
	/**
	 * Compares two strings $a and $b in length-constant time.
	 * Prevents runtime analysis
	 */
	protected function slowEquals($a, $b) {
		$diff = strlen($a) ^ strlen($b);
		for($i = 0; $i < strlen($a) && $i < strlen($b); $i++) {
			$diff |= ord($a[$i]) ^ ord($b[$i]);
		}
		return $diff === 0;
	}
	
	/**
	 * PBKDF2 key derivation function as defined by RSA's PKCS #5: https://www.ietf.org/rfc/rfc2898.txt
	 * @param string $algorithm - The hash algorithm to use. Recommended: SHA256
	 * @param string $password - The password.
	 * @param string $iv - A salt that is unique to the password.
	 * @param int $count - Iteration count. Higher is better, but slower. Recommended: At least 1000.
	 * @param int $key_length - The length of the derived key in bytes.
	 * @param string $raw_output - If true, the key is returned in raw binary format. Hex encoded otherwise.
	 * @return A $key_length-byte key derived from the password and salt.
	 *
	 * Test vectors can be found here: https://www.ietf.org/rfc/rfc6070.txt
	 */
	protected function pbkdf2($algorithm, $password, $iv, $count, $key_length, $raw_output = false) {
		$algorithm = strtolower($algorithm);
		if(!in_array($algorithm, hash_algos(), true))
			die('PBKDF2 ERROR: Invalid hash algorithm.');
		if($count <= 0 || $key_length <= 0)
			die('PBKDF2 ERROR: Invalid parameters.');
	
		$hash_length = strlen(hash($algorithm, "", true));
		$block_count = ceil($key_length / $hash_length);
	
		$output = "";
		for($i = 1; $i <= $block_count; $i++) {
			// $i encoded as 4 bytes, big endian.
			$last = $iv . self::STATIC_SALT . pack("N", $i);
			// first iteration
			$last = $xorsum = hash_hmac($algorithm, $last, $password, true);
			// perform the other $count - 1 iterations
			for ($j = 1; $j < $count; $j++) {
				$xorsum ^= ($last = hash_hmac($algorithm, $last, $password, true));
			}
			$output .= $xorsum;
		}
	
		if($raw_output)
			return substr($output, 0, $key_length);
		else
			return bin2hex(substr($output, 0, $key_length));
	}
	
}