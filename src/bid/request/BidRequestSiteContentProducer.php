<?php

namespace Ldar\RtbSpecLib\bid\request;

use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidRequestSiteContentProducer
 * @package Ldar\RtbSpecLib\bid\request
 */
class BidRequestSiteContentProducer extends Model
{
    /**
     * Content producer or originator ID. Useful if content is
     * syndicated and may be posted on a site using embed tags
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * Content producer or originator name (e.g., “Warner Bros”).
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * Highest level domain of the content producer (e.g.,
     * “producer.com”).
     * @var string|null
     */
    protected ?string $domain = null;

    /**
     * Array of IAB content categories of the site. Refer to List 5.1
     * @var array|null категории сайта
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
        if ($this->name) {
            $this->array['name'] = $this->name;
        }
        if ($this->domain) {
            $this->array['domain'] = $this->domain;
        }
        if ($this->cat) {
            $this->array['cat'] = $this->cat;
        }
        if ($this->ext) {
            $this->array['ext'] = $this->ext;
        }
        return $this->array;
    }

    public function getCat(): ?array
    {
        return $this->cat;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getExt()
    {
        return $this->ext;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}