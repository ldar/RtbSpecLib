<?php

namespace Ldar\RtbSpecLib\bid\request;


use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidRequestDevice
 * @package Ldar\RtbSpecLib\bid\request
 */
class BidRequestDevice extends Model
{
    /**
     * IPv4 address closest to device.
     * @var string|null
     */
    protected ?string $ip = null;

    /**
     * IP address closest to device as IPv6.
     * @var string|null
     */
    protected ?string $ipv6 = null;

    /**
     * Standard “Do Not Track” flag as set in the header by the
     * browser, where 0 = tracking is unrestricted, 1 = do not track.
     * @var int|null
     */
    protected ?int $dnt = null;

    /**
     * “Limit Ad Tracking” signal commercially endorsed (e.g., iOS,
     * Android), where 0 = tracking is unrestricted, 1 = tracking must
     * be limited per commercial guidelines.
     * @var int|null
     */
    protected ?int $lmt = null;

    /**
     * Device make (e.g., “Apple”).
     * @var string|null
     */
    protected ?string $make = null;

    /**
     * Device model (e.g., “iPhone”).
     * @var string|null
     */
    protected ?string $model = null;

    /**
     * Device operating system version (e.g., “3.1.2”)
     * @var string|null
     */
    protected ?string $osv = null;

    /**
     * Hardware version of the device (e.g., “5S” for iPhone 5S).
     * @var string|null
     */
    protected ?string $hwv = null;

    /**
     * Screen size as pixels per linear inch.
     * @var int|null
     */
    protected ?int $ppi = null;

    /**
     * The ratio of physical pixels to device independent pixels
     * @var float|null
     */
    protected ?float $pxratio = null;

    /**
     * Indicates if the geolocation API will be available to JavaScript
     * code running in the banner, where 0 = no, 1 = yes.
     * @var int|null
     */
    protected ?int $geofetch = null;

    /**
     * Version of Flash supported by the browser.
     * @var string|null
     */
    protected ?string $flashver = null;

    /**
     * Carrier or ISP (e.g., “VERIZON”) using exchange curated string
     * names which should be published to bidders a priori.
     * @var string|null
     */
    protected ?string $carrier = null;

    /**
     * Mobile carrier as the concatenated MCC-MNC code (e.g.,
     * “310-005” identifies Verizon Wireless CDMA in the USA).
     * Refer to https://en.wikipedia.org/wiki/Mobile_country_code
     * for further examples. Note that the dash between the MCC
     * and MNC parts is required to remove parsing ambiguity.
     * @var string|null
     */
    protected ?string $mccmnc = null;

    /**
     * Network connection type. Refer to List 5.22.
     * @var int|null
     */
    protected ?int $connectiontype = null;

    /**
     * ID sanctioned for advertiser use in the clear (i.e., not hashed).
     * @var string|null
     */
    protected ?string $ifa = null;

    /**
     * Hardware device ID (e.g., IMEI); hashed via SHA1.
     * @var string|null
     */
    protected ?string $didsha1 = null;

    /**
     * Hardware device ID (e.g., IMEI); hashed via MD5
     * @var string|null
     */
    protected ?string $didmd5 = null;

    /**
     * Platform device ID (e.g., Android ID); hashed via SHA1.
     * @var string|null
     */
    protected ?string $dpidsha1 = null;

    /**
     * Platform device ID (e.g., Android ID); hashed via MD5.
     * @var string|null
     */
    protected ?string $dpidmd5 = null;

    /**
     * MAC address of the device; hashed via SHA1.
     * @var string|null
     */
    protected ?string $macsha1 = null;

    /**
     * MAC address of the device; hashed via MD5
     * @var string|null
     */
    protected ?string $macmd5 = null;

    /**
     * Placeholder for exchange-specific extensions to OpenRTB.
     * @var null
     */
    protected $ext = null;

    /**
     * Browser user agent string
     * @var string|null
     */
    protected ?string $ua = null;

    /**
     * The general type of device. Refer to List 5.21
     * @var int|null
     */
    protected ?int $devicetype = null;

    /**
     * Device operating system (e.g., “iOS”).
     * @var string|null
     */
    protected ?string $os = null;

    /**
     * Browser language using ISO-639-1-alpha-2
     * @var string|null
     */
    protected ?string $language = null;

    /**
     * Support for JavaScript, where 0 = no, 1 = yes.
     * @var int|null
     */
    protected ?int $js = null;

    /**
     * Physical width of the screen in pixels.
     * @var int|null
     */
    protected ?int $w = null;

    /**
     * Physical height of the screen in pixels.
     * @var int|null
     */
    protected ?int $h = null;

    /**
     * Location of the device assumed to be the user’s current
     * location defined by a Geo object (Section 3.2.19).
     * @var BidRequestDeviceGeo|null
     */
    protected ?BidRequestDeviceGeo $geo = null;

    public function validate(): bool
    {
        $this->resetErrors();
        if (is_null($this->ip)) {
            $this->addError('IP is empty');
        }
        if (is_null($this->geo)) {
            $this->addError('Geo is empty');
        } else if (!$this->getGeo()->validate()) {
            $this->addError('Geo Error:' . $this->getGeo()->getErrorsAsString());
        }
        return !$this->hasErrors();
    }

    public function asArray(): array
    {
        $this->array = [
            'ip' => $this->ip,
            'ua' => $this->ua,
            'devicetype' => $this->devicetype,
            'os' => $this->os,
            'language' => $this->language,
            'geo' => $this->geo->asArray(),
        ];
        if (!is_null($this->js)) {
            $this->array['js'] = $this->js;
        }
        if (!is_null($this->w)) {
            $this->array['w'] = $this->w;
        }
        if (!is_null($this->h)) {
            $this->array['h'] = $this->h;
        }
        if (!is_null($this->ua)) {
            $this->array['ua'] = $this->ua;
        }
        if (!is_null($this->dnt)) {
            $this->array['dnt'] = $this->dnt;
        }
        if (!is_null($this->lmt)) {
            $this->array['lmt'] = $this->lmt;
        }
        if (!is_null($this->ipv6)) {
            $this->array['ipv6'] = $this->ipv6;
        }
        if (!is_null($this->devicetype)) {
            $this->array['devicetype'] = $this->devicetype;
        }
        if (!is_null($this->make)) {
            $this->array['make'] = $this->make;
        }
        if (!is_null($this->model)) {
            $this->array['model'] = $this->model;
        }
        if (!is_null($this->os)) {
            $this->array['os'] = $this->os;
        }
        if (!is_null($this->osv)) {
            $this->array['osv'] = $this->osv;
        }
        if (!is_null($this->hwv)) {
            $this->array['hwv'] = $this->hwv;
        }
        if (!is_null($this->ppi)) {
            $this->array['ppi'] = $this->ppi;
        }
        if (!is_null($this->pxratio)) {
            $this->array['pxratio'] = $this->pxratio;
        }
        if (!is_null($this->js)) {
            $this->array['js'] = $this->js;
        }
        if (!is_null($this->geofetch)) {
            $this->array['geofetch'] = $this->geofetch;
        }
        if (!is_null($this->flashver)) {
            $this->array['flashver'] = $this->flashver;
        }
        if (!is_null($this->language)) {
            $this->array['language'] = $this->language;
        }
        if (!is_null($this->carrier)) {
            $this->array['carrier'] = $this->carrier;
        }
        if (!is_null($this->mccmnc)) {
            $this->array['mccmnc'] = $this->mccmnc;
        }
        if (!is_null($this->connectiontype)) {
            $this->array['connectiontype'] = $this->connectiontype;
        }
        if (!is_null($this->ifa)) {
            $this->array['ifa'] = $this->ifa;
        }
        if (!is_null($this->didsha1)) {
            $this->array['didsha1'] = $this->didsha1;
        }
        if (!is_null($this->didmd5)) {
            $this->array['didmd5'] = $this->didmd5;
        }
        if (!is_null($this->dpidsha1)) {
            $this->array['dpidsha1'] = $this->dpidsha1;
        }
        if (!is_null($this->dpidmd5)) {
            $this->array['dpidmd5'] = $this->dpidmd5;
        }
        if (!is_null($this->macsha1)) {
            $this->array['macsha1'] = $this->macsha1;
        }
        if (!is_null($this->macmd5)) {
            $this->array['macmd5'] = $this->macmd5;
        }
        if (!is_null($this->ext)) {
            $this->array['ext'] = $this->ext;
        }
        return $this->array;
    }

    public function getDevicetype(): ?int
    {
        return $this->devicetype;
    }

    public function getGeo(): ?BidRequestDeviceGeo
    {
        return $this->geo;
    }

    public function setGeo($geo): void
    {
        if ($geo instanceof BidRequestDeviceGeo) {
            $this->geo = $geo;
        }
        if (is_array($geo)) {
            $this->geo = new BidRequestDeviceGeo();
            $this->geo->load($geo);
        }
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function getOs(): ?string
    {
        return $this->os;
    }

    public function getUa(): ?string
    {
        return $this->ua;
    }

    public function getH(): ?int
    {
        return $this->h;
    }

    public function getW(): ?int
    {
        return $this->w;
    }

    public function getJs(): ?int
    {
        return $this->js;
    }

    public function getCarrier(): ?string
    {
        return $this->carrier;
    }

    public function getConnectiontype(): ?int
    {
        return $this->connectiontype;
    }

    public function getDidmd5(): ?string
    {
        return $this->didmd5;
    }

    public function getDidsha1(): ?string
    {
        return $this->didsha1;
    }

    public function getDpidmd5(): ?string
    {
        return $this->dpidmd5;
    }

    public function getDpidsha1(): ?string
    {
        return $this->dpidsha1;
    }

    public function getDnt(): ?int
    {
        return $this->dnt;
    }

    public function getFlashver(): ?string
    {
        return $this->flashver;
    }

    public function getGeofetch(): ?int
    {
        return $this->geofetch;
    }

    public function getHwv(): ?string
    {
        return $this->hwv;
    }

    public function getIfa(): ?string
    {
        return $this->ifa;
    }

    public function getLmt(): ?int
    {
        return $this->lmt;
    }

    public function getMacmd5(): ?string
    {
        return $this->macmd5;
    }

    public function getMacsha1(): ?string
    {
        return $this->macsha1;
    }

    public function getMake(): ?string
    {
        return $this->make;
    }

    public function getIpv6(): ?string
    {
        return $this->ipv6;
    }

    public function getMccmnc(): ?string
    {
        return $this->mccmnc;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function getOsv(): ?string
    {
        return $this->osv;
    }

    public function getPpi(): ?int
    {
        return $this->ppi;
    }

    public function getPxratio(): ?float
    {
        return $this->pxratio;
    }

    public function getExt()
    {
        return $this->ext;
    }

}