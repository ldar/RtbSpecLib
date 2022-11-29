<?php

namespace Ldar\RtbSpecLib\bid\response;

use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidResponseBidAdmNativeLink
 * @package Ldar\RtbSpecLib\bid\response
 */
class BidResponseBidAdmNativeLink extends Model
{
    /**
     * Landing URL of the  clickable link.
     * @var string|null
     */
    protected ?string $url = null;

    /**
     * List of third-party tracker URLs to
     * be fired on click of the URL.
     * @var string[]|null
     */
    protected ?array $clicktrackers = null;

    /**
     * Fallback URL for deeplink. To be
     * used if the URL given in url is not
     * supported by the device.
     * @var string|null
     */
    protected ?string $fallback = null;

    public function validate(): bool
    {
        $this->resetErrors();
        if (is_null($this->url)) {
            $this->addError('url is empty');
        }
        return !$this->hasErrors();
    }

    public function asArray(): array
    {
        $this->array = [
            'url' => $this->url,
            'clicktrackers' => $this->clicktrackers,
            'fallback' => $this->fallback,
        ];
        return $this->array;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getClicktrackers(): ?array
    {
        return $this->clicktrackers;
    }

    public function addClicktracker(string $tracker) : void
    {
        if (is_null($this->clicktrackers)) {
            $this->clicktrackers = [];
        }
        $this->clicktrackers[] = $tracker;
    }

    public function getFallback(): ?string
    {
        return $this->fallback;
    }
}