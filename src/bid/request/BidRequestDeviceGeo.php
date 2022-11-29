<?php

namespace Ldar\RtbSpecLib\bid\request;

use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidRequestDeviceGeo
 * @package Ldar\RtbSpecLib\bid\request
 */
class BidRequestDeviceGeo extends Model
{
    /**
     * Country code using ISO-3166-1-alpha-3.
     * @var string|null
     */
    protected ?string $country = null;

    /**
     * Latitude from -90.0 to +90.0, where negative is south.
     * @var float|null
     */
    protected ?float $lat = null;

    /**
     * Longitude from -180.0 to +180.0, where negative is west.
     * @var float|null
     */
    protected ?float $lon = null;

    /**
     * Source of location data; recommended when passing lat/lon. Refer to List 5.20.
     * @var int|null
     */
    protected ?int $type = null;

    /**
     * Estimated location accuracy in meters; recommended when
     * lat/lon are specified and derived from a device’s location
     * services (i.e., type = 1). Note that this is the accuracy as
     * reported from the device. Consult OS specific documentation
     * (e.g., Android, iOS) for exact interpretation
     * @var int|null
     */
    protected ?int $accuracy = null;

    /**
     * Number of seconds since this geolocation fix was established.
     * Note that devices may cache location data across multiple
     * fetches. Ideally, this value should be from the time the actual
     * fix was taken.
     * @var int|null
     */
    protected ?int $lastfix = null;

    /**
     * Service or provider used to determine geolocation from IP
     * address if applicable (i.e., type = 2). Refer to List 5.23.
     * @var int|null
     */
    protected ?int $ipservice = null;

    /**
     * Region code using ISO-3166-2; 2-letter state code if USA.
     * @var string|null
     */
    protected ?string $region = null;

    /**
     * Region of a country using FIPS 10-4 notation. While OpenRTB
     * supports this attribute, it has been withdrawn by NIST in 2008.
     * @var string|null
     */
    protected ?string $regionfips104 = null;

    /**
     * Google metro code; similar to but not exactly Nielsen DMAs.
     * See Appendix A for a link to the codes.
     * @var string|null
     */
    protected ?string $metro = null;

    /**
     * City using United Nations Code for Trade & Transport
     * Locations. See Appendix A for a link to the codes.
     * @var string|null
     */
    protected ?string $city = null;

    /**
     * Zip or postal code.
     * @var string|null
     */
    protected ?string $zip = null;

    /**
     * Local time as the number +/- of minutes from UTC.
     * @var string|null
     */
    protected ?string $utcoffset = null;

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
            'country' => $this->country,
        ];
        if ($this->lat) {
            $this->array['lat'] = $this->lat;
        }
        if ($this->lon) {
            $this->array['lon'] = $this->lon;
        }
        if ($this->type) {
            $this->array['type'] = $this->type;
        }
        if ($this->accuracy) {
            $this->array['accuracy'] = $this->accuracy;
        }
        if ($this->lastfix) {
            $this->array['lastfix'] = $this->lastfix;
        }
        if ($this->ipservice) {
            $this->array['ipservice'] = $this->ipservice;
        }
        if ($this->country) {
            $this->array['country'] = $this->country;
        }
        if ($this->region) {
            $this->array['region'] = $this->region;
        }
        if ($this->regionfips104) {
            $this->array['regionfips104'] = $this->regionfips104;
        }
        if ($this->metro) {
            $this->array['metro'] = $this->metro;
        }
        if ($this->city) {
            $this->array['city'] = $this->city;
        }
        if ($this->zip) {
            $this->array['zip'] = $this->zip;
        }
        if ($this->utcoffset) {
            $this->array['utcoffset'] = $this->utcoffset;
        }
        if ($this->ext) {
            $this->array['ext'] = $this->ext;
        }
        return $this->array;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function getExt()
    {
        return $this->ext;
    }

    public function getAccuracy(): ?int
    {
        return $this->accuracy;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getIpservice(): ?int
    {
        return $this->ipservice;
    }

    public function getLastfix(): ?int
    {
        return $this->lastfix;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function getLon(): ?float
    {
        return $this->lon;
    }

    public function getMetro(): ?string
    {
        return $this->metro;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function getRegionfips104(): ?string
    {
        return $this->regionfips104;
    }

    public function getUtcoffset(): ?string
    {
        return $this->utcoffset;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }
}