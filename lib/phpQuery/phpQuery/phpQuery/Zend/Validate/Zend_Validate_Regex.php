<?php


namespace Query\phpQuery\Zend\Validate;
use Query\phpQuery\Zend\Validate\Zend_Validate_Abstract;

/**
 * @category   Zend
 * @package    Zend_Validate
 * @copyright  Copyright (c) 2005-2008 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Validate_Regex extends Zend_Validate_Abstract
{

    const NOT_MATCH = 'regexNotMatch';

    /**
     * @var array
     */
    protected $_messageTemplates = array(
        self::NOT_MATCH => "'%value%' does not match against pattern '%pattern%'"
    );

    /**
     * @var array
     */
    protected $_messageVariables = array(
        'pattern' => '_pattern'
    );

    /**
     * Regular expression pattern
     *
     * @var string
     */
    protected $_pattern;

    /**
     * Sets validator options
     *
     * @param  string $pattern
     * @return void
     */
    public function __construct($pattern)
    {
        $this->setPattern($pattern);
    }

    /**
     * Returns the pattern option
     *
     * @return string
     */
    public function getPattern()
    {
        return $this->_pattern;
    }

    /**
     * Sets the pattern option
     *
     * @param  string $pattern
     * @return Zend_Validate_Regex Provides a fluent interface
     */
    public function setPattern($pattern)
    {
        $this->_pattern = (string) $pattern;
        return $this;
    }

    /**
     * Defined by Zend_Validate_Interface
     *
     * Returns true if and only if $value matches against the pattern option
     *
     * @param  string $value
     * @throws Zend_Validate_Exception if there is a fatal error in pattern matching
     * @return boolean
     */
    public function isValid($value)
    {
        $valueString = (string) $value;

        $this->_setValue($valueString);

        $status = @preg_match($this->_pattern, $valueString);
        if (false === $status) {
            /**
             * @see Zend_Validate_Exception
             */

            throw new Zend_Validate_Exception("Internal error matching pattern '$this->_pattern' against value '$valueString'");
        }
        if (!$status) {
            $this->_error();
            return false;
        }
        return true;
    }

}
