<?php

namespace Ldar\RtbSpecLib\bid\request;

use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidRequestImp
 * @package Ldar\RtbSpecLib\bid\request
 */
class BidRequestImp extends Model
{
    public const TYPE_PAYMENT_WIN = 'win';
    public const TYPE_PAYMENT_VIEW = 'view';
    public const TYPE_PAYMENT_CLICK = 'click';

    /**
     * A unique identifier for this impression within the context of
     * the bid request (typically, starts with 1 and increments.
     * @var string|null
     */
    protected ?string $id = null;

    protected ?BidRequestBanner $banner = null;
    protected ?BidRequestNative $native = null;

    /**
     * Minimum bid for this impression expressed in CPM.
     * @var float|null
     */
    protected ?float $bidfloor = null;

    /**
     * Currency specified using ISO-4217 alpha codes. This may be
     * different from bid currency returned by bidder if this is
     * allowed by the exchange.
     * @var string|null
     */
    protected ?string $bidfloorcur = "USD";

    /**
     * An array of Metric object (Section 3.2.5).
     * @var BidRequestImpMetric[]|null
     */
    protected ?array $metric = null;

    /**
     * Name of ad mediation partner, SDK technology, or player
     * responsible for rendering ad (typically video or mobile). Used
     * by some ad servers to customize ad code by partner.
     * Recommended for video and/or apps
     * @var string|null
     */
    protected ?string $displaymanager = null;

    /**
     * Version of ad mediation partner, SDK technology, or player
     * responsible for rendering ad (typically video or mobile). Used
     * by some ad servers to customize ad code by partner.
     * Recommended for video and/or apps.
     * @var string|null
     */
    protected ?string $displaymanagerver = null;

    /**
     * 1 = the ad is interstitial or full screen, 0 = not interstitial.
     * @var int
     */
    protected int $instl = 0;

    /**
     * Indicates the type of browser opened upon clicking the
     * creative in an app, where 0 = embedded, 1 = native. Note that
     * the Safari View Controller in iOS 9.x devices is considered a
     * native browser for purposes of this attribute.
     * @var int|null
     */
    protected ?int $clickbrowser = null;

    /**
     * Flag to indicate if the impression requires secure HTTPS URL
     * creative assets and markup, where 0 = non-secure, 1 = secure.
     * If omitted, the secure state is unknown, but non-secure HTTP
     * support can be assumed.
     * @var int|null
     */
    protected ?int $secure = null;

    /**
     * Array of exchange-specific names of supported iframe busters.
     * @var array|null
     */
    protected ?array $iframebuster = null;


    /**
     * Identifier for specific ad placement or ad tag that was used to
     * initiate the auction. This can be useful for debugging of any
     * issues, or for optimization by the buyer
     * @var string|null
     */
    protected ?string $tagid = null;


    /**
     * Placeholder for exchange-specific extensions to OpenRTB.
     * type json
     * @example {payment_type: 'CMP'}
     * @var string|null
     */
    protected ?string $ext = null;

    /**
     * Advisory as to the number of seconds that may elapse
     * between the auction and the actual impression.
     * @var int|null
     */
    protected ?int $exp = null;

    public function validate(): bool
    {
        $this->resetErrors();
        if (is_null($this->id)) {
            $this->addError('ID is empty');
        }
        if (is_null($this->bidfloor)) {
            $this->addError('Bid floor is empty');
        }
        if (is_null($this->banner) && is_null($this->native)) {
            $this->addError('Banner and Native is empty');
        }
        if (!is_null($this->banner) && !$this->banner->validate()) {
            $this->addError("Banner: " . $this->banner->getErrorsAsString());
        }
        if (!is_null($this->native) && !$this->native->validate()) {
            $this->addError("Native: " . $this->native->getErrorsAsString());
        }
        return !$this->hasErrors();
    }

    /**
     * @param array|BidRequestNative $data
     * @return bool
     */
    public function setNative($data): bool
    {
        if ($data instanceof BidRequestNative) {
            $this->native = $data;
            return true;
        }
        $this->native = new BidRequestNative();
        return $this->native->load($data);
    }

    public function getNative(): ?BidRequestNative
    {
        return $this->native;
    }

    public function setExt($ext): void
    {
        $this->ext = json_encode($ext);
    }

    public function getExt(): ?string
    {
        return $this->ext;
    }

    /**
     * @param array|BidRequestBanner $data
     * @return bool
     */
    public function setBanner($data): bool
    {
        if ($data instanceof BidRequestBanner) {
            $this->banner = $data;
            return true;
        }
        $this->banner = new BidRequestBanner();
        return $this->banner->load($data);
    }

    public function getBanner(): ?BidRequestBanner
    {
        return $this->banner;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getBidfloor(): ?float
    {
        return $this->bidfloor;
    }

    public function setBidfloor(?float $bidfloor): void
    {
        $this->bidfloor = $bidfloor;
    }

    public function getSecure(): ?int
    {
        return $this->secure;
    }

    public function getTypePayment(): ?string
    {
        if (is_null($this->ext)) {
            return null;
        }
        if (!$data = json_decode($this->ext, true)) {
            return null;
        }
        if (!isset($data['payment_type'])) {
            return null;
        }
        return $data['payment_type'];
    }

    public function asArray(): array
    {
        $this->array = [
            'id' => $this->id,
            'bidfloor' => $this->bidfloor,
        ];
        if (!is_null($this->displaymanager)) {
            $this->array['displaymanager'] = $this->displaymanager;
        }
        if (!is_null($this->displaymanagerver)) {
            $this->array['displaymanagerver'] = $this->displaymanagerver;
        }
        if (!is_null($this->instl)) {
            $this->array['instl'] = $this->instl;
        }
        if (!is_null($this->tagid)) {
            $this->array['tagid'] = $this->tagid;
        }
        if (!is_null($this->bidfloorcur)) {
            $this->array['bidfloorcur'] = $this->bidfloorcur;
        }
        if (!is_null($this->clickbrowser)) {
            $this->array['clickbrowser'] = $this->clickbrowser;
        }
        if (!is_null($this->iframebuster)) {
            $this->array['iframebuster'] = $this->iframebuster;
        }
        if (!is_null($this->metric)) {
            foreach ($this->metric as $item) {
                $this->array['metric'][] = $item->asArray();
            }
        }
        if (!is_null($this->ext)) {
            $this->array['ext'] = $this->ext;
        }
        if (!is_null($this->exp)) {
            $this->array['exp'] = $this->exp;
        }
        if (!is_null($this->native)) {
            $this->array['native'] = $this->native->asArray();
        }
        if (!is_null($this->banner)) {
            $this->array['banner'] = $this->banner->asArray();
        }
        if (!is_null($this->secure)) {
            $this->array['secure'] = $this->secure;
        }
        return $this->array;
    }

    public function getBidfloorcur(): ?string
    {
        return $this->bidfloorcur;
    }

    public function getClickbrowser(): ?int
    {
        return $this->clickbrowser;
    }

    public function getDisplaymanager(): ?string
    {
        return $this->displaymanager;
    }

    public function getDisplaymanagerver(): ?string
    {
        return $this->displaymanagerver;
    }

    public function getExp(): ?int
    {
        return $this->exp;
    }

    public function getIframebuster(): ?array
    {
        return $this->iframebuster;
    }

    public function getInstl(): int
    {
        return $this->instl;
    }

    /**
     * @return BidRequestImpMetric[]|null
     */
    public function getMetric(): ?array
    {
        return $this->metric;
    }

    /**
     * @param BidRequestImpMetric[]|null $metric
     */
    public function setMetric(?array $metric): void
    {
        $this->metric = [];
        foreach ($metric as $index => $item) {
            if ($item instanceof BidRequestImpMetric) {
                $this->metric[$index] = $item;
            } else {
                $this->metric[$index] = new BidRequestImpMetric();
                $this->metric[$index]->load($item);
            }
        }
    }

    public function getTagid(): ?string
    {
        return $this->tagid;
    }
}