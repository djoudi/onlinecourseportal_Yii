<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function getHttpMessage($status_code) {
	$codes = getHttpCodes();
	return isset($codes[$status_code]) ? $codes[$status_code] : '';
}

function getHttpNormalMessage($normalCode) {
	$codes = getHttpNormalCodes();
	return isset($codes[$normalCode]) ? $codes[$normalCode] : '';
}

function getHttpErrorMessage($errorCode) {
	$codes = getHttpErrorCodes();
	return isset($codes[$errorCode]) ? $codes[$errorCode] : '';
}

function isHttpNormal($status_code) {
	$codes = getHttpNormalCodes();
	return isset($codes[$status_code]);
}

function isHttpError($status_code) {
	$codes = getHttpErrorCodes();
	return isset($codes[$status_code]);
}
	
function getHttpCodes() {
	return getHttpNormalCodes() + getHttpErrorCodes();
}
	
function getHttpNormalCodes() {
	return array(
				// informative
				100 => 'Continue',
				101 => 'Switching Protocols',
				// successful
				200 => 'OK',
				201 => 'Created',
				202 => 'Accepted',
				203 => 'Non-Authoritative Information',
				204 => 'No Content',
				205 => 'Reset Content',
				206 => 'Partial Content',
				// redirection
				300 => 'Multiple Choices',
				301 => 'Moved Permanently',
				302 => 'Found',
				303 => 'See Other',
				304 => 'Not Modified',
				305 => 'Use Proxy',
				306 => '(Unused)',
				307 => 'Temporary Redirect',
		);
}
	
function getHttpErrorCodes() {
	return array(
				// client errors
				400 => 'Bad Request',
				401 => 'Unauthorized',
				402 => 'Payment Required',
				403 => 'Forbidden',
				404 => 'Not Found',
				405 => 'Method Not Allowed',
				406 => 'Not Acceptable',
				407 => 'Proxy Authentication Required',
				408 => 'Request Timeout',
				409 => 'Conflict',
				410 => 'Gone',
				411 => 'Length Required',
				412 => 'Precondition Failed',
				413 => 'Request Entity Too Large',
				414 => 'Request-URI Too Long',
				415 => 'Unsupported Media Type',
				416 => 'Requested Range Not Satisfiable',
				417 => 'Expectation Failed',
				// Server errors
				500 => 'Internal Server Error',
				501 => 'Not Implemented',
				502 => 'Bad Gateway',
				503 => 'Service Unavailable',
				504 => 'Gateway Timeout',
				505 => 'HTTP Version Not Supported',
		);
}