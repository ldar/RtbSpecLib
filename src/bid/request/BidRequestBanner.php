<?php

namespace Ldar\RtbSpecLib\bid\request;


use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidRequestBanner
 * @package Ldar\RtbSpecLib\bid\request
 */
class BidRequestBanner extends Model
{
    /**
     * Unique identifier for this banner object. Recommended when
     * Banner objects are used with a Video object (Section 3.2.7) to
     * represent an array of companion ads. Values usually start at 1
     * and increase with each object; should be unique within an
     * impression
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * Exact width in device independent pixels (DIPS);
     * recommended if no format objects are specified.
     * @var integer|null
     */
    protected ?int $w = null;

    /**
     * Exact height in device independent pixels (DIPS);
     * recommended if no format objects are specified.
     * @var integer|null
     */
    protected ?int $h = null;

    /**
     * Ad position on screen. Refer to List 5.4
     * @var int|null
     */
    protected ?int $pos = null;

    /**
     * NOTE: Deprecated in favor of the format array.
     * Minimum width in device independent pixels (DIPS).
     * @var int|null
     */
    protected ?int $wmin = null;

    /**
     * NOTE: Deprecated in favor of the format array.
     * Minimum height in device independent pixels (DIPS)
     * @var int|null
     */
    protected ?int $hmin = null;

    /**
     * Blocked banner ad types. Refer to List 5.2
     * @var int[]|null
     */
    protected ?array $btype = null;

    /**
     * Blocked creative attributes. Refer to List 5.3
     * @var int[]|null
     */
    protected ?array $battr = null;

    /**
     * Content MIME types supported. Popular MIME types may
     * include “application/x-shockwave-flash”,
     * “image/jpg”, and “image/gif”
     * @var string[]|null
     */
    protected ?array $mimes = null;

    /**
     * Indicates if the banner is in the top frame as opposed to an
     * iframe, where 0 = no, 1 = yes.
     * @var int|null
     */
    protected ?int $topframe = null;

    /**
     * Directions in which the banner may expand. Refer to List 5.5
     * @var array|null
     */
    protected ?array $expdir = null;

    /**
     * 1 VPAID 1.0
     * 2 VPAID 2.0
     * 3 MRAID-1
     * 4 ORMMA
     * 5 MRAID-2
     * 6 MRAID-3
     * @var array|null
     */
    protected ?array $api = null;

    /**
     * Relevant only for Banner objects used with a Video object
     * (Section 3.2.7) in an array of companion ads. Indicates the
     * companion banner rendering mode relative to the associated
     * video, where 0 = concurrent, 1 = end-card.
     * @var int|null
     */
    protected ?int $vcm = null;

    /**
     * Array of format objects (Section 3.2.10) representing the
     * banner sizes permitted. If none are specified, then use of the
     * h and w attributes is highly recommended.
     * @var BidRequestImpBannerFormat[]|null
     */
    protected ?array $format = null;

    /**
     * Placeholder for exchange-specific extensions to OpenRTB.
     * @var string|null
     */
    protected ?string $ext = null;

    /**
     * @return bool
     */
    public function validate(): bool
    {
        $this->resetErrors();
        if (is_null($this->w)) {
            $this->addError('w is empty');
        }
        if (is_null($this->h)) {
            $this->addError('h is empty');
        }
        return !$this->hasErrors();
    }

    public function asArray(): array
    {
        $this->array = [
            'h' => $this->h,
            'w' => $this->w,
        ];
        if ($this->format) {
            foreach ($this->format as $item) {
                $this->array['format'][] = $item->asArray();
            }
        }
        if ($this->id) {
            $this->array['id'] = $this->id;
        }
        if ($this->wmin) {
            $this->array['wmin'] = $this->wmin;
        }
        if ($this->hmin) {
            $this->array['hmin'] = $this->hmin;
        }
        if ($this->pos) {
            $this->array['pos'] = $this->pos;
        }
        if ($this->btype) {
            $this->array['btype'] = $this->btype;
        }
        if ($this->battr) {
            $this->array['battr'] = $this->battr;
        }
        if ($this->mimes) {
            $this->array['mimes'] = $this->mimes;
        }
        if ($this->topframe) {
            $this->array['topframe'] = $this->topframe;
        }
        if ($this->expdir) {
            $this->array['expdir'] = $this->expdir;
        }
        if ($this->api) {
            $this->array['api'] = $this->api;
        }
        if ($this->vcm) {
            $this->array['vcm'] = $this->vcm;
        }
        if ($this->ext) {
            $this->array['ext'] = $this->ext;
        }
        return $this->array;
    }

    public function getH(): ?int
    {
        return $this->h;
    }

    public function getW(): ?int
    {
        return $this->w;
    }

    public function getPos(): ?int
    {
        return $this->pos;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getWmin(): ?int
    {
        return $this->wmin;
    }

    public function getExt(): ?string
    {
        return $this->ext;
    }

    public function getHmin(): ?int
    {
        return $this->hmin;
    }

    public function getApi(): ?array
    {
        return $this->api;
    }

    /**
     * @return int[]|null
     */
    public function getBattr(): ?array
    {
        return $this->battr;
    }

    /**
     * @return int[]|null
     */
    public function getBtype(): ?array
    {
        return $this->btype;
    }

    public function getExpdir(): ?array
    {
        return $this->expdir;
    }

    public function getMimes(): ?array
    {
        return $this->mimes;
    }

    public function getTopframe(): ?int
    {
        return $this->topframe;
    }

    public function getVcm(): ?int
    {
        return $this->vcm;
    }

    /**
     * @param BidRequestImpBannerFormat[]|array|null $format
     */
    public function setFormat(?array $format): void
    {
        $this->format = [];
        foreach ($format as $index => $item) {
            if ($item instanceof BidRequestImpBannerFormat) {
                $this->format[$index] = $item;
            } else {
                $this->format[$index] = new BidRequestImpBannerFormat();
                $this->format[$index]->load($item);
            }
        }
    }

    /**
     * @return BidRequestImpBannerFormat[]|null
     */
    public function getFormat(): ?array
    {
        return $this->format;
    }

}