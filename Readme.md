# OTel monitoring example for PHP applications

## Install

1. Run `docker-compose up -d`
2. Run `docker exec monitoring_php_app composer install`

## Send metrics

In order to send metrics, you only need to run `docker exec monitoring_php_app php application.php`. 

After running this command, a new metric should be visible in `chains-importer` bucket called `imported-blocks-count` (type: counter). 

To test sending metrics with another endpoint, change `$openTelemetryCollector` variable value in `application.php` and try running it again.
