<?php

namespace Ldar\RtbSpecLib\bid\request;

use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidRequestNativeRequest
 * @package Ldar\RtbSpecLib\bid\request
 * https://www.iab.com/wp-content/uploads/2018/03/OpenRTB-Native-Ads-Specification-Final-1.2.pdf
 */
class BidRequestNativeRequestEventtrackers extends Model
{
    /**
     * Type    of event available    for
     * tracking. See Event Types table.
     * @var int|null
     */
    protected ?int $event = null;

    /**
     * Array    of    the    types    of    tracking
     * available    for    the    given    event.
     * See    Event    Tracking    Methods
     * table.
     * @var int[]|null
     */
    protected ?array $methods = null;

    /**
     * This object    is    a    placeholder    that
     * may contain    custom    JSON
     * agreed to    by    the    parties    to
     * support flexibility    beyond    the
     * standard defined in this specification
     * @var null
     */
    protected $ext = null;

    public function validate(): bool
    {
        $this->resetErrors();
        if (is_null($this->event)) {
            $this->addError('Event is empty');
        }
        if (is_null($this->methods)) {
            $this->addError('Methods is empty');
        }
        return !$this->hasErrors();
    }


    public function asArray(): array
    {
        $this->array = [
            'event' => $this->event,
            'methods' => $this->methods,
        ];
        if ($this->ext) {
            $this->array['ext'] = $this->ext;
        }
        return $this->array;
    }

    public function getExt()
    {
        return $this->ext;
    }

    public function getEvent(): ?int
    {
        return $this->event;
    }

    /**
     * @return int[]|null
     */
    public function getMethods(): ?array
    {
        return $this->methods;
    }

}