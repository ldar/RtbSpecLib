<?php

namespace Ldar\RtbSpecLib\bid\request;

use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidRequestImp
 * @package Ldar\RtbSpecLib\bid\request
 */
class BidRequestImpMetric extends Model
{

    /**
     * Type of metric being presented using exchange curated string
     * names which should be published to bidders a priori.
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * Number representing the value of the metric. Probabilities
     * must be in the range 0.0 – 1.0.
     * @var float|null
     */
    protected ?float $value = null;

    /**
     * Source of the value using exchange curated string names
     * which should be published to bidders a priori. If the exchange
     * itself is the source versus a third party, “EXCHANGE” is
     * recommended.
     * @var string|null
     */
    protected ?string $vendor = null;

    /**
     * Placeholder for exchange-specific extensions to OpenRTB.
     * type json
     * @var string|null
     */
    protected ?string $ext = null;

    public function validate(): bool
    {
        $this->resetErrors();
        if (is_null($this->type)) {
            $this->addError('Type is empty');
        }
        if (is_null($this->value)) {
            $this->addError('Value is empty');
        }
        return !$this->hasErrors();
    }


    public function asArray(): array
    {
        $this->array = [
            'type' => $this->type,
            'value' => $this->value,
        ];
        if (!is_null($this->vendor)) {
            $this->array['vendor'] = $this->vendor;
        }
        if (!is_null($this->ext)) {
            $this->array['ext'] = $this->ext;
        }
        return $this->array;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function getExt(): ?string
    {
        return $this->ext;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getVendor(): ?string
    {
        return $this->vendor;
    }
}