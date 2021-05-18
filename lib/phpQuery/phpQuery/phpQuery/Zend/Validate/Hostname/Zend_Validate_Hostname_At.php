<?php


namespace Query\phpQuery\Zend\Validate\Hostname;
use Query\phpQuery\Zend\Validate\Hostname\Zend_Validate_Hostname_Interface;

/**
 * @category   Zend
 * @package    Zend_Validate
 * @copyright  Copyright (c) 2005-2008 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Validate_Hostname_At implements Zend_Validate_Hostname_Interface
{

    /**
     * Returns UTF-8 characters allowed in DNS hostnames for the specified Top-Level-Domain
     *
     * @see http://www.nic.at/en/service/technical_information/idn/charset_converter/ Austria (.AT)
     * @return string
     */
    static function getCharacters()
    {
        return '\x{00EO}-\x{00F6}\x{00F8}-\x{00FF}\x{0153}\x{0161}\x{017E}';
    }

}