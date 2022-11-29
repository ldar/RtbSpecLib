<?php

namespace Ldar\RtbSpecLib\bid\response;


use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidResponseBidAdmNative
 * @package Ldar\RtbSpecLib\bid\response
 */
class BidResponseBidAdmNative extends Model
{
    /**
     * Version of the Native Markup
     * version in use.
     * @var string
     */
    protected string $ver = '1.2';

    /**
     * List of native ad’s assets.
     * Required if no assetsurl.
     * Recommended as fallback even
     * if assetsurl is provided.
     * @var BidResponseBidAdmNativeAsset[]|null
     */
    protected ?array $assets = null;

    /**
     * Destination  Link.  This  is  default
     * link  object  for  the  ad.  Individual
     * assets  can  also  have  a  link  object
     * which  applies  if  the  asset  is
     * activated(clicked).  If  the  asset
     * doesn’t  have  a  link  object,  the
     * parent  link  object  applies.  See
     * LinkObject  Definition
     * @var BidResponseBidAdmNativeLink|null
     */
    protected ?BidResponseBidAdmNativeLink $link = null;

    /**
     * Array of impression tracking
     * URLs,expected to return a 1x1
     * image or 204 response- typically
     * only passed when using 3rd
     * party trackers.To be deprecated
     * - replaced with eventtrackers
     * @var string[]|null
     */
    protected ?array $imptrackers = null;

    /**
     * @return bool
     */
    public function validate(): bool
    {
        $this->resetErrors();
        if (is_null($this->link)) {
            $this->addError('Link is empty');
        } else {
            if (!$this->link->validate()) {
                $this->addError('Link:' . $this->link->getErrorsAsString());
            }
        }
        if (!is_null($this->assets)) {
            foreach ($this->assets as $index => $asset) {
                if ($asset->validate()) {
                    $this->addError('Asset:' . $asset->getErrorsAsString());
                }
            }
        }
        return !$this->hasErrors();
    }

    /**
     * @param BidResponseBidAdmNativeAsset[]|null $assets
     */
    public function setAssets(?array $assets): void
    {
        $this->assets = [];
        foreach ($assets as $index => $asset) {
            if ($asset instanceof BidResponseBidAdmNativeAsset) {
                $this->assets[$index] = $asset;
            } else {
                $this->assets[$index] = new BidResponseBidAdmNativeAsset();
                $this->assets[$index]->load($asset);
            }
        }
    }

    /**
     * @return array|null
     */
    private function getAssetsAsArray(): ?array
    {
        if (is_null($this->assets)) {
            return null;
        }
        $data = [];
        foreach ($this->assets as $asset) {
            $data[] = $asset->asArray();
        }
        return $data;
    }

    public function asArray(): array
    {
        $this->array = [
            'ver' => $this->ver,
            'link' => is_null($this->link) ? null : $this->link->asArray(),
            'assets' => $this->getAssetsAsArray(),
            'imptrackers' => $this->imptrackers,
        ];
        return $this->array;
    }

    /**
     * @return BidResponseBidAdmNativeLink|null
     */
    public function getLink(): ?BidResponseBidAdmNativeLink
    {
        return $this->link;
    }

    /**
     * @param BidResponseBidAdmNativeLink|[]|null $data
     */
    public function setLink($data): void
    {
        if ($data instanceof BidResponseBidAdmNativeLink) {
            $this->link = $data;
        } else {
            $this->link = new BidResponseBidAdmNativeLink();
            $this->link->load($data);
        }
    }

    /**
     * @return BidResponseBidAdmNativeAsset[]|null
     */
    public function getAssets(): ?array
    {
        return $this->assets;
    }

    /**
     * @return string[]|null
     */
    public function getImptrackers(): ?array
    {
        return $this->imptrackers;
    }

    /**
     * @param string $tracker
     * @return mixed|void
     */
    public function addImptracker(string $tracker)
    {
        if (is_null($this->imptrackers)) {
            $this->imptrackers = [];
        }
        $this->imptrackers[] = $tracker;
    }

    /**
     * @return string
     */
    public function getVer(): string
    {
        return $this->ver;
    }
}