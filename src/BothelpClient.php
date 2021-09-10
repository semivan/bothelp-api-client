<?php

namespace Bothelp;

use Bothelp\Operations\SubscriberOperations;

class BothelpClient
{
    /** @var BothelpApi */
    private $api;

    /** @var SubscriberOperations */
    private $subscribers;

    public function __construct(string $clientId, string $clientSecret)
    {
        $this->api         = new BothelpApi($clientId, $clientSecret);
        $this->subscribers = new SubscriberOperations($this->api);
    }

    public function subscribers(): SubscriberOperations
    {
        return $this->subscribers;
    }
}