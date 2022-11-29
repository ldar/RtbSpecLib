<?php

namespace Ldar\RtbSpecLib\bid\request;

use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidRequestApp
 * @package Ldar\RtbSpecLib\bid\request
 */
class BidRequestApp extends Model
{
    /**
     * @var string|null идентификатор
     */
    protected ?string $id = null;

    /**
     * App name (may be aliased at the publisher’s request).
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * A platform-specific application identifier intended to be
     * unique to the app and independent of the exchange. On
     * Android, this should be a bundle or package name (e.g.,
     * com.foo.mygame). On iOS, it is typically a numeric ID.
     * @var string|null
     */
    protected ?string $bundle = null;

    /**
     * Domain of the app (e.g., “mygame.foo.com”).
     * @var string|null
     */
    protected ?string $domain = null;

    /**
     * App store URL for an installed app; for IQG 2.1 compliance.
     * @var string|null
     */
    protected ?string $storeurl = null;

    /**
     * Array of IAB content categories of the app. Refer to List 5.1
     * @var array|null
     */
    protected ?array $cat = null;

    /**
     * Array of IAB content categories that describe the current
     * section of the app. Refer to List 5.1.
     * @var array|null
     */
    protected ?array $sectioncat = null;

    /**
     * Array of IAB content categories that describe the current page
     * or view of the app. Refer to List 5.1
     * @var array|null
     */
    protected ?array $pagecat = null;

    /**
     * Application version.
     * @var string|null
     */
    protected ?string $ver = null;

    /**
     * Indicates if the app has a privacy policy, where 0 = no, 1 = yes.
     * @var int|null
     */
    protected ?int $privacypolicy = null;

    /**
     * 0 = app is free, 1 = the app is a paid version
     * @var int|null
     */
    protected ?int $paid = null;

    /**
     * Details about the Publisher (Section 3.2.15) of the app.
     * @var BidRequestAppPublisher|null
     */
    protected ?BidRequestAppPublisher $publisher = null;

    /**
     * Details about the Content (Section 3.2.16) within the app.
     * @var BidRequestAppContent|null
     */
    protected ?BidRequestAppContent $content = null;

    /**
     * Comma separated list of keywords about the app.
     * @var string|null
     */
    protected ?string $keywords = null;

    /**
     * Placeholder for exchange-specific extensions to OpenRTB.
     * @var null
     */
    protected $ext = null;

    public function validate(): bool
    {
        $this->resetErrors();
        if (is_null($this->id)) {
            $this->addError('Id is empty');
        }
        if ($this->publisher && !$this->publisher->validate()) {
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
        ];
        if ($this->pagecat) {
            $this->array['pagecat'] = $this->pagecat;
        }
        if ($this->privacypolicy) {
            $this->array['privacypolicy'] = $this->privacypolicy;
        }
        if ($this->sectioncat) {
            $this->array['sectioncat'] = $this->sectioncat;
        }
        if ($this->ext) {
            $this->array['ext'] = $this->ext;
        }
        if ($this->keywords) {
            $this->array['keywords'] = $this->keywords;
        }
        if ($this->name) {
            $this->array['name'] = $this->name;
        }
        if ($this->domain) {
            $this->array['domain'] = $this->domain;
        }
        if (!is_null($this->content)) {
            $this->array['content'] = $this->content->asArray();
        }
        if ($this->bundle) {
            $this->array['bundle'] = $this->bundle;
        }
        if ($this->cat) {
            $this->array['cat'] = $this->cat;
        }
        if ($this->paid) {
            $this->array['paid'] = $this->paid;
        }
        if ($this->publisher) {
            $this->array['publisher'] = $this->publisher->asArray();
        }
        if ($this->storeurl) {
            $this->array['storeurl'] = $this->storeurl;
        }
        if ($this->ver) {
            $this->array['ver'] = $this->ver;
        }

        return $this->array;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getPagecat(): ?array
    {
        return $this->pagecat;
    }

    public function getPrivacypolicy(): ?int
    {
        return $this->privacypolicy;
    }

    public function getSectioncat(): ?array
    {
        return $this->sectioncat;
    }

    public function getExt()
    {
        return $this->ext;
    }

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getBundle(): ?string
    {
        return $this->bundle;
    }

    public function getCat(): ?array
    {
        return $this->cat;
    }

    public function getPaid(): ?int
    {
        return $this->paid;
    }

    /**
     * @return BidRequestAppPublisher|null
     */
    public function getPublisher(): ?BidRequestAppPublisher
    {
        return $this->publisher;
    }

    public function setPublisher($values): void
    {
        if ($values instanceof BidRequestAppPublisher) {
            $this->publisher = $values;
        }
        if (is_array($values)) {
            $this->publisher = new BidRequestAppPublisher();
            $this->publisher->load($values);
        }
    }

    public function setContent($content): void
    {
        if ($content instanceof BidRequestAppContent) {
            $this->content = $content;
        }
        if (is_array($content)) {
            $this->content = new BidRequestAppContent();
            $this->content->load($content);
        }
    }

    public function getStoreurl(): ?string
    {
        return $this->storeurl;
    }

    public function getVer(): ?string
    {
        return $this->ver;
    }

}