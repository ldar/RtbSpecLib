<?php

namespace Ldar\RtbSpecLib\bid\request;

use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidRequestUserDataSegment
 * @package Ldar\RtbSpecLib\bid\request
 */
class BidRequestUserDataSegment extends Model
{
    /**
     * ID of the data segment specific to the data provider
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * Name of the data segment specific to the data provider.r
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * String representation of the data segment value.
     * @var string|null
     */
    protected ?string $value = null;

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
        if (!is_null($this->ext)) {
            $this->array['ext'] = $this->ext;
        }
        return $this->array;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getExt(): ?array
    {
        return $this->ext;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}