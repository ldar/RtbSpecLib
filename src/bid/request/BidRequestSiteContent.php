<?php

namespace Ldar\RtbSpecLib\bid\request;

use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidRequestSiteContent
 * @package Ldar\RtbSpecLib\bid\request
 */
class BidRequestSiteContent extends Model
{
    /**
     * ID uniquely identifying the content.
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * Episode number.
     * @var int|null
     */
    protected ?int $episode = null;

    /**
     * Content title.
     * Video Examples: “Search Committee” (television), “A New
     * Hope” (movie), or “Endgame” (made for web).
     * Non-Video Example: “Why an Antarctic Glacier Is Melting So
     * Quickly” (Time magazine article).
     * @var string|null
     */
    protected ?string $title = null;

    /**
     * Content series.
     * Video Examples: “The Office” (television), “Star Wars” (movie),
     * or “Arby ‘N’ The Chief” (made for web).
     * Non-Video Example: “Ecocentric” (Time Magazine blog).
     * @var string|null
     */
    protected ?string $series = null;

    /**
     * Content season (e.g., “Season 3”).
     * @var string|null
     */
    protected ?string $season = null;

    /**
     * Artist credited with the content.
     * @var string|null
     */
    protected ?string $artist = null;

    /**
     * Genre that best describes the content (e.g., rock, pop, etc).
     * @var string|null
     */
    protected ?string $genre = null;

    /**
     * Album to which the content belongs; typically for audio.
     * @var string|null
     */
    protected ?string $album = null;

    /**
     * International Standard Recording Code conforming to ISO3901.
     * @var string|null
     */
    protected ?string $isrc = null;

    /**
     * URL of the content, for buy-side contextualization or review.
     * @var string|null
     */
    protected ?string $url = null;

    /**
     * Production quality. Refer to List 5.13.
     * @var int|null
     */
    protected ?int $prodq = null;

    /**
     * Type of content (game, video, text, etc.). Refer to List 5.18.
     * @var int|null
     */
    protected ?int $context = null;

    /**
     * Content rating (e.g., MPAA).
     * @var string|null
     */
    protected ?string $contentrating = null;

    /**
     * User rating of the content (e.g., number of stars, likes, etc.).
     * @var string|null
     */
    protected ?string $userrating = null;

    /**
     * Media rating per IQG guidelines. Refer to List 5.19.
     * @var int|null
     */
    protected ?int $qagmediarating = null;

    /**
     * Comma separated list of keywords describing the content
     * @var string|null
     */
    protected ?string $keywords = null;

    /**
     * 0 = not live, 1 = content is live (e.g., stream, live blog).
     * @var int|null
     */
    protected ?int $livestream = null;

    /**
     * 0 = indirect, 1 = direct.
     * @var int|null
     */
    protected ?int $sourcerelationship = null;

    /**
     * Length of content in seconds; appropriate for video or audio.
     * @var int|null
     */
    protected ?int $len = null;

    /**
     * Content language using ISO-639-1-alpha-2.
     * @var string|null
     */
    protected ?string $language = null;

    /**
     * Indicator of whether or not the content is embeddable (e.g.,
     * an embeddable video player), where 0 = no, 1 = yes.
     * @var int|null
     */
    protected ?int $embeddable = null;

    /**
     * Additional content data. Each Data object (Section 3.2.21)
     * represents a different data source.
     * @var null
     */
    protected $data = null;

    /**
     * Details about the content Producer (Section 3.2.17).
     * @var BidRequestSiteContentProducer|null
     */
    protected ?BidRequestSiteContentProducer $producer = null;

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

    /**
     * @return bool
     */
    public function validate(): bool
    {
        $this->resetErrors();
        if (is_null($this->id)) {
            $this->addError('Id is empty');
        }
        if ($this->producer && !$this->producer->validate()) {
            $this->addError("Producer: " . $this->producer->getErrorsAsString());
        }
        return !$this->hasErrors();
    }

    /**
     * @return array
     */
    public function asArray(): array
    {
        $this->array = [
            'id' => $this->id,
        ];
        if ($this->episode) {
            $this->array['episode'] = $this->episode;
        }
        if ($this->title) {
            $this->array['title'] = $this->title;
        }
        if ($this->series) {
            $this->array['series'] = $this->series;
        }
        if ($this->season) {
            $this->array['season'] = $this->season;
        }
        if ($this->artist) {
            $this->array['artist'] = $this->artist;
        }
        if ($this->genre) {
            $this->array['genre'] = $this->genre;
        }
        if ($this->album) {
            $this->array['album'] = $this->album;
        }
        if ($this->isrc) {
            $this->array['isrc'] = $this->isrc;
        }
        if ($this->producer) {
            $this->array['producer'] = $this->producer->asArray();
        }
        if ($this->url) {
            $this->array['url'] = $this->url;
        }
        if ($this->prodq) {
            $this->array['prodq'] = $this->prodq;
        }
        if ($this->context) {
            $this->array['context'] = $this->context;
        }
        if ($this->contentrating) {
            $this->array['contentrating'] = $this->contentrating;
        }
        if ($this->userrating) {
            $this->array['userrating'] = $this->userrating;
        }
        if ($this->qagmediarating) {
            $this->array['qagmediarating'] = $this->qagmediarating;
        }
        if ($this->keywords) {
            $this->array['keywords'] = $this->keywords;
        }
        if ($this->livestream) {
            $this->array['livestream'] = $this->livestream;
        }
        if ($this->sourcerelationship) {
            $this->array['sourcerelationship'] = $this->sourcerelationship;
        }
        if ($this->len) {
            $this->array['len'] = $this->len;
        }
        if ($this->language) {
            $this->array['language'] = $this->language;
        }
        if ($this->embeddable) {
            $this->array['embeddable'] = $this->embeddable;
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

    public function getContext(): ?int
    {
        return $this->context;
    }

    public function getAlbum(): ?string
    {
        return $this->album;
    }

    public function getArtist(): ?string
    {
        return $this->artist;
    }

    public function getContentrating(): ?string
    {
        return $this->contentrating;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getEmbeddable(): ?int
    {
        return $this->embeddable;
    }

    public function getEpisode(): ?int
    {
        return $this->episode;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function getIsrc(): ?string
    {
        return $this->isrc;
    }

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function getLen(): ?int
    {
        return $this->len;
    }

    public function getLivestream(): ?int
    {
        return $this->livestream;
    }

    public function getProdq(): ?int
    {
        return $this->prodq;
    }

    public function getProducer(): BidRequestSiteContentProducer
    {
        return $this->producer;
    }

    public function setProducer($values): void
    {
        if ($values instanceof BidRequestSiteContentProducer) {
            $this->producer = $values;
        }
        if (is_array($values)) {
            $this->producer = new BidRequestSiteContentProducer();
            $this->producer->load($values);
        }
    }

    public function getQagmediarating(): ?int
    {
        return $this->qagmediarating;
    }

    public function getSeason(): ?string
    {
        return $this->season;
    }

    public function getSeries(): ?string
    {
        return $this->series;
    }

    public function getSourcerelationship(): ?int
    {
        return $this->sourcerelationship;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getUserrating(): ?string
    {
        return $this->userrating;
    }
}