<?php


namespace Query\phpQuery\Zend\Validate;
use Query\phpQuery\Zend\Validate\Zend_Validate_Abstract;

/**
 * @category   Zend
 * @package    Zend_Validate
 * @copyright  Copyright (c) 2005-2008 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Validate_Digits extends Zend_Validate_Abstract
{
    /**
     * Validation failure message key for when the value contains non-digit characters
     */
    const NOT_DIGITS = 'notDigits';

    /**
     * Validation failure message key for when the value is an empty string
     */
    const STRING_EMPTY = 'stringEmpty';

    /**
     * Digits filter used for validation
     *
     * @var Zend_Filter_Digits
     */
    protected static $_filter = null;

    /**
     * Validation failure message template definitions
     *
     * @var array
     */
    protected $_messageTemplates = array(
        self::NOT_DIGITS   => "'%value%' contains not only digit characters",
        self::STRING_EMPTY => "'%value%' is an empty string"
    );

    /**
     * Defined by Zend_Validate_Interface
     *
     * Returns true if and only if $value only contains digit characters
     *
     * @param  string $value
     * @return boolean
     */
    public function isValid($value)
    {
        $valueString = (string) $value;

        $this->_setValue($valueString);

        if ('' === $valueString) {
            $this->_error(self::STRING_EMPTY);
            return false;
        }

        if (null === self::$_filter) {
            /**
             * @see Zend_Filter_Digits
             */
            require_once 'Zend/Filter/Digits.php';
            self::$_filter = new Zend_Filter_Digits();
        }

        if ($valueString !== self::$_filter->filter($valueString)) {
            $this->_error(self::NOT_DIGITS);
            return false;
        }

        return true;
    }

}
