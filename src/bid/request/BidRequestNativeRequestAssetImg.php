<?php

namespace Ldar\RtbSpecLib\bid\request;

use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidRequestNativeRequestAsset
 * @package Ldar\RtbSpecLib\bid\request
 */
class BidRequestNativeRequestAssetImg extends Model
{
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
     * Width of the image in pixels.
     * @var int|null
     */
    protected ?int $w = null;

    /**
     * The minimum requested width
     * of the image in pixels.This
     * option should be used for any
     * rescaling of images by the client.
     * Either w or wmin should be
     * transmitted.If only w is
     * included, it should be co
     * @var int|null
     */
    protected ?int $wmin = null;

    /**
     * Height of the image in pixels.
     * @var int|null
     */
    protected ?int $h = null;

    /**
     * The minimum requested height
     * of the image in pixels.This
     * option should be used for any
     * rescaling of images by the client.
     * Either h or hmin should be
     * transmitted. If only h is included,
     * it should be considered an exact
     * requirement.
     * @var int|null
     */
    protected ?int $hmin = null;

    /**
     * Whitelist of content MIME types
     * supported.Popular MIME types
     * include,but are not limited to “image/jpg”  “image/gif”.
     * Each implementing Exchange should have their own list  of
     * supported types in the integration docs. See
     * Wikipedia's MIME page for more
     * information  and links to all IETF RFCs.
     * If blank, assume all types are
     * OpenRTB Dynamic Native Ads API Specification Version 1.2 RTB Project allowed.
     * @var array|null
     */
    protected ?array $mimes = null;
    protected $ext = null;

    /**
     * @return bool
     */
    public function validate(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function asArray(): array
    {
        $this->array = [
            'type' => $this->type,
        ];
        if (!is_null($this->w)) {
            $this->array['w'] = $this->w;
        }
        if (!is_null($this->w)) {
            $this->array['h'] = $this->h;
        }
        if (!is_null($this->wmin)) {
            $this->array['wmin'] = $this->wmin;
        }
        if (!is_null($this->hmin)) {
            $this->array['hmin'] = $this->hmin;
        }
        if (!is_null($this->mimes)) {
            $this->array['mimes'] = $this->mimes;
        }
        if (!is_null($this->ext)) {
            $this->array['ext'] = $this->ext;
        }
        return $this->array;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function getH(): ?int
    {
        return $this->h;
    }

    public function getHmin(): ?int
    {
        return $this->hmin;
    }

    public function getW(): ?int
    {
        return $this->w;
    }

    public function getWmin(): ?int
    {
        return $this->wmin;
    }

    public function getMimes(): ?array
    {
        return $this->mimes;
    }

    public function getExt()
    {
        return $this->ext;
    }
}