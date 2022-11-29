<?php

namespace Ldar\RtbSpecLib\bid\response;

use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidResponseBidAdmNativeAssetData
 * @package Ldar\RtbSpecLib\bid\response
 */
class BidResponseBidAdmNativeAssetData extends Model
{
    /**
     * Required for assetsurl/dcourl
     * responses, not required for
     * embedded asset responses.  The
     * type of data element being
     * submitted from the Data Asset
     * Types table.
     * @var int|null
     */
    protected ?int $type = null;

    /**
     * Required for assetsurl/dcourl
     * responses, not required for
     * embedded asset responses.  The
     * length of the data element being
     * submitted.  Where applicable,
     * must comply with the
     * recommended maximum lengths
     * in the Data Asset Types table
     * @var int|null
     */
    protected ?int $len = null;

    /**
     * The formatted string of data to
     * be displayed. Can contain a
     * formatted value such as “5 stars”
     * or “$10” or “3.4 stars out of 5”
     * @var string|null
     */
    protected ?string $value = null;

    /**
     * @return bool
     */
    public function validate(): bool
    {
        $this->resetErrors();
        if (is_null($this->value)) {
            $this->addError('value is empty');
        }
        return !$this->hasErrors();
    }

    /**
     * @return array
     */
    public function asArray(): array
    {
        $this->array = [
            'type' => $this->type,
            'len' => $this->len,
            'value' => $this->value,
        ];
        return $this->array;
    }

    /**
     * @return int|null
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @return int|null
     */
    public function getLen(): ?int
    {
        return $this->len;
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }
}