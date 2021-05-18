<?php


namespace Query\phpQuery\Zend\Validate\Hostname;
use Query\phpQuery\Zend\Validate\Hostname\Zend_Validate_Hostname_Interface;


/**
 * @category   Zend
 * @package    Zend_Validate
 * @copyright  Copyright (c) 2005-2008 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Validate_Hostname_Hu implements Zend_Validate_Hostname_Interface
{

    /**
     * Returns UTF-8 characters allowed in DNS hostnames for the specified Top-Level-Domain
     *
     * @see http://www.domain.hu/domain/English/szabalyzat.html Hungary (.HU)
     * @return string
     */
    static function getCharacters()
    {
        return '\x{00E1}\x{00E9}\x{00ED}\x{00F3}\x{00F6}\x{0151}\x{00FA}\x{00FC}\x{0171}';
    }

}