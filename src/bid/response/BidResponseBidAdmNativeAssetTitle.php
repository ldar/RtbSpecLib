<?php

namespace Ldar\RtbSpecLib\bid\response;

use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidResponseBidAdmNativeAssetTitle
 * @package Ldar\RtbSpecLib\bid\response
 */
class BidResponseBidAdmNativeAssetTitle extends Model
{
    /**
     * The text associated with the text
     * element
     * @var string|null
     */
    protected ?string $text = null;

    /**
     * The length of the title being
     * provided.  Required if using
     * assetsurl/dcourl representation,
     * optional if using embedded asset
     * representation.
     * @var int|null
     */
    protected ?int $len = null;

    /**
     * @return bool
     */
    public function validate(): bool
    {
        $this->resetErrors();
        if (is_null($this->text)) {
            $this->addError('text is empty');
        }
        return !$this->hasErrors();
    }

    /**
     * @return array
     */
    public function asArray(): array
    {
        $this->array = [
            'text' => $this->text,
            'len' => $this->len,
        ];
        return $this->array;
    }

    /**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @return int|null
     */
    public function getLen(): ?int
    {
        return $this->len;
    }
}