<?php
$authenticated = false;
if (isset($_SERVER['REDIRECT_HTTP_AUTH']) && !empty($_SERVER['REDIRECT_HTTP_AUTH'])) {
    list($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) = explode(':', base64_decode(substr($_SERVER['REDIRECT_HTTP_AUTH'], 6)));
}

if (isset($_GET['login']) || !empty($_SERVER['PHP_AUTH_USER'])) {
    if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] != 'admin' || $_SERVER['PHP_AUTH_PW'] != $config['pw_admin']) {
        header('WWW-Authenticate: Basic realm="Admin-Zugang"');
        header('HTTP/1.0 401 Unauthorized');
        $error = 'Nicht authorisiert';
    } else {
        if (isset($_GET['login'])) {
            header('Location: .');
        }
        $authenticated = true;
    }
}
