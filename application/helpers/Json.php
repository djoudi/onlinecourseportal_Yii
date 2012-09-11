<?php

function sendJson($status_code = 200, $data = array(), $additional_headers = null) {
	Yii::app()->loadHelper('HttpStatusCodes');
	header("HTTP/1.1 $status_code " . getHttpMessage($status_code));

	if(is_array($additional_headers))
		foreach($additional_headers as $header)
			header($header);
	header('Content-Type: application/json');
	$data = CJSON::encode(array('success' => isHttpNormal($status_code), 'data' => $data));

	header('Content-MD5: ' . md5($data));
	header('Content-Length: ' . strlen($data));

	if(strcasecmp(Yii::app()->getRequest()->getRequestType(), 'HEAD') === 0)
		exit;

	echo $data;
}

?>