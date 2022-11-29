<?php

namespace Ldar\RtbSpecLib\bid\request;

use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidRequestNativeRequestAssetData
 * @package Ldar\RtbSpecLib\bid\request
 */
class BidRequestNativeRequestAssetData extends Model
{
    public const ASSET_TYPE_SPONSORED_TEXT = 1;
    public const ASSET_TYPE_CTA_TEXT = 14;

    /**
     * Type ID of the image element
     * supported by the publisher.The
     * publisher can display this
     * information in an appropriate
     * format.
     * 1: Icon Icon image Optional. max  height: at least 50 aspect ratio: 1:1
     * 3: Large image preview for the ad. At least one of 2 size variants
     * 500+: Reserved for Exchange specific usage numbered above    500
     * @var int|null
     */
    protected ?int $type = null;

    /**
     * Maximum length of the text in the element’s response.
     * @var int|null
     */
    protected ?int $len = null;
    protected $ext = null;


    /**
     * @return bool
     */
    public function validate(): bool
    {
        $this->resetErrors();
        if (is_null($this->type)) {
            $this->addError('type is empty');
        }
        return !$this->hasErrors();
    }

    public function asArray(): array
    {
        $this->array = [
            'type' => $this->type,
        ];
        if (!is_null($this->len)) {
            $this->array['len'] = $this->len;
        }
        if (!is_null($this->ext)) {
            $this->array['ext'] = $this->ext;
        }
        return $this->array;
    }

    public function getLen(): ?int
    {
        return $this->len;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function getExt()
    {
        return $this->ext;
    }

}