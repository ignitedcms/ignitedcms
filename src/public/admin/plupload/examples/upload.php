<?php

//!! IMPORTANT:
//!! this file is just an example, it doesn't incorporate any security checks and
//!! is not recommended to be used in production environment as it is. Be sure to
//!! revise it and customize to your needs.
exit('Make sure that you enable some form of authentication before removing this line.');

require_once 'handler-php/PluploadHandler.php';

$ph = new PluploadHandler([
    'target_dir' => 'uploads/',
    'allow_extensions' => 'jpg,jpeg,png',
]);

$ph->sendNoCacheHeaders();
$ph->sendCORSHeaders();

if ($result = $ph->handleUpload()) {
    exit(json_encode([
        'OK' => 1,
        'info' => $result,
    ]));
} else {
    exit(json_encode([
        'OK' => 0,
        'error' => [
            'code' => $ph->getErrorCode(),
            'message' => $ph->getErrorMessage(),
        ],
    ]));
}
