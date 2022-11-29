<?php

namespace Ldar\RtbSpecLib\bid\request;


use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidRequestNativeRequestAsset
 * @package Ldar\RtbSpecLib\bid\request
 */
class BidRequestNativeRequestAsset extends Model
{
    /**
     * Unique asset ID, assigned by
     * exchange. Typically a counter for
     * @var int|null
     */
    protected ?int $id = null;

    /**
     * Set to 1 if asset is required
     * (exchan gewill not accept a bid without it)
     * @var int
     */
    protected int $required = 0;

    /**
     * Title object for    title assets. See TitleObject definition
     * @var BidRequestNativeRequestAssetTitle|null
     */
    protected ?BidRequestNativeRequestAssetTitle $title = null;

    /**
     * Image object for image assets.See ImageObject definition.
     * @var BidRequestNativeRequestAssetImg|null
     */
    protected ?BidRequestNativeRequestAssetImg $img = null;

    /**
     * Data object for brand name, description,ratings, prices etc.
     * See DataObject definition.
     * @var BidRequestNativeRequestAssetData|null
     */
    protected ?BidRequestNativeRequestAssetData $data = null;

    /**
     * @return bool
     */
    public function validate(): bool
    {
        $this->resetErrors();
        if (is_null($this->id)) {
            $this->addError('id is empty');
        }
        if (!is_null($this->title) && !$this->title->validate()) {
            $this->addError('Title: ' . $this->title->getErrorsAsString());
        }
        if (!is_null($this->img) && !$this->img->validate()) {
            $this->addError('Img: ' . $this->img->getErrorsAsString());
        }
        if (!is_null($this->data) && !$this->data->validate()) {
            $this->addError('Data: ' . $this->data->getErrorsAsString());
        }
        return !$this->hasErrors();
    }

    /**
     * @return array
     */
    public function asArray(): array
    {
        $this->array = [
            'id' => $this->id,
            'required' => $this->required,
        ];
        if (!is_null($this->title)) {
            $this->array['title'] = $this->title->asArray();
        }
        if (!is_null($this->img)) {
            $this->array['img'] = $this->img->asArray();
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
     * @return BidRequestNativeRequestAssetTitle|null
     */
    public function getTitle(): ?BidRequestNativeRequestAssetTitle
    {
        return $this->title;
    }

    /**
     * @param BidRequestNativeRequestAssetTitle|array|null $title
     */
    protected function setTitle($title): void
    {
        if ($title instanceof BidRequestNativeRequestAssetTitle) {
            $this->title = $title;
        } else {
            $this->title = new BidRequestNativeRequestAssetTitle();
            $this->title->load($title);
        }
    }

    /**
     * @return BidRequestNativeRequestAssetImg|null
     */
    public function getImg(): ?BidRequestNativeRequestAssetImg
    {
        return $this->img;
    }

    /**
     * @param BidRequestNativeRequestAssetImg|array|null $img
     */
    protected function setImg($img): void
    {
        if ($img instanceof BidRequestNativeRequestAssetImg) {
            $this->img = $img;
        } else {
            $this->img = new BidRequestNativeRequestAssetImg();
            $this->img->load($img);
        }
    }

    /**
     * @return BidRequestNativeRequestAssetData|null
     */
    public function getData(): ?BidRequestNativeRequestAssetData
    {
        return $this->data;
    }

    /**
     * @param BidRequestNativeRequestAssetData|array|null $data
     */
    protected function setData($data): void
    {
        if ($data instanceof BidRequestNativeRequestAssetData) {
            $this->data = $data;
        } else {
            $this->data = new BidRequestNativeRequestAssetData();
            $this->data->load($data);
        }
    }

    /**
     * @return int
     */
    public function getRequired(): int
    {
        return $this->required;
    }
}