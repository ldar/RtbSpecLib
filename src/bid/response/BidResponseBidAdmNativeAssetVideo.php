<?php

namespace Ldar\RtbSpecLib\bid\response;

use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidResponseBidAdmNativeAssetVideo
 * @package Ldar\RtbSpecLib\bid\response
 */
class BidResponseBidAdmNativeAssetVideo extends Model
{
    /**
     * Corresponds to the Video Object in the request, yet containing a value of a conforming  VAST
     * tag as a value.
     * @var string|null
     */
    protected ?int $vasttag = null;

    /**
     * @return bool
     */
    public function validate(): bool
    {
        $this->resetErrors();
        if (is_null($this->vasttag)) {
            $this->addError('vasttag is empty');
        }
        return !$this->hasErrors();
    }

    public function asArray(): array
    {
        $this->array = [
            'vasttag' => $this->vasttag,
        ];
        return $this->array;
    }

    public function getVasttag()
    {
        return $this->vasttag;
    }
}