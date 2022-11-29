<?php

namespace Ldar\RtbSpecLib\bid\response;

use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidResponseBidAdmNativeAsset
 * @package Ldar\RtbSpecLib\bid\response
 */
class BidResponseBidAdmNativeAsset extends Model
{
    /**
     * Optional if assetsurl/dcourl is
     * being used; required if
     * embedded asset is being used.
     * @var int|null
     */
    protected ?int $id = null;

    /**
     * Set to 1 if asset is required.
     * (bidder requires it to be
     * displayed).
     * @var int
     */
    protected int $required = 0;

    /**
     * Title object for title assets. See
     * TitleObject definition.
     * @var BidResponseBidAdmNativeAssetTitle|null
     */
    protected ?BidResponseBidAdmNativeAssetTitle $title = null;

    /**
     * Image object for image assets.
     * See ImageObject definition.
     * @var BidResponseBidAdmNativeAssetImg|null
     */
    protected ?BidResponseBidAdmNativeAssetImg $img = null;

    /**
     * Video object for video assets.
     * See Video response object
     * definition.  Note that in-stream
     * video ads are not part of Native.
     * Native ads may contain a
     * @var BidResponseBidAdmNativeAssetVideo|null
     */
    protected ?BidResponseBidAdmNativeAssetVideo $video = null;

    /**
     * Data object for ratings, prices
     * etc.
     * @var BidResponseBidAdmNativeAssetData|null
     */
    protected ?BidResponseBidAdmNativeAssetData $data = null;

    /**
     * Link object for call to actions.
     * The link object applies if the
     * asset item is activated (clicked).
     * If there is no link object on the
     * asset, the parent link object on
     * the bid response applies.
     * @var BidResponseBidAdmNativeAssetLink|null
     */
    protected ?BidResponseBidAdmNativeAssetLink $link = null;

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

        return !$this->hasErrors();
    }

    public function asArray(): array
    {
        $this->array = [
            'id' => $this->id,
            'required' => $this->required,
        ];
        if (!is_null($this->link)) {
            $this->array['link'] = $this->link->asArray();
        }
        if (!is_null($this->title)) {
            $this->array['title'] = $this->title->asArray();
        }
        if (!is_null($this->img)) {
            $this->array['img'] = $this->img->asArray();
        }
        if (!is_null($this->video)) {
            $this->array['video'] = $this->video->asArray();
        }
        if (!is_null($this->data)) {
            $this->array['data'] = $this->data->asArray();
        }
        return $this->array;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return BidResponseBidAdmNativeAssetData|null
     */
    public function getData(): ?BidResponseBidAdmNativeAssetData
    {
        return $this->data;
    }

    /**
     * @param BidResponseBidAdmNativeAssetData|[]|null $data
     */
    public function setData($data): void
    {
        if ($data instanceof BidResponseBidAdmNativeAssetData) {
            $this->data = $data;
        } else {
            $this->data = new BidResponseBidAdmNativeAssetData();
            $this->data->load($data);
        }
    }

    /**
     * @return BidResponseBidAdmNativeAssetImg|null
     */
    public function getImg(): ?BidResponseBidAdmNativeAssetImg
    {
        return $this->img;
    }

    /**
     * @param BidResponseBidAdmNativeAssetImg|[]|null $data
     */
    public function setImg($data): void
    {
        if ($data instanceof BidResponseBidAdmNativeAssetImg) {
            $this->img = $data;
        } else {
            $this->img = new BidResponseBidAdmNativeAssetImg();
            $this->img->load($data);
        }
    }

    /**
     * @return BidResponseBidAdmNativeAssetLink|null
     */
    public function getLink(): ?BidResponseBidAdmNativeAssetLink
    {
        return $this->link;
    }


    /**
     * @param BidResponseBidAdmNativeAssetLink|[]|null $data
     */
    public function setLink($data): void
    {
        if ($data instanceof BidResponseBidAdmNativeAssetLink) {
            $this->link = $data;
        } else {
            $this->link = new BidResponseBidAdmNativeAssetLink();
            $this->link->load($data);
        }
    }

    /**
     * @return int
     */
    public function getRequired(): int
    {
        return $this->required;
    }

    /**
     * @return BidResponseBidAdmNativeAssetTitle|null
     */
    public function getTitle(): ?BidResponseBidAdmNativeAssetTitle
    {
        return $this->title;
    }

    /**
     * @param BidResponseBidAdmNativeAssetTitle|[]|null $data
     */
    public function setTitle($data): void
    {
        if ($data instanceof BidResponseBidAdmNativeAssetTitle) {
            $this->title = $data;
        } else {
            $this->title = new BidResponseBidAdmNativeAssetTitle();
            $this->title->load($data);
        }
    }

    /**
     * @return BidResponseBidAdmNativeAssetVideo|null
     */
    public function getVideo(): ?BidResponseBidAdmNativeAssetVideo
    {
        return $this->video;
    }

    /**
     * @param BidResponseBidAdmNativeAssetVideo|[]|null $data
     */
    public function setVideo($data): void
    {
        if ($data instanceof BidResponseBidAdmNativeAssetVideo) {
            $this->video = $data;
        } else {
            $this->video = new BidResponseBidAdmNativeAssetVideo();
            $this->video->load($data);
        }
    }
}