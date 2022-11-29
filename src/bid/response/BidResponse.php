<?php

namespace Ldar\RtbSpecLib\bid\response;

use Ldar\RtbSpecLib\bid\request\BidRequest;
use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidResponse
 * @package Ldar\RtbSpecLib\bid\response
 */
class BidResponse extends Model
{
    /**
     * ID of the bid request to which this is a response.
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * Bidder generated response ID to assist with logging/tracking.
     * @var string|null
     */
    protected ?string $bidid = null;

    /**
     * Bid currency using ISO-4217 alpha codes
     * @var string
     */
    protected string $cur = "USD";

    /**
     * Array of seatbid objects; 1+ required if a bid is to be made.
     * @var BidResponseSeatBid[]|null
     */
    protected ?array $seatbid = null;

    /**
     * Optional feature to allow a bidder to set data in the
     * exchange’s cookie. The string must be in base85 cookie safe
     * characters and be in any format. Proper JSON encoding must
     * be used to include “escaped” quotation marks.
     * @var array|null
     */
    protected ?array $customdata = null;

    /**
     * Reason for not bidding. Refer to List 5.24
     * @var int|null
     */
    protected ?int $nbr = null;

    /**
     * Placeholder for bidder-specific extensions to OpenRTB.
     * @var null
     */
    protected $ext = null;


    protected ?int $response_time = null;
    private BidRequest $request;

    /**
     * BidResponse constructor.
     * @param BidRequest $request
     */
    public function __construct(BidRequest $request)
    {
        $this->request = $request;
    }

    public function validate(): bool
    {
        $this->resetErrors();
        if (is_null($this->id)) {
            $this->addError('Id is empty');
        }
        if (is_null($this->seatbid)) {
            $this->addError('seatbid is empty');
        } else {
            foreach ($this->seatbid as $index => $item) {
                if (!$item->validate()) {
                    $this->addError('Incorrect seatbid ' . $index . ': ' . $item->getErrorsAsString());
                }
                if (count($item->getBid()) == 0) {
                    $this->addError('No set Bid');
                } else {
                    foreach ($item->getBid() as $bid) {
                        if ($bid->getImpid() != $this->request->getFirstImp()->getId()) {
                            $this->addError('Imp does not match');
                        }
                        if ($bid->getPrice() < $this->request->getFirstImp()->getBidfloor()) {
                            $this->addError('Incorrect price');
                        }
                        if ($this->request->isBanner()) {
                            if ($bid->getW() < $this->request->getFirstImp()->getBanner()->getW()) {
                                $this->addError('Banner width does not match:' . $this->getSeatbid()[$index]->getBid()[0]->getW() . ',' . $this->request->getImp()[0]->getBanner()->getW());
                            }
                            if ($bid->getH() < $this->request->getFirstImp()->getBanner()->getH()) {
                                $this->addError('Banner height does not match');
                            }
                        }
                    }
                }
            }
        }
//        if (!in_array($this->cur, $this->request->getCur())) {
//            $this->addError('Сurrency does not match');
//        }
        if ($this->response_time > $this->request->getTmax()) {
            $this->addError('Response time exceeded');
        }
        if ($this->id != $this->request->getId()) {
            $this->addError('Bid Id does not match: ' . $this->id . '<>' . $this->request->getId());
        }

        return !$this->hasErrors();
    }

    protected function setSeatbid(array $items)
    {
        $this->seatbid = [];
        foreach ($items as $index => $values) {
            if ($values instanceof BidResponseSeatBid) {
                $this->seatbid[$index] = $values;
            } else {
                $this->seatbid[$index] = new BidResponseSeatBid();
                if (!$this->seatbid[$index]->load($values)) {
                    $this->addError('Failed load data in BidResponseSeatBid');
                }
            }
        }
    }

    public function asArray(): array
    {
        if (is_null($this->array)) {
            $this->array = [
                'id' => $this->id,
                'bidid' => $this->bidid,
                'cur' => $this->cur,
            ];
            if (!is_null($this->seatbid)) {
                $this->array['seatbid'] = $this->getSeatbidAsArray();
            }
            if (!is_null($this->ext)) {
                $this->array['ext'] = $this->ext;
            }
            if (!is_null($this->nbr)) {
                $this->array['nbr'] = $this->nbr;
            }
            if (!is_null($this->customdata)) {
                $this->array['customdata'] = $this->customdata;
            }
        }
        return $this->array;
    }

    private function getSeatbidAsArray(): array
    {
        $data = [];
        foreach ($this->seatbid as $index => $item) {
            $data[] = $item->asArray();
        }
        return $data;
    }

    /**
     * @return BidResponseSeatBid[]|null
     */
    public function getSeatbid(): ?array
    {
        return $this->seatbid;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function getBidid(): ?string
    {
        return $this->bidid;
    }

    public function getCur(): ?string
    {
        return $this->cur;
    }

    public function setCur(?string $cur): void
    {
        $this->cur = $cur;
    }

    public function getResponseTime(): ?int
    {
        return $this->response_time;
    }

    public function setResponseTime(?int $response_time): void
    {
        $this->response_time = $response_time;
    }

    public function getRequest(): BidRequest
    {
        return $this->request;
    }

    public function getExt()
    {
        return $this->ext;
    }

    public function getCustomdata(): ?array
    {
        return $this->customdata;
    }

    public function getNbr(): ?int
    {
        return $this->nbr;
    }
}