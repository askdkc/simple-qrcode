<?php namespace SimpleSoftwareIO\QrCode\DataTypes;
/**
 * Simple Laravel QrCode Generator
 * A simple wrapper for the popular BaconQrCode made for Laravel.
 *
 * @link http://www.simplesoftware.io
 * @author SimpleSoftware support@simplesoftware.io
 *
 */

class SMS implements DataTypeInterface {

    /**
     * The phone number
     *
     * @var string
     */
    protected $phoneNumber;

    /**
     * The SMS message
     *
     * @var string
     */
    protected $message;

    /**
     * Generates the DataType Object and sets all of its properties.
     *
     * @param $arguments
     * @return void
     */
    public function create(Array $arguments)
    {
        $this->setProperties($arguments);
    }

    /**
     * Returns the correct QrCode format.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->buildSMSString();
    }

    /**
     * Sets the phone number and message for a sms message.
     *
     * @param Array $arguments
     */
    private function setProperties(Array $arguments)
    {
        if (isset($arguments[0])) $this->phoneNumber = $arguments[0];
        if (isset($arguments[1])) $this->message = $arguments[1];
    }

    /**
     * Builds a SMS string.
     *
     * @return string
     */
    private function buildSMSString()
    {
        $prefix = $this->prefix();

        $sms =  $prefix . $this->phoneNumber;

        if (isset($this->message))
        {
            $sms .= ':' . $this->message;
        }

        return $sms;
    }

    /**
     * Determines the SMS prefix to use
     *
     * @return string
     */
    private function prefix()
    {
        if (isset ($this->message)) return 'smsto:';

        return 'sms:';
    }
}