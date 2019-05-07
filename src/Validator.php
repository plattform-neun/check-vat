<?php

namespace Neun\Vat;

use SoapClient;

class Validator
{
    const SERVICE = "http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl";

    protected $vat;

    protected $client;

    public function __construct(Vat $vat)
    {
        $this->vat = $vat;
    }

    public function client()
    {
        if(! $this->client) {
            $this->client = new SoapClient(self::SERVICE);
        }

        return $this->client;
    }

    public function validate()
    {
        $response = $this->client()->checkVat($this->vat->toArray());
        $this->vat->setValid($response->valid);
    }
}
