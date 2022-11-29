<?php

namespace Ldar\RtbSpecLib\bid\request;

use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidRequestSite
 * @package Ldar\RtbSpecLib\bid\request
 */
class BidRequestSite extends Model
{
    /**
     * Exchange-specific site ID.
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * Site name (may be aliased at the publisher’s request).
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * Domain of the site (e.g., “mysite.foo.com”)
     * @var string|null
     */
    protected ?string $domain = null;

    /**
     * URL of the page where the impression will be shown.
     * @var string|null
     */
    protected ?string $page = null;

    /**
     * Referrer URL that caused navigation to the current page.
     * @var string|null
     */
    protected ?string $ref = null;

    /**
     * Array of IAB content categories of the site. Refer to List 5.1
     * @var array|null категории сайта
     */
    protected ?array $cat = null;

    /**
     * Array of IAB content categories that describe the current
     * section of the site. Refer to List 5.1.
     * @var array|null
     */
    protected ?array $sectioncat = null;

    /**
     * Array of IAB content categories that describe the current page
     * or view of the site. Refer to List 5.1.
     * @var array|null
     */
    protected ?array $pagecat = null;

    /**
     * Search string that caused navigation to the current page.
     * @var string|null
     */
    protected ?string $search = null;

    /**
     * Indicates if the site has been programmed to optimize layout
     * when viewed on mobile devices, where 0 = no, 1 = yes.
     * @var int|null
     */
    protected ?int $mobile = null;

    /**
     * Indicates if the site has a privacy policy, where 0 = no, 1 = yes.
     * @var int|null
     */
    protected ?int $privacypolicy = null;

    /**
     * Comma separated list of keywords about the site.
     * @var string|null
     */
    protected ?string $keywords = null;

    /**
     * Placeholder for exchange-specific extensions to OpenRTB
     * @var null
     */
    protected $ext = null;


    protected ?BidRequestSitePublisher $publisher = null;
    protected ?BidRequestSiteContent $content = null;

    public function validate(): bool
    {
        $this->resetErrors();
        if (is_null($this->id)) {
            $this->addError('Id is empty');
        }
        if (is_null($this->domain)) {
            $this->addError('Domain is empty');
        }
        if (is_null($this->page)) {
            $this->addError('Page is empty');
        }
        if (is_null($this->publisher)) {
            $this->addError('Publisher is empty');
        } else if (!$this->publisher->validate()) {
            $this->addError("Publisher: " . $this->publisher->getErrorsAsString());
        }
        if ($this->content && !$this->content->validate()) {
            $this->addError("Content: " . $this->content->getErrorsAsString());
        }
        return !$this->hasErrors();
    }

    public function asArray(): array
    {
        $this->array = [
            'id' => $this->id,
            'domain' => $this->domain,
            'page' => $this->page,
        ];
        if (!is_null($this->publisher)) {
            $this->array['publisher'] = $this->publisher->asArray();
        }
        if (!is_null($this->ref)) {
            $this->array['ref'] = $this->ref;
        }
        if (!is_null($this->cat)) {
            $this->array['cat'] = $this->cat;
        }
        if (!is_null($this->name)) {
            $this->array['name'] = $this->name;
        }
        if (!is_null($this->content)) {
            $this->array['content'] = $this->content->asArray();
        }
        if (!is_null($this->sectioncat)) {
            $this->array['sectioncat'] = $this->sectioncat;
        }
        if (!is_null($this->pagecat)) {
            $this->array['pagecat'] = $this->pagecat;
        }
        if (!is_null($this->search)) {
            $this->array['search'] = $this->search;
        }
        if (!is_null($this->mobile)) {
            $this->array['mobile'] = $this->mobile;
        }
        if (!is_null($this->privacypolicy)) {
            $this->array['privacypolicy'] = $this->privacypolicy;
        }
        if (!is_null($this->keywords)) {
            $this->array['keywords'] = $this->keywords;
        }
        if (!is_null($this->ext)) {
            $this->array['ext'] = $this->ext;
        }
        return $this->array;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function getCat(): ?array
    {
        return $this->cat;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function getPage(): ?string
    {
        return $this->page;
    }

    public function setPublisher($values): void
    {
        if ($values instanceof BidRequestSitePublisher) {
            $this->publisher = $values;
        }
        if (is_array($values)) {
            $this->publisher = new BidRequestSitePublisher();
            $this->publisher->load($values);
        }
    }

    public function getPublisher(): ?BidRequestSitePublisher
    {
        return $this->publisher;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getContent(): ?BidRequestSiteContent
    {
        return $this->content;
    }

    public function setContent($content): void
    {
        if ($content instanceof BidRequestSiteContent) {
            $this->content = $content;
        }
        if (is_array($content)) {
            $this->content = new BidRequestSiteContent();
            $this->content->load($content);
        }
    }

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function getExt()
    {
        return $this->ext;
    }

    public function getMobile(): ?int
    {
        return $this->mobile;
    }

    public function getSectioncat(): ?array
    {
        return $this->sectioncat;
    }

    public function getPrivacypolicy(): ?int
    {
        return $this->privacypolicy;
    }

    public function getPagecat(): ?array
    {
        return $this->pagecat;
    }

    public function getSearch(): ?string
    {
        return $this->search;
    }

}