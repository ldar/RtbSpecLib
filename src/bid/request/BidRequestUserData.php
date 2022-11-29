<?php

namespace Ldar\RtbSpecLib\bid\request;

use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidRequestUserGeo
 * @package Ldar\RtbSpecLib\bid\request
 */
class BidRequestUserData extends Model
{
    /**
     * Exchange-specific ID for the data provider.
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * Exchange-specific name for the data provider
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * Array of Segment (Section 3.2.22) objects that contain the
     * actual data values.
     * @var BidRequestUserDataSegment[]|null
     */
    protected ?array $segment = null;

    /**
     * Placeholder for exchange-specific extensions to OpenRTB.
     * @var array|null
     */
    protected ?array $ext = null;

    public function validate(): bool
    {
        $this->resetErrors();
        return !$this->hasErrors();
    }

    public function asArray(): array
    {
        $this->array = [
            'id' => $this->id,
        ];
        if (!is_null($this->name)) {
            $this->array['name'] = $this->name;
        }
        if (!is_null($this->segment)) {
            $this->array['segment'] = [];
            foreach ($this->segment as $item) {
                $this->array['segment'][] = $item->asArray();
            }
        }
        if (!is_null($this->ext)) {
            $this->array['ext'] = $this->ext;
        }

        return $this->array;
    }

    /**
     * @param BidRequestUserDataSegment[]|array|null $segment
     */
    public function setSegment(?array $segment): void
    {
        $this->segment = [];
        foreach ($segment as $index => $item) {
            if ($item instanceof BidRequestUserDataSegment) {
                $this->segment[$index] = $item;
            } else {
                $this->segment[$index] = new BidRequestUserDataSegment();
                $this->segment[$index]->load($item);
            }
        }
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getExt(): ?array
    {
        return $this->ext;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return BidRequestUserDataSegment[]|null
     */
    public function getSegment(): ?array
    {
        return $this->segment;
    }

}