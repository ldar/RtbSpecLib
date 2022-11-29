<?php

namespace Ldar\RtbSpecLib\bid\request;

use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidRequest
 * @package Ldar\RtbSpecLib\bid\request
 */
class BidRequest extends Model
{
    public const TYPE_BANNER = 'banner';
    public const TYPE_NATIVE = 'native';
    public const TYPE_PUSH = 'push';

    /**
     * date time UTC ( время, формат12:25:02)
     * @var string|null
     */
    protected ?string $datetime = null;

    /**
     * Unique ID of the bid request, provided by the exchange.
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * Array of allowed currencies for bids on this bid request using
     * ISO-4217 alpha codes. Recommended only if the exchange
     * accepts multiple currencies
     * @var array|null
     */
    protected ?array $cur = null;

    /**
     * Auction type, where 1 = First Price, 2 = Second Price Plus.
     * Exchange-specific auction types can be defined using values
     * greater than 500.
     * @var int|null
     */
    protected ?int $at = null;

    /**
     * Maximum time in milliseconds the exchange allows for bids to
     * be received including Internet latency to avoid timeout. This
     * value supersedes any a priori guidance from the exchange
     * @var int|null
     */
    protected ?int $tmax = null;


    /**
     * White list of buyer seats (e.g., advertisers, agencies) allowed
     * to bid on this impression. IDs of seats and knowledge of the
     * buyer’s customers to which they refer must be coordinated
     * between bidders and the exchange a priori. At most, only one
     * of wseat and bseat should be used in the same request.
     * Omission of both implies no seat restrictions.
     * @var array|null
     */
    protected ?array $wseat = null;

    /**
     * Block list of buyer seats (e.g., advertisers, agencies) restricted
     * from bidding on this impression. IDs of seats and knowledge
     * of the buyer’s customers to which they refer must be
     * coordinated between bidders and the exchange a priori. At
     * most, only one of wseat and bseat should be used in the
     * same request. Omission of both implies no seat restrictions
     * @var array|null
     */
    protected ?array $bseat = null;

    /**
     * Flag to indicate if Exchange can verify that the impressions
     * offered represent all of the impressions available in context
     * (e.g., all on the web page, all video spots such as pre/mid/post
     * roll) to support road-blocking. 0 = no or unknown, 1 = yes, the
     * impressions offered represent all that are available
     * @var int
     */
    protected int $allimps = 0;

    /**
     * White list of languages for creatives using ISO-639-1-alpha-2.
     * Omission implies no specific restrictions, but buyers would be
     * advised to consider language attribute in the Device and/or
     * Content objects if available.
     * @var array|null
     */
    protected ?array $wlang = null;

    protected ?BidRequestSite $site = null;
    protected ?BidRequestUser $user = null;
    protected ?BidRequestDevice $device = null;
    protected ?BidRequestApp $app = null;

    /**
     * @var BidRequestImp[]|null
     */
    protected ?array $imp = null;
    protected ?string $bidId = null;
    protected ?string $type = null;

    /**
     * Placeholder for exchange-specific extensions to OpenRTB.
     * @var array|null
     */
    protected ?array $ext = null;

    /**
     * Blocked advertiser categories using the IAB content
     * categories. Refer to List 5.1
     * @var string[]|null
     */
    protected ?array $bcat = null;

    /**
     * Block list of advertisers by their domains (e.g., “ford.com”).
     * @var array|null
     */
    protected ?array $badv= null;

    /**
     * Block list of applications by their platform-specific exchangeindependent application identifiers. On Android, these should
     * be bundle or package names (e.g., com.foo.mygame). On iOS,
     * these are numeric IDs
     * @var array|null
     */
    protected ?array $bapp= null;

    /**
     * A Sorce object (Section 3.2.2) that provides data about the
     * inventory source and which entity makes the final decision.
     * @var BidRequestSource|null
     */
    protected ?BidRequestSource $source= null;

    /**
     * A Regs object (Section 3.2.3) that specifies any industry, legal,
     * or governmental regulations in force for this request.
     * @var BidRequestRegs|null
     */
    protected ?BidRequestRegs $regs= null;

    public function validate(): bool
    {
        $this->resetErrors();
        if (is_null($this->id)) {
            $this->addError('ID is empty');
        }
        if (is_null($this->site)) {
            $this->addError('Site is empty');
        } else if (!$this->site->validate()) {
            $this->addError("Site: " . $this->site->getErrorsAsString());
        }
        if (is_null($this->device)) {
            $this->addError('Device is empty');
        } else if (!$this->device->validate()) {
            $this->addError("Device: " . $this->device->getErrorsAsString());
        }
        if (is_null($this->user)) {
            $this->addError('User is empty');
        } else if (!$this->user->validate()) {
            $this->addError("User: " . $this->user->getErrorsAsString());
        }
        if (!is_null($this->regs) && !$this->regs->validate()) {
            $this->addError("Regs: " . $this->regs->getErrorsAsString());
        }
        if (!is_null($this->source) && !$this->source->validate()) {
            $this->addError("Source: " . $this->source->getErrorsAsString());
        }
        if (is_null($this->imp)) {
            $this->addError('Imp is empty');
        } else {
            foreach ($this->imp as $item) {
                if (!$item->validate()) {
                    $this->addError("Imp " . $item->getErrorsAsString());
                }
            }
        }
        if ($this->app && !$this->app->validate()) {
            $this->addError("App " . $this->app->getErrorsAsString());
        }
        return !$this->hasErrors();
    }

    public function setUser($values): void
    {

        if ($values instanceof BidRequestUser) {
            $this->user = $values;
        }
        if (is_array($values)) {
            $this->user = new BidRequestUser();
            $this->user->load($values);
        }
    }

    public function setSite($values): void
    {
        if($values instanceof BidRequestSite){
            $this->site = $values;
        }
        if(is_array($values)) {
            $this->site = new BidRequestSite();
            $this->site->load($values);
        }
    }

    public function setRegs($regs): void
    {
        if($regs instanceof BidRequestRegs){
            $this->regs = $regs;
        }
        if(is_array($regs)){
            $this->regs=new BidRequestRegs();
            $this->regs->load($regs);
        }
    }

    public function setSource($values): void
    {
        if($values instanceof BidRequestSource){
            $this->source = $values;
        }
        if(is_array($values)){
            $this->source=new BidRequestSource();
            $this->source->load($values);
        }
    }

    public function setDevice($values): void
    {
        if($values instanceof BidRequestDevice){
            $this->device = $values;
        }
        if(is_array($values)){
            $this->device = new BidRequestDevice();
            $this->device->load($values);
        }
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function setBidId(?string $bidId): void
    {
        $this->bidId = $bidId;
    }

    public function setImp(array $items): void
    {
        foreach ($items as $index => $values) {
            if ($values instanceof BidRequestImp) {
                $this->imp[$index] = $values;
            }
            if (is_array($values)) {
                $this->imp[$index] = new BidRequestImp();
                $this->imp[$index]->load($values);
            }
        }
    }

    private function getImpArray(): array
    {
        $data = [];
        foreach ($this->imp as $imp) {
            $data[] = $imp->asArray();
        }
        return $data;
    }

    public function asArray(): array
    {
        if (is_null($this->array)) {
            $this->array = [
                'id' => $this->id,
                'cur' => $this->cur,
                'tmax' => $this->tmax,
                'at' => $this->at,
                'site' => $this->site->asArray(),
                'user' => $this->user->asArray(),
                'device' => $this->device->asArray(),
                'imp' => $this->getImpArray(),
            ];
            if (!is_null($this->ext)) {
                $this->array['ext'] = $this->ext;
            }
            if (!is_null($this->bcat)) {
                $this->array['bcat'] = $this->bcat;
            }
            if (!is_null($this->badv)) {
                $this->array['badv'] = $this->badv;
            }
            if (!is_null($this->bapp)) {
                $this->array['bapp'] = $this->bapp;
            }
            if (!is_null($this->wlang)) {
                $this->array['wlang'] = $this->wlang;
            }
            if (!is_null($this->allimps)) {
                $this->array['allimps'] = $this->allimps;
            }
            if (!is_null($this->bseat)) {
                $this->array['bseat'] = $this->bseat;
            }
            if (!is_null($this->wseat)) {
                $this->array['wseat'] = $this->wseat;
            }
            if (!is_null($this->source)) {
                $this->array['source'] = $this->source->asArray();
            }
            if (!is_null($this->regs)) {
                $this->array['regs'] = $this->regs->asArray();
            }
        }
        return $this->array;
    }

    public function getImp(): ?array
    {
        return $this->imp;
    }

    public function getFirstImp(): BidRequestImp
    {
        return $this->imp[0];
    }

    public function getUser(): ?BidRequestUser
    {
        return $this->user;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getDevice(): ?BidRequestDevice
    {
        return $this->device;
    }

    public function getSite(): ?BidRequestSite
    {
        return $this->site;
    }

    public function getApp(): ?BidRequestApp
    {
        return $this->app;
    }

    public function getAt(): ?int
    {
        return $this->at;
    }

    public function getCur(): ?array
    {
        return $this->cur;
    }

    public function getTmax(): ?int
    {
        return $this->tmax;
    }

    public function getBidId(): ?string
    {
        return $this->bidId;
    }

    public function isBanner(): bool
    {
        if(!$this->getFirstImp()){
            return false;
        }
        return !is_null($this->getFirstImp()->getBanner());
    }

    public function isNative(): bool
    {
        if(!$this->getFirstImp()){
            return false;
        }
        return !is_null($this->getFirstImp()->getNative());
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getExt(): ?array
    {
        return $this->ext;
    }

    public function getBcat(): ?array
    {
        return $this->bcat;
    }

    public function getAllimps(): int
    {
        return $this->allimps;
    }

    public function getBadv(): ?array
    {
        return $this->badv;
    }

    public function getBapp(): ?array
    {
        return $this->bapp;
    }

    public function getBseat(): ?array
    {
        return $this->bseat;
    }

    public function getRegs(): ?BidRequestRegs
    {
        return $this->regs;
    }

    public function getWlang(): ?array
    {
        return $this->wlang;
    }

    public function getSource(): ?BidRequestSource
    {
        return $this->source;
    }

    public function getWseat(): ?array
    {
        return $this->wseat;
    }
}