<?php

namespace Ldar\RtbSpecLib\bid\response;

use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidResponseBidAdmNativeAssetImg
 * @package Ldar\RtbSpecLib\bid\response
 */
class BidResponseBidAdmNativeAssetImg extends Model
{
    /**
     * The text associated with the text
     * element
     * @var string|null
     */
    protected ?int $type = null;

    /**
     * URL of the image asset.
     * @var string|null
     */
    protected ?string $url = null;

    /**
     * Width of the image in pixels.
     * Recommended for embedded
     * asset responses.  Required for
     * assetsurl/dcourlresponses if
     * multiple assets of same type
     * submitted.
     * @var int|null
     */
    protected ?int $w = null;

    /**
     * Height of the image in pixels.
     * Recommended for embedded
     * asset responses.  Required for
     * assetsurl/dcourl responses if
     * multiple assets of same type
     * submitted.
     * @var int|null
     */
    protected ?int $h = null;

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
            'type' => $this->type,
            'url' => $this->url,
            'w' => $this->w,
            'h' => $this->h,
        ];
        return $this->array;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @return int|null
     */
    public function getH(): ?int
    {
        return $this->h;
    }

    /**
     * @return int|null
     */
    public function getW(): ?int
    {
        return $this->w;
    }

    /**
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }
}