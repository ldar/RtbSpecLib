<?php

namespace Ldar\RtbSpecLib\bid\request;

use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidRequestUser
 * @package Ldar\RtbSpecLib\bid\request
 */
class BidRequestUser extends Model
{
    /**
     * Exchange-specific ID for the user. At least one of id or
     * buyeruid is recommended.
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * Buyer-specific ID for the user as mapped by the exchange for
     * the buyer. At least one of buyeruid or id is recommended.
     * @var string|null
     */
    protected ?string $buyeruid = null;

    /**
     * Year of birth as a 4-digit integer
     * @var string|null
     */
    protected ?string $yob = null;

    /**
     * Gender, where “M” = male, “F” = female, “O” = known to be
     * other (i.e., omitted is unknown).
     * @var string|null
     */
    protected ?string $gender = null;

    /**
     * Comma separated list of keywords, interests, or intent.
     * @var string|null
     */
    protected ?string $keywords = null;

    /**
     * Optional feature to pass bidder data that was set in the
     * exchange’s cookie. The string must be in base85 cookie safe
     * characters and be in any format. Proper JSON encoding must
     * be used to include “escaped” quotation marks.
     * @var string|null
     */
    protected ?string $customdata = null;

    /**
     * Location of the user’s home base defined by a Geo object
     * (Section 3.2.19). This is not necessarily their current location.
     * @var BidRequestUserGeo|null
     */
    protected ?BidRequestUserGeo $geo = null;

    /**
     * Additional user data. Each Data object (Section 3.2.21)
     * represents a different data source.
     * @var BidRequestUserData[]|null
     */
    protected ?array $data = null;

    /**
     * Placeholder for exchange-specific extensions to OpenRTB.
     * @var array|null
     */
    protected ?array $ext = null;

    public function validate(): bool
    {
        $this->resetErrors();
        if (is_null($this->id)) {
            $this->addError('User Id is empty');
        }
        return !$this->hasErrors();
    }

    /**
     * @param BidRequestUserGeo|array|null $geo
     */
    public function setGeo($geo): void
    {
        if ($geo instanceof BidRequestUserGeo) {
            $this->geo = $geo;
        } else {
            $this->geo = new BidRequestUserGeo();
            $this->geo->load($geo);
        }
    }

    public function getGeo(): ?BidRequestUserGeo
    {
        return $this->geo;
    }

    /**
     * @param BidRequestUserData[]|array|null $data
     */
    public function setData(array $data): void
    {
        foreach ($data as $index => $datum) {
            if ($data instanceof BidRequestUserGeo) {
                $this->data[$index] = $datum;
            } else {
                $this->data[$index] = new BidRequestUserGeo();
                $this->data[$index]->load($datum);
            }
        }

    }

    /**
     * @return BidRequestUserData[]|null
     */
    public function getData(): ?array
    {
        return $this->data;
    }

    public function getBuyeruid(): ?string
    {
        return $this->buyeruid;
    }

    public function getCustomdata(): ?string
    {
        return $this->customdata;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function getYob(): ?string
    {
        return $this->yob;
    }

    public function asArray(): array
    {
        $this->array = [
            'id' => $this->id,
        ];
        if (!is_null($this->buyeruid)) {
            $this->array['buyeruid'] = $this->buyeruid;
        }
        if (!is_null($this->yob)) {
            $this->array['yob'] = $this->yob;
        }
        if (!is_null($this->gender)) {
            $this->array['gender'] = $this->gender;
        }
        if (!is_null($this->keywords)) {
            $this->array['keywords'] = $this->keywords;
        }
        if (!is_null($this->customdata)) {
            $this->array['customdata'] = $this->customdata;
        }
        if (!is_null($this->geo)) {
            $this->array['geo'] = $this->geo->asArray();
        }
        if (!is_null($this->data)) {
            $this->array['data'] = [];
            foreach ($this->data as $item) {
                $this->array['data'][] = $item->asArray();
            }
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

    public function getExt(): ?array
    {
        return $this->ext;
    }

}