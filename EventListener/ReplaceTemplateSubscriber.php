<?php

declare(strict_types=1);

namespace MauticPlugin\HelloWorldBundle\EventListener;

use Mautic\CoreBundle\CoreEvents;
use Mautic\CoreBundle\Event\CustomTemplateEvent;
use MauticPlugin\HelloWorldBundle\Integration\MzExampleIntegration;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ReplaceTemplateSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private MzExampleIntegration $exampleInt
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            CoreEvents::VIEW_INJECT_CUSTOM_TEMPLATE => [
                ['replaceTemplates', 0],
            ],
        ];
    }

    public function replaceTemplates(CustomTemplateEvent $event): void
    {
        $isPublished = $this->exampleInt?->getIntegrationConfiguration()
            ?->getIsPublished();

        if (!$isPublished) {
            return;
        }

        $testFeature = $this->exampleInt?->isSupported('mzTestFeature');

        if (!$testFeature) {
            return;
        }

        // integration is published and feature enabled...logic to replace templates here
    }
}
