<?php

namespace Ldar\RtbSpecLib\bid\request;

use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidRequestImpBannerFormat
 * @package Ldar\RtbSpecLib\bid\request
 */
class BidRequestImpBannerFormat extends Model
{
    /**
     * Width in device independent pixels (DIPS).
     * @var int|null
     */
    protected ?int $w = null;

    /**
     * Height in device independent pixels (DIPS).
     * @var int|null
     */
    protected ?int $h = null;

    /**
     * Relative width when expressing size as a ratio.
     * @var int|null
     */
    protected ?int $wratio = null;

    /**
     * Relative height when expressing size as a ratio.
     * @var int|null
     */
    protected ?int $hratio = null;

    /**
     * The minimum width in device independent pixels (DIPS) at
     * which the ad will be displayed the size is expressed as a ratio.
     * @var int|null
     */
    protected ?int $wmin = null;

    /**
     * Placeholder for exchange-specific extensions to OpenRTB.
     * @var int|null
     */
    protected ?int $ext = null;

    public function validate(): bool
    {
        $this->resetErrors();
        return !$this->hasErrors();
    }

    public function asArray(): array
    {
        $this->array = [
            'w' => $this->w,
            'h' => $this->h,
        ];
        if (!is_null($this->wratio)) {
            $this->array['wratio'] = $this->wratio;
        }
        if (!is_null($this->hratio)) {
            $this->array['hratio'] = $this->hratio;
        }
        if (!is_null($this->wmin)) {
            $this->array['wmin'] = $this->wmin;
        }
        if (!is_null($this->ext)) {
            $this->array['ext'] = $this->ext;
        }
        return $this->array;
    }

    public function getExt(): ?int
    {
        return $this->ext;
    }

    public function getH(): ?int
    {
        return $this->h;
    }

    public function getW(): ?int
    {
        return $this->w;
    }

    public function getHratio(): ?int
    {
        return $this->hratio;
    }

    public function getWmin(): ?int
    {
        return $this->wmin;
    }

    public function getWratio(): ?int
    {
        return $this->wratio;
    }
}