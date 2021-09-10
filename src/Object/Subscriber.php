<?php

namespace Bothelp\Object;

class Subscriber
{
    /** @var int|null */
    private $id;

    /** @var int|null */
    private $createdAt;

    /** @var bool|null */
    private $subscribed;

    /** @var string|null */
    private $channelName;

    /** @var string|null */
    private $channelType;

    /** @var string|null */
    private $name;

    /** @var string|null */
    private $email;

    /** @var string|null */
    private $phone;

    /** @var string|null */
    private $utmSource;

    /** @var string|null */
    private $utmMedium;

    /** @var string|null */
    private $utmCampaign;

    /** @var string|null */
    private $utmContent;

    /** @var string|null */
    private $utmTerm;

    /** @var array */
    private $tags;

    public function __construct(array $params)
    {
        $this->id          = ($params['id'] ?? null) ?: null;
        $this->createdAt   = ($params['createdAt'] ?? 0) ?: null;
        $this->subscribed  = $params['subscribed'] ?? null;
        $this->channelName = ($params['channelName'] ?? null) ?: null;
        $this->channelType = ($params['channelType'] ?? null) ?: null;
        $this->name        = ($params['name'] ?? null) ?: null;
        $this->email       = ($params['email'] ?? null) ?: null;
        $this->phone       = ($params['phone'] ?? null) ?: null;
        $this->utmSource   = ($params['utmSource'] ?? null) ?: null;
        $this->utmMedium   = ($params['utmMedium'] ?? null) ?: null;
        $this->utmCampaign = ($params['utmCampaign'] ?? null) ?: null;
        $this->utmContent  = ($params['utmContent'] ?? null) ?: null;
        $this->utmTerm     = ($params['utmTerm'] ?? null) ?: null;
        $this->tags        = $params['tags'] ?? [];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?int
    {
        return $this->createdAt;
    }

    public function getSubscribed(): ?bool
    {
        return $this->subscribed;
    }

    public function getChannelName(): ?string
    {
        return $this->channelName;
    }

    public function getChannelType(): ?string
    {
        return $this->channelType;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getUtmSource(): ?string
    {
        return $this->utmSource;
    }

    public function getUtmMedium(): ?string
    {
        return $this->utmMedium;
    }

    public function getUtmCampaign(): ?string
    {
        return $this->utmCampaign;
    }

    public function getUtmContent(): ?string
    {
        return $this->utmContent;
    }

    public function getUtmTerm(): ?string
    {
        return $this->utmTerm;
    }

    public function getTags(): array
    {
        return $this->tags;
    }
}