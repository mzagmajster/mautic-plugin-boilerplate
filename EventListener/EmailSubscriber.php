<?php

declare(strict_types=1);

namespace MauticPlugin\HelloWorldBundle\EventListener;

use Mautic\CoreBundle\Event\TokenReplacementEvent;
use Mautic\EmailBundle\EmailEvents;
use Mautic\LeadBundle\Entity\Lead;
use Mautic\LeadBundle\Model\LeadModel;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EmailSubscriber implements EventSubscriberInterface
{
    public const IBAN_TOKEN = '{customiban}';

    public function __construct(
        private LeadModel $leadModel,
        private LoggerInterface $logger
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            EmailEvents::TOKEN_REPLACEMENT => [
                ['onEmailTokenReplacement', 0],
            ],
        ];
    }

    private function extractIbanFromLead($lead): string
    {
        $iban = '';

        if (is_array($lead) && isset($lead['iban'])) {
            $iban = $lead['iban'];
        } elseif ($lead instanceof Lead) {
            $iban = $lead->getFieldValue('iban', 'core');
        }

        return $iban;
    }

    private function formatIban(string $iban): string
    {
        $cleanedIban = str_replace(' ', '', $iban);

        return preg_replace(
            '/(\w{4})(\w{4})(\w{4})(\w{4})(\w+)/', '$1 $2 $3 $4 $5',
            $cleanedIban
        );
    }

    public function onEmailTokenReplacement(TokenReplacementEvent $event)
    {
        $event->addToken(self::IBAN_TOKEN, '');
        $lead = $event->getLead();

        $formattedIban = $this->formatIban(
            $this->extractIbanFromLead($lead)
        );

        $event->addToken(self::IBAN_TOKEN, $formattedIban);
    }
}
