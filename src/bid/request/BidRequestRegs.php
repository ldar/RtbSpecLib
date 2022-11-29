<?php

namespace Ldar\RtbSpecLib\bid\request;

use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidRequestRegs
 * @package Ldar\RtbSpecLib\bid\request
 */
class BidRequestRegs extends Model
{
    /**
     * Flag indicating if this request is subject to the COPPA
     * regulations established by the USA FTC, where 0 = no, 1 = yes.
     * Refer to Section 7.5 for more information.
     * @var int|null
     */
    protected ?int $coppa = null;

    /**
     * Placeholder for exchange-specific extensions to OpenRTB.
     * @var null
     */
    protected $ext = null;

    /**
     * @return bool
     */
    public function validate(): bool
    {
        $this->resetErrors();
        return !$this->hasErrors();
    }


    /**
     * @return array
     */
    public function asArray(): array
    {
        if (!is_null($this->coppa)) {
            $this->array['coppa'] = $this->coppa;
        }
        if (!is_null($this->ext)) {
            $this->array['ext'] = $this->ext;
        }
        return $this->array;
    }

    /**
     * @return int|null
     */
    public function getCoppa(): ?int
    {
        return $this->coppa;
    }

    /**
     * @return null
     */
    public function getExt()
    {
        return $this->ext;
    }

}