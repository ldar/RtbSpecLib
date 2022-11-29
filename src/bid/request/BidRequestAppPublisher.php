<?php

namespace Ldar\RtbSpecLib\bid\request;

use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidRequestAppPublisher
 * @package Ldar\RtbSpecLib\bid\request
 */
class BidRequestAppPublisher extends Model
{
    /**
     * @var string|null идентификатор
     */
    protected ?string $id = null;

    /**
     * Publisher name (may be aliased at the publisher’s request).
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * Highest level domain of the publisher (e.g., “publisher.com”).
     * @var string|null
     */
    protected ?string $domain = null;

    /**
     * Array of IAB content categories of the app. Refer to List 5.1
     * @var array|null
     */
    protected ?array $cat = null;

    /**
     * Placeholder for exchange-specific extensions to OpenRTB.
     * @var null
     */
    protected $ext = null;

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
        if ($this->ext) {
            $this->array['ext'] = $this->ext;
        }
        if ($this->name) {
            $this->array['name'] = $this->name;
        }
        if ($this->domain) {
            $this->array['domain'] = $this->domain;
        }
        if ($this->cat) {
            $this->array['cat'] = $this->cat;
        }
        return $this->array;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getExt()
    {
        return $this->ext;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function getCat(): ?array
    {
        return $this->cat;
    }
}