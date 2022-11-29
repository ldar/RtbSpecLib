<?php

namespace Ldar\RtbSpecLib\bid\request;

use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidRequestSource
 * @package Ldar\RtbSpecLib\bid\request
 */
class BidRequestSource extends Model
{
    /**
     * Entity responsible for the final impression sale decision, where
     * 0 = exchange, 1 = upstream source.
     * @var int|null
     */
    protected ?int $fd = null;

    /**
     * Transaction ID that must be common across all participants in
     * this bid request (e.g., potentially multiple exchanges).
     * @var string|null
     */
    protected ?string $tid = null;

    /**
     * Payment ID chain string containing embedded syntax
     * described in the TAG Payment ID Protocol v1.0
     * @var string|null
     */
    protected ?string $pchain = null;

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

    public function asArray(): array
    {
        if (!is_null($this->fd)) {
            $this->array['fd'] = $this->fd;
        }
        if (!is_null($this->tid)) {
            $this->array['tid'] = $this->tid;
        }
        if (!is_null($this->pchain)) {
            $this->array['pchain'] = $this->pchain;
        }
        if (!is_null($this->ext)) {
            $this->array['ext'] = $this->ext;
        }
        return $this->array;
    }

    public function getFd(): ?int
    {
        return $this->fd;
    }

    public function getTid(): ?string
    {
        return $this->tid;
    }

    public function getExt()
    {
        return $this->ext;
    }

    public function getPchain(): ?string
    {
        return $this->pchain;
    }

}