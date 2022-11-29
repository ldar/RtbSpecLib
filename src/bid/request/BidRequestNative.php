<?php

namespace Ldar\RtbSpecLib\bid\request;


use Ldar\RtbSpecLib\Model;

/**
 * Author: Eldar Iserkapov
 * Email: l-dar@iserkapov.ru
 * Class BidRequestNative
 * @package Ldar\RtbSpecLib\bid\request
 */
class BidRequestNative extends Model
{

    /**
     * Request payload complying with the Native Ad Specification.
     * @var BidRequestNativeRequest|null
     */
    protected ?BidRequestNativeRequest $request = null;

    /**
     * Version of the Dynamic Native Ads API to which request
     * complies; highly recommended for efficient parsing
     * @var string
     */
    protected string $ver = '1.1';

    /**
     * Blocked creative attributes.
     * @var array|null
     */
    protected ?array $battr = null;

    /**
     * Placeholder for exchange-specific extensions to OpenRTB.
     * @var string|null
     */
    protected ?string $ext = null;

    /**
     * List of supported API frameworks for this impression. Refer to
     * List 5.6. If an API is not explicitly listed, it is assumed not to be
     * supported.
     * @var int[]|null
     */
    protected ?array $api = null;

    /**
     * @return bool
     */
    public function validate(): bool
    {
        $this->resetErrors();
        if (is_null($this->request)) {
            $this->addError('request is empty');
        } else {
            if (!$this->request->validate()) {
                $this->addError('Request:' . $this->request->getErrorsAsString());
            }
        }
        return !$this->hasErrors();
    }


    public function asArray(): array
    {
        $this->array = [
            'request' => is_null($this->request) ? null : $this->request->asArray(),
            'ver' => $this->ver,
        ];
        if (!is_null($this->battr)) {
            $this->array['battr'] = $this->battr;
        }
        if (!is_null($this->api)) {
            $this->array['api'] = $this->api;
        }
        return $this->array;
    }

    /**
     * @return BidRequestNativeRequest|null
     */
    public function getRequest(): ?BidRequestNativeRequest
    {
        return $this->request;
    }

    /**
     * @param BidRequestNativeRequest|[]|null $request
     * @throws \JsonException
     */
    protected function setRequest($request): void
    {
        if ($request instanceof BidRequestNativeRequest) {
            $this->request = $request;
        } else {
            $this->request = new BidRequestNativeRequest();
            $this->request->load(is_array($request) ? $request : json_decode($request, true, 512, JSON_THROW_ON_ERROR));
        }
    }

    public function getVer(): ?string
    {
        return $this->ver;
    }

    /**
     * @param bool $asJson
     * @return array|string|null
     */
    public function getBattr(bool $asJson = false)
    {
        if (!is_null($this->battr) && $asJson) {
            return json_encode($this->battr);
        }
        return $this->battr;
    }

    /**
     * @return int[]|string|null
     */
    public function getApi(bool $asJson = false): ?array
    {
        if (!is_null($this->api) && $asJson) {
            return json_encode($this->api);
        }
        return $this->api;
    }

    /**
     * @return string|null
     */
    public function getExt()
    {
        return $this->ext;
    }
}