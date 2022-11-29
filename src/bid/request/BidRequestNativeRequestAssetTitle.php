<?php

namespace Ldar\RtbSpecLib\bid\request;

use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidRequestNativeRequestAssetTitle
 * @package Ldar\RtbSpecLib\bid\request
 */
class BidRequestNativeRequestAssetTitle extends Model
{
    /**
     * Maximum    length    of    the    text    in
     * the    title    element.
     * Recommended    to    be    25,    90,    or
     * 140.
     * @var int|null
     */
    protected ?int $len = null;

    /**
     * This    object    is    a    placeholder    that
     * may    contain    custom    JSON
     * agreed    to    by    the    parties    to
     * support    flexibility    beyond    the
     * standard    defined    in    this
     * specification
     * @var null
     */
    protected $ext = null;

    /**
     * @return bool
     */
    public function validate(): bool
    {
        $this->resetErrors();
        if (is_null($this->len)) {
            $this->addError('len is empty');
        }
        return !$this->hasErrors();
    }

    public function asArray(): array
    {
        $this->array = [
            'len' => $this->len,
        ];

        if ($this->ext) {
            $this->array['ext'] = $this->ext;
        }
        return $this->array;
    }

    public function getLen(): ?int
    {
        return $this->len;
    }

    public function getExt()
    {
        return $this->ext;
    }
}