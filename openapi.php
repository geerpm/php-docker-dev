<?php
/**
 * Create OpenAPI yaml
 */

// Laravel Project root path
define('OA_EXEC_ROOT_PATH', __DIR__ . '/laravel');

// autoloading
require OA_EXEC_ROOT_PATH . '/vendor/autoload.php';

// load .env
$dotenv = new \Dotenv\Dotenv(OA_EXEC_ROOT_PATH);
$dotenv->load();

// set constants
// define('API_VERSION', getenv('API_VERSION'));
// define('API_URL', getenv('API_URL'));

// make file
$openapi = \OpenApi\scan(OA_EXEC_ROOT_PATH, ['exclude' => ['vendor/', 'some_excluding.php']]);
file_put_contents('./openapi.yml', $openapi->toYaml());
