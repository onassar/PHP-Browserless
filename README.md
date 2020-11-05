# PHP-Browserless
PHP SDK for running queries against the cloud-based NodeJS service provided by
[Browserless](https://browserless.io).

### Supports
- `/function` with code and context parameters

### Note
Requires
[PHP-RemoteRequests](https://github.com/onassar/PHP-RemoteRequests).

### Sample Function Call
``` php
$client = new onassar\Browserless\Base();
$client->setToken('***');
$code = file_get_contents('/path/to/puppeteer-script.js');
$context = array(
    'url' => 'https://example.org/'
);
$package = compact('code', 'context');
$response = $client->runFunction($package);
print_r($response);
exit(0);
```
