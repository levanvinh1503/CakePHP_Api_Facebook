<?php
/**
 * API Facebook
 */
define('FACEBOOK_APP_ID', '1709496319176798');
define('FACEBOOK_APP_SECRET', '5f05fcd0adcc5d136096fa1c5f8f5599');
define('FACEBOOK_REDIRECT_URI', 'http://localhost/democakephp/login-facebook');

define('FACEBOOK_SDK_V4_SRC_DIR','../vendor/facebook/graph-sdk/src/Facebook/');
require_once(APP . DS . '..' . DS . 'vendor' . DS . 'facebook' . DS . 'graph-sdk' . DS . 'src' . DS . 'Facebook' . DS . 'autoload.php');

