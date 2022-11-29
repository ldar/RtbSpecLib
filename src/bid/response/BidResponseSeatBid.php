<?php

namespace Ldar\RtbSpecLib\bid\response;

use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidResponseSeatBid
 * @package Ldar\RtbSpecLib\bid\response
 */
class BidResponseSeatBid extends Model
{
    /**
     * Array of 1+ Bid objects (Section 4.2.3) each related to an
     * impression. Multiple bids can relate to the same impression.
     * @var BidResponseBid[]|null
     */
    protected ?array $bid = null;

    /**
     * ID of the buyer seat (e.g., advertiser, agency) on whose behalf
     * this bid is made.
     * @var string|null
     */
    protected ?string $seat = null;

    /**
     * 0 = impressions can be won individually; 1 = impressions must
     * be won or lost as a group.
     * @var integer
     */
    protected int $group = 0;

    /**
     * Placeholder for bidder-specific extensions to OpenRTB.
     * @var null
     */
    protected $ext = null;

    public function validate(): bool
    {
        $this->resetErrors();
        if (is_null($this->bid)) {
            $this->addError('Bid is empty');
        } else {
            foreach ($this->bid as $item) {
                if (!$item->validate()) {
                    $this->addError('Bid: ' . $item->getErrorsAsString());
                }
            }
        }
        return !$this->hasErrors();
    }

    public function asArray(): array
    {
        $this->array = [
            'bid' => $this->getBidAsArray(),
        ];
        if (!is_null($this->seat)) {
            $this->array['seat'] = $this->seat;
        }
        if (!is_null($this->group)) {
            $this->array['group'] = $this->group;
        }
        if (!is_null($this->ext)) {
            $this->array['ext'] = $this->ext;
        }

        return $this->array;
    }

    private function getBidAsArray(): array
    {
        $data = [];
        foreach ($this->bid as $index => $item) {
            $data[] = $item->asArray();
        }
        return $data;
    }

    protected function setBid(array $items)
    {
        $this->bid = [];
        foreach ($items as $index => $values) {
            if ($values instanceof BidResponseBid) {
                $this->bid[$index] = $values;
            } else {
                $this->bid[$index] = new BidResponseBid();
                if (!$this->bid[$index]->load($values)) {
                    $this->addError('Failed load data in BidResponseBid');
                }
            }
        }
    }

    /**
     * @return BidResponseBid[]|null
     */
    public function getBid(): ?array
    {
        return $this->bid;
    }

    public function getSeat(): ?string
    {
        return $this->seat;
    }

    public function getGroup(): int
    {
        return $this->group;
    }

    public function getExt()
    {
        return $this->ext;
    }

}