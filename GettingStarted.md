## Getting Started 

### To build the project

1. Install Php version 8.1 or superior (8.1.16 works with Laragon). 
See https://windows.php.net/download/ and download the thread safe version.
Install in local folder: `D:\php-R4.02\php-8.1.16`.

2. Activate `openssl`, `mbstring` and `curl` extension in the `php.ini`file.

3. In the `php.ini`file, modify the extension directory: `extension_dir = "D:\php-R4.02\php-8.1.16\ext"`

4. Set the `PATH` variable to point to the folder of fresh installed version of Php.
`%USERPROFILE%\AppData\Local\Microsoft\WindowsApps;D:\php-R4.02\php-8.1.16;`

5. Set the proxy variables (see https://gist.github.com/ozh/9751639, https://stackoverflow.com/questions/17307600/php-composer-behind-http-proxy).

    http_proxy = http://cache.iut-rodez.fr:8080
    https_proxy = http://cache.iut-rodez.fr:8080

6. Install `composer`. In VSCode : install the official `composer` extension 

7. Launch `composer update` from the `composer.json`.

### To launch PHPStan

`php ./all_users/lib/vendor/bin/phpstan --xdebug analyse -c ./phpstan.neon`

### To launch tests (without coverage)

`php ./all_users/lib/vendor/bin/phpunit`

### To launch tests with coverage

`php -dxdebug.mode=coverage ./all_users/lib/vendor/bin/phpunit  --coverage-html='reports/coverage'`
