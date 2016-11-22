<?php

namespace Zabaala\PhoneNumber;

use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;

final class PhoneNumber
{
    /**
     * @var string
     */
    protected $areaCode;

    /**
     * @var string
     */
    protected $number;

    /**
     * Set the area code. Mathod can only be used internally.
     * @param $areaCode
     */
    private function setAreaCode($areaCode)
    {
        $this->areaCode = $areaCode;
    }

    /**
     * Set number. Mathod can only be used internally.
     * @param $number
     */
    private function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function getAreaCode()
    {
        return $this->areaCode;
    }

    /**
     * @param $phoneNumber
     * @param string $defaultRegion A iso-3166-2 region.
     * @return $this
     */
    public function parse($phoneNumber, $defaultRegion = 'BR')
    {
        $phoneUtil = PhoneNumberUtil::getInstance();
        $phone = null;

        try {
            $phone = $phoneUtil->parse($phoneNumber, $defaultRegion);
        } catch (NumberParseException $e) {}

        $nationalSignificantNumber = $phoneUtil->getNationalSignificantNumber($phone);
        $areaCodeLength = $phoneUtil->getLengthOfGeographicalAreaCode($phone);

        $areaCode = "";
        $subscriberNumber = $nationalSignificantNumber;

        if ($areaCodeLength > 0) {
            $areaCode = substr($nationalSignificantNumber, 0,$areaCodeLength);
            $subscriberNumber = substr($nationalSignificantNumber, $areaCodeLength);
        }

        $this->setAreaCode($areaCode);
        $this->setNumber($subscriberNumber);

        return $this;
    }
}