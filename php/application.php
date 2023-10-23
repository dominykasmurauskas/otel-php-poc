<?php

require_once 'vendor/autoload.php';

use OpenTelemetry\API\Signals;
use OpenTelemetry\Contrib\Grpc\GrpcTransportFactory;
use OpenTelemetry\Contrib\Otlp\MetricExporter;
use OpenTelemetry\Contrib\Otlp\OtlpUtil;
use OpenTelemetry\SDK\Common\Attribute\Attributes;
use OpenTelemetry\SDK\Metrics\MeterProvider;
use OpenTelemetry\SDK\Metrics\MetricReader\ExportingReader;
use OpenTelemetry\SDK\Resource\ResourceInfo;

$openTelemetryCollector = 'http://otel-collector:4317';

$reader = new ExportingReader(new MetricExporter(
    (new GrpcTransportFactory())->create($openTelemetryCollector . OtlpUtil::method(Signals::METRICS))
));

$meter = MeterProvider::builder()
    ->setResource(ResourceInfo::create(Attributes::create(['service.name' => 'chains-importer'])))
    ->addReader($reader)
    ->build()
    ->getMeter('my-meter');

$counter = $meter->createCounter('imported-blocks-count');
$counter->add(1, ['chain' => 'ethereum', 'lastBlock' => 123]);
$reader->forceFlush();
