<?php

namespace Neun\Vat;

class Vat
{
    protected $vatId;

    protected $valid = false;

    protected $vatNumber;

    protected $countryCode;
       
    public function __construct($vatId)
    {
        $this->vatId = $this->canonicalize($vatId);
    }

    public function countryCode()
    {
        if(! $this->countryCode) {
            $this->countryCode = substr($this->vatId, 0, 2);
        }

        return $this->countryCode;
    }

    public function isValid()
    {
        return $this->valid;
    }

    public function setValid(bool $value)
    {
        $this->valid = $value;
    }

    public function vatNumber()
    {
        if(! $this->vatNumber) {
            $this->vatNumber = substr($this->vatId, 2);
        }

        return $this->vatNumber;
    }

    public function validate()
    {
        $validator = new Validator($this);
        $validator->validate();

        return $this;
    }

    public function toArray()
    {
        return [
            'countryCode' => $this->countryCode(),
            'vatNumber' => $this->vatNumber(),
        ];
    }

    protected function canonicalize($value)
    {
        return str_replace(' ', '', strtoupper($value));
    }
}
