<?php

namespace Ldar\RtbSpecLib\bid\request;

use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidRequestNativeRequest
 * @package Ldar\RtbSpecLib\bid\request
 * https://www.iab.com/wp-content/uploads/2018/03/OpenRTB-Native-Ads-Specification-Final-1.2.pdf
 */
class BidRequestNativeRequest extends Model
{
    /**
     * Version of the Native Markup version in use.
     * @var string
     */
    protected string $ver = '1.1';

    /**
     * The context in which the ad
     * appears. See    Table of Context
     * IDs below for a list of supported
     * context types.
     * @var int|null
     */
    protected ?int $context = null;

    /**
     * A more detailed context in which
     * the ad appears. See Table of
     * Context SubType    IDs below for a
     * list    of supported context
     * subtypes.
     * @var int|null
     */
    protected ?int $contextsubtype = null;

    /**
     * An array of Asset Objects.Any
     * bid response must comply with
     * the array of elements expressed
     * in the bid request.
     * @var BidRequestNativeRequestAsset[]|null
     */
    protected ?array $assets = null;

    /**
     * The  design/format/layout of the
     * ad unit  being offered. See Table
     * of Placement Type IDs below for
     * a list of supported placement
     * types.
     * @var int|null
     */
    protected ?int $plcmttype = null;

    /**
     * The    number of identical
     * placements in this Layout. Refer
     * Section    8.1    Multiplacement Bid
     * Requests for    further    detail.
     * @var int
     */
    protected int $plcmtcnt = 1;

    /**
     * 0 for the first ad, 1 for the second
     * ad, and    so on. Note this would
     * generally NOT be used in
     * combination with plcmtcnt    -
     * either you are auctioning
     * multiple    identical placements (in
     * which case plcmtcnt>1, seq=0) or
     * you are holding separate
     * auctions    for    distinct items in the
     * feed    (in    which case plcmtcnt=1,
     * seq=>=1)
     * @var int
     */
    protected int $seq = 0;

    /**
     * Whether    the    supply    source    /
     * impression    supports    returning    an
     * assetsurl    instead    of    an    asset
     * object.        0    or    the    absence    of    the
     * field    indicates    no    such    support.
     * @var int
     */
    protected int $aurlsupport = 0;

    /**
     * Whether the supply source /
     * impression supports returning a
     * dco    url    instead    of    an asset object.
     * 0 or    the    absence    of    the    field
     * indicates no such support. Beta
     * @var int
     */
    protected int $durlsupport = 0;

    /**
     * Specifies what type of event
     * tracking is supported - see Event
     * Trackers Request Object
     * @var BidRequestNativeRequestEventtrackers[]|null
     */
    protected ?array $eventtrackers = null;

    /**
     * Set    to 1 when the native ad
     * supports    buyer-specific privacy
     * notice. Set to 0 (or field absent)
     * when    the    native ad doesn’t
     * support custom privacy
     * @var int
     */
    protected int $privacy = 0;

    /**
     * This    object is a placeholder    that
     * may contain custom JSON agreed
     * to by the    parties to support
     * flexibility beyond the standard
     * defined in this specification
     * @var null
     */
    protected $ext = null;

    /**
     * @return bool
     */
    public function validate(): bool
    {
        $this->resetErrors();
        if (is_null($this->assets)) {
            $this->addError('assets is empty');
        } else {
            foreach ($this->assets as $index => $asset) {
                if (!$asset->validate()) {
                    $this->addError('Asset ' . $index . ':' . $asset->getErrorsAsString());
                }
            }
        }
        if ($this->eventtrackers) {
            foreach ($this->eventtrackers as $index => $eventtracker) {
                if (!$eventtracker->validate()) {
                    $this->addError('Eventtracker ' . $index . ':' . $eventtracker->getErrorsAsString());
                }
            }
        }
        return !$this->hasErrors();
    }

    private function getAssetsAsArray(): ?array
    {
        if (is_null($this->assets)) {
            return null;
        }
        $data = [];
        foreach ($this->assets as $index => $asset) {
            $data[] = $asset->asArray();
        }
        return $data;
    }

    public function asArray(): array
    {
        $this->array = [
            'ver' => $this->ver,
            'assets' => $this->getAssetsAsArray(),
        ];
        if (!is_null($this->plcmttype)) {
            $this->array['plcmttype'] = $this->plcmttype;
        }
        if (!is_null($this->eventtrackers)) {
            foreach ($this->eventtrackers as $eventtracker) {
                $this->array['eventtrackers'][] = $eventtracker->asArray();
            }
        }
        if (!is_null($this->ext)) {
            $this->array['ext'] = $this->ext;
        }
        if (!is_null($this->plcmtcnt)) {
            $this->array['plcmtcnt'] = $this->plcmtcnt;
        }
        if (!is_null($this->context)) {
            $this->array['context'] = $this->context;
        }
        if (!is_null($this->contextsubtype)) {
            $this->array['contextsubtype'] = $this->contextsubtype;
        }
        if (!is_null($this->seq)) {
            $this->array['seq'] = $this->seq;
        }
        if (!is_null($this->aurlsupport)) {
            $this->array['aurlsupport'] = $this->aurlsupport;
        }
        if (!is_null($this->durlsupport)) {
            $this->array['durlsupport'] = $this->durlsupport;
        }
        if (!is_null($this->privacy)) {
            $this->array['privacy'] = $this->privacy;
        }
        return $this->array;
    }

    /**
     * @return BidRequestNativeRequestAsset[]|null
     */
    public function getAssets(): ?array
    {
        return $this->assets;
    }

    /**
     * @param BidRequestNativeRequestAsset[]|null $assets
     */
    protected function setAssets(?array $assets): void
    {
        $this->assets = [];
        foreach ($assets as $index => $asset) {
            if ($asset instanceof BidRequestNativeRequestAsset) {
                $this->assets[] = $asset;
            } else {
                $this->assets[$index] = new BidRequestNativeRequestAsset();
                $this->assets[$index]->load($asset);
            }
        }
    }

    public function getVer(): ?string
    {
        return $this->ver;
    }

    public function getPlcmttype(): ?int
    {
        return $this->plcmttype;
    }

    public function getPlcmtcnt(): int
    {
        return $this->plcmtcnt;
    }

    public function getAurlsupport(): int
    {
        return $this->aurlsupport;
    }

    public function getContext(): ?int
    {
        return $this->context;
    }

    public function getContextsubtype(): ?int
    {
        return $this->contextsubtype;
    }

    public function getDurlsupport(): int
    {
        return $this->durlsupport;
    }

    /**
     * @return BidRequestNativeRequestEventtrackers[]|array|null
     */
    public function getEventtrackers(): ?array
    {
        return $this->eventtrackers;
    }

    public function getPrivacy(): int
    {
        return $this->privacy;
    }

    public function getSeq(): int
    {
        return $this->seq;
    }

    public function getExt()
    {
        return $this->ext;
    }

}