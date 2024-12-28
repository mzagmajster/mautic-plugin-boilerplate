<?php

declare(strict_types=1);

namespace MauticPlugin\HelloWorldBundle\Integration;

use Mautic\IntegrationsBundle\Integration\BasicIntegration;
use Mautic\IntegrationsBundle\Integration\ConfigurationTrait;
use Mautic\IntegrationsBundle\Integration\DefaultConfigFormTrait;
use Mautic\IntegrationsBundle\Integration\Interfaces\BasicInterface;
use Mautic\IntegrationsBundle\Integration\Interfaces\BuilderInterface;
use Mautic\IntegrationsBundle\Integration\Interfaces\ConfigFormFeaturesInterface;
use Mautic\IntegrationsBundle\Integration\Interfaces\ConfigFormInterface;
use Mautic\IntegrationsBundle\Integration\Interfaces\IntegrationInterface;
use Mautic\PluginBundle\Entity\IntegrationRepository;

class MzExampleIntegration extends BasicIntegration implements BasicInterface, ConfigFormInterface, IntegrationInterface, ConfigFormFeaturesInterface, BuilderInterface
{
    use ConfigurationTrait;
    use DefaultConfigFormTrait;

    public const NAME         = 'mzexample';
    public const DISPLAY_NAME = 'MZ Exaple Integration';

    public function __construct(
        private IntegrationRepository $integrationRepo
    ) {
        $this->integration = $this->integrationRepo->findOneByName('MzExample');
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function getDisplayName(): string
    {
        return self::DISPLAY_NAME;
    }

    public function getIcon(): string
    {
        return 'plugins/HelloWorldBundle/Assets/img/icon.png';
    }

    public function getSupportedFeatures(): array
    {
        return [
            'mzTestFeature' => 'My test feature',
        ];
    }

    public function isSupported(string $featureName): bool
    {
        if (!$this->hasIntegrationConfiguration()) {
            return false;
        }

        return in_array(
            $featureName,
            $this->getIntegrationConfiguration()->getSupportedFeatures()
        );
    }
}
