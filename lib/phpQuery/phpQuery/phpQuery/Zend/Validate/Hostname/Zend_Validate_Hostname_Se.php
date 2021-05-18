<?php


namespace Query\phpQuery\Zend\Validate\Hostname;
use Query\phpQuery\Zend\Validate\Hostname\Zend_Validate_Hostname_Interface;


/**
 * @category   Zend
 * @package    Zend_Validate
 * @copyright  Copyright (c) 2005-2008 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Validate_Hostname_Se implements Zend_Validate_Hostname_Interface
{

    /**
     * Returns UTF-8 characters allowed in DNS hostnames for the specified Top-Level-Domain
     *
     * @see http://www.iis.se/english/IDN_campaignsite.shtml?lang=en Sweden (.SE)
     * @return string
     */
    static function getCharacters()
    {
        return '\x{00E5}\x{00E4}\x{00F6}\x{00FC}\x{00E9}';
    }

}