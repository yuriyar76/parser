<?php


namespace Query\phpQuery\Zend\Validate\Hostname;

/**
 * @category   Zend
 * @package    Zend_Validate
 * @copyright  Copyright (c) 2005-2008 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
interface Zend_Validate_Hostname_Interface
{

    /**
     * Returns UTF-8 characters allowed in DNS hostnames for the specified Top-Level-Domain
     *
     * UTF-8 characters should be written as four character hex codes \x{XXXX}
     * For example é (lowercase e with acute) is represented by the hex code \x{00E9}
     *
     * You only need to include lower-case equivalents of characters since the hostname
     * check is case-insensitive
     *
     * Please document the supported TLDs in the documentation file at:
     * manual/en/module_specs/Zend_Validate-Hostname.xml
     *
     * @see http://en.wikipedia.org/wiki/Internationalized_domain_name
     * @see http://www.iana.org/cctld/ Country-Code Top-Level Domains (TLDs)
     * @see http://www.columbia.edu/kermit/utf8-t1.html UTF-8 characters
     * @return string
     */
    static function getCharacters();

}