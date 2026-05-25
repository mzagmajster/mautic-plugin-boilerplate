<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return function (ContainerConfigurator $configurator): void {
    $services = $configurator->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
        ->public();

    $excludes = [
        'Config',
        'Crate',
        'DataObject',
        'DependencyInjection',
        'DTO',
        'Entity',
        'Event',
        'Exception',
        'Migration',
        'Migrations',
        'Security',
        'Test',
        'Tests',
        'Views',

        '.devtools',
        '.env',
        'bin',
        '.gitkeep',
    ];

    $services->load('MauticPlugin\\HelloWorldBundle\\', '../')
        ->exclude(
            '../{'.implode(',', $excludes).'}'
        );

    /**
     * @todo Uncomment and adjust when using integration framework.
     */
    /*$services->set('mautic.integration.mzexample')
        ->class(
            MauticPlugin\HelloWorldBundle\Integration\MzExampleIntegration::class
        );*/
};
