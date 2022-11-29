<?php

namespace Ldar\RtbSpecLib\bid\response;

use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidResponseBid
 * @package Ldar\RtbSpecLib\bid\response
 */
class BidResponseBid extends Model
{
    /**
     * Bidder generated bid ID to assist with logging/tracking.
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * ID of the Imp object in the related bid request
     * @var string|null
     */
    protected ?string $impid = null;

    /**
     * Win notice URL called by the exchange if the bid wins (not
     * necessarily indicative of a delivered, viewed, or billable ad);
     * optional means of serving ad markup. Substitution macros
     * (Section 4.4) may be included in both the URL and optionally
     * returned markup.
     * @var string|null
     */
    protected ?string $nurl = null;

    /**
     * Billing notice URL called by the exchange when a winning bid
     * becomes billable based on exchange-specific business policy
     * (e.g., typically delivered, viewed, etc.). Substitution macros
     * (Section 4.4) may be included.
     * @var string|null
     */
    protected ?string $burl = null;

    /**
     * Loss notice URL called by the exchange when a bid is known to
     * have been lost. Substitution macros (Section 4.4) may be
     * included. Exchange-specific policy may preclude support for
     * loss notices or the disclosure of winning clearing prices
     * resulting in ${AUCTION_PRICE} macros being removed (i.e.,
     * replaced with a zero-length string).
     * @var string|null
     */
    protected ?string $lurl = null;

    /**
     * URL without cache-busting to an image that is representative
     * of the content of the campaign for ad quality/safety checking.
     * @var string|null
     */
    protected ?string $iurl = null;

    /**
     * Optional means of conveying ad markup in case the bid wins;
     * supersedes the win notice if markup is included in both.
     * Substitution macros (Section 4.4) may be included.
     * @var string|BidResponseBidAdmNative|null
     */
    protected $adm = null;

    /**
     * Bid price expressed as CPM although the actual transaction is
     * for a unit impression only. Note that while the type indicates
     * float, integer math is highly recommended when handling
     * currencies (e.g., BigDecimal in Java).
     * @var float|null
     */
    protected ?float $price = null;

    /**
     * Advertiser domain for block list checking (e.g., “ford.com”).
     * This can be an array of for the case of rotating creatives.
     * Exchanges can mandate that only one domain is allowed.
     * @var string[]|null
     */
    protected ?array $adomain = null;

    /**
     * A platform-specific application identifier intended to be
     * unique to the app and independent of the exchange. On
     * Android, this should be a bundle or package name (e.g.,
     * com.foo.mygame). On iOS, it is a numeric ID.
     * @var string|null
     */
    protected ?string $bundle = null;

    /**
     * Tactic ID to enable buyers to label bids for reporting to the
     * exchange the tactic through which their bid was submitted.
     * The specific usage and meaning of the tactic ID should be
     * communicated between buyer and exchanges a priori.
     * @var string|null
     */
    protected ?string $tactic = null;

    /**
     * Creative ID to assist with ad quality checking
     * @var string|null
     */
    protected ?string $crid = null;

    /**
     * Campaign ID to assist with ad quality checking; the collection
     * of creatives for which iurl should be representative.g
     * @var string|null
     */
    protected ?string $cid = null;

    /**
     * @var integer|null
     */
    protected ?int $group = null;

    /**
     * Width of the creative in device independent pixels (DIPS).
     * @var int|null
     */
    protected ?int $w = null;

    /**
     * Height of the creative in device independent pixels (DIPS).
     * @var int|null
     */
    protected ?int $h = null;

    /**
     * Language of the creative using ISO-639-1-alpha-2. The nonstandard code “xx” may also be used if the creative has no
     * linguistic content (e.g., a banner with just a company logo).
     * @var string|null
     */
    protected ?string $language = null;

    /**
     * ID of a preloaded ad to be served if the bid wins
     * @var string|null
     */
    protected ?string $adid = null;

    /**
     * Set of attributes describing the creative. Refer to List 5.3.
     * @var int[]|null
     */
    protected ?array $attr = null;

    /**
     * Reference to the deal.id from the bid request if this bid
     * pertains to a private marketplace direct deal.
     * @var string|null
     */
    protected ?string $dealid = null;

    /**
     * Creative media rating per IQG guidelines. Refer to List 5.19
     * @var int|null
     */
    protected ?int $qagmediarating = null;

    /**
     * Video response protocol of the markup if applicable. Refer to
     * List 5.8.
     * @var int|null
     */
    protected ?int $protocol = null;

    /**
     * API required by the markup if applicable. Refer to List 5.6
     * @var int|null
     */
    protected ?int $api = null;

    /**
     * IAB content categories of the creative. Refer to List 5.1.
     * @var string[]|null
     */
    protected ?array $cat = null;

    /**
     * Advisory as to the number of seconds the bidder is willing to
     * wait between the auction and the actual impression.
     * @var int|null
     */
    protected ?int $exp = null;

    /**
     * Placeholder for bidder-specific extensions to OpenRTB.
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
        if (is_null($this->impid)) {
            $this->addError('impid is empty');
        }
        if (is_null($this->nurl)) {
            $this->addError('nurl is empty');
        }
        if (is_null($this->price)) {
            $this->addError('price is empty');
        }
        if (is_null($this->crid)) {
            $this->addError('crid is empty');
        }
        if (is_null($this->cid)) {
            $this->addError('cid is empty');
        }
        if (is_null($this->adm)) {
            $this->addError('adm is empty');
        }
        if (is_null($this->w)) {
            $this->addError('w is empty');
        }
        if (is_null($this->h)) {
            $this->addError('h is empty');
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
            'impid' => $this->impid,
            'price' => $this->price,
            'crid' => $this->crid,
            'cid' => $this->cid,
        ];
        if ($this->adm instanceof BidResponseBidAdmNative) {
            $this->array['adm'] = $this->adm->asArray();
        } else {
            $this->array['adm'] = $this->adm;
        }
        if (!is_null($this->adomain)) {
            $this->array['adomain'] = $this->adomain;
        }
        if (!is_null($this->w)) {
            $this->array['w'] = $this->w;
        }
        if (!is_null($this->h)) {
            $this->array['h'] = $this->h;
        }
        if (!is_null($this->cat)) {
            $this->array['cat'] = $this->cat;
        }
        if (!is_null($this->attr)) {
            $this->array['attr'] = $this->attr;
        }
        if (!is_null($this->adid)) {
            $this->array['adid'] = $this->adid;
        }
        if (!is_null($this->language)) {
            $this->array['language'] = $this->language;
        }
        if (!is_null($this->group)) {
            $this->array['group'] = $this->group;
        }
        if (!is_null($this->iurl)) {
            $this->array['iurl'] = $this->iurl;
        }
        if (!is_null($this->lurl)) {
            $this->array['lurl'] = $this->lurl;
        }
        if (!is_null($this->burl)) {
            $this->array['burl'] = $this->burl;
        }
        if (!is_null($this->nurl)) {
            $this->array['nurl'] = $this->nurl;
        }
        if (!is_null($this->tactic)) {
            $this->array['tactic'] = $this->tactic;
        }
        if (!is_null($this->dealid)) {
            $this->array['dealid'] = $this->dealid;
        }
        if (!is_null($this->qagmediarating)) {
            $this->array['qagmediarating'] = $this->qagmediarating;
        }
        if (!is_null($this->protocol)) {
            $this->array['protocol'] = $this->protocol;
        }
        if (!is_null($this->api)) {
            $this->array['api'] = $this->api;
        }
        if (!is_null($this->exp)) {
            $this->array['exp'] = $this->exp;
        }
        if (!is_null($this->ext)) {
            $this->array['ext'] = $this->ext;
        }
        return $this->array;
    }

    /**
     * @param string|BidResponseBidAdmNative|array|null $adm
     */
    public function setAdm($adm): void
    {
        if (is_string($adm)) {
            if ($adm[0] === '{') {
                $adm = json_decode($adm, true);
            } else {
                $this->adm = $adm;
            }
        }
        if ($adm instanceof BidResponseBidAdmNative) {
            $this->adm = $adm;
        }
        if (is_array($adm)) {
            $this->adm = new BidResponseBidAdmNative();
            $this->adm->load($adm);
        }
    }

    /**
     * @return int|null
     */
    public function getGroup(): ?int
    {
        return $this->group;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return array|string|null|BidResponseBidAdmNative
     */
    public function getAdm($type = 'array')
    {
        if ($this->adm instanceof BidResponseBidAdmNative) {
            if ($type === 'array') {
                return $this->adm->asArray();
            }
            if ($type === 'object') {
                return $this->adm;
            }
            return $this->adm->asJson();
        }
        return $this->adm;
    }

    /**
     * @return string|array|null
     */
    public function getAdomain()
    {
        return $this->adomain;
    }

    public function getBurl(): ?string
    {
        return $this->burl;
    }

    public function setBurl(?string $burl): void
    {
        $this->burl = $burl;
    }

    public function getNurl(): ?string
    {
        return $this->nurl;
    }

    public function setNurl(?string $nurl): void
    {
        $this->nurl = $nurl;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function getCid(): ?string
    {
        return $this->cid;
    }

    public function getCrid(): ?string
    {
        return $this->crid;
    }

    public function getImpid(): ?string
    {
        return $this->impid;
    }

    public function getW(): ?int
    {
        return $this->w;
    }

    public function getH(): ?int
    {
        return $this->h;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function getIurl(): ?string
    {
        return $this->iurl;
    }

    public function getLurl(): ?string
    {
        return $this->lurl;
    }

    public function getAdid(): ?string
    {
        return $this->adid;
    }

    public function getCat(): ?array
    {
        return $this->cat;
    }

    public function getDealid(): ?string
    {
        return $this->dealid;
    }

    public function getAttr(): ?array
    {
        return $this->attr;
    }

    public function getTactic(): ?string
    {
        return $this->tactic;
    }

    public function getBundle(): ?string
    {
        return $this->bundle;
    }

    public function getQagmediarating(): ?int
    {
        return $this->qagmediarating;
    }

    public function getExt()
    {
        return $this->ext;
    }

    public function getExp(): ?int
    {
        return $this->exp;
    }

    public function getApi(): ?int
    {
        return $this->api;
    }

    public function getProtocol(): ?int
    {
        return $this->protocol;
    }
}