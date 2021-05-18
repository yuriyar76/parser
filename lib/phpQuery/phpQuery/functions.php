<?php
set_time_limit(0);
use Query\phpQuery\phpQueryObject;

define('DOMDOCUMENT', 'DOMDocument');
define('DOMELEMENT', 'DOMElement');
define('DOMNODELIST', 'DOMNodeList');
define('DOMNODE', 'DOMNode');

// -- Multibyte Compatibility functions ---------------------------------------
// http://svn.iphonewebdev.com/lace/lib/mb_compat.php

/**
 *  mb_internal_encoding()
 *
 *  Included for mbstring pseudo-compatability.
 */
if (!function_exists('mb_internal_encoding')) {
    function mb_internal_encoding($enc)
    {
        return true;
    }
}

/**
 *  mb_regex_encoding()
 *
 *  Included for mbstring pseudo-compatability.
 */
if (!function_exists('mb_regex_encoding')) {
    function mb_regex_encoding($enc)
    {
        return true;
    }
}

/**
 *  mb_strlen()
 *
 *  Included for mbstring pseudo-compatability.
 */
if (!function_exists('mb_strlen')) {
    function mb_strlen($str)
    {
        return strlen($str);
    }
}

/**
 *  mb_strpos()
 *
 *  Included for mbstring pseudo-compatability.
 */
if (!function_exists('mb_strpos')) {
    function mb_strpos($haystack, $needle, $offset = 0)
    {
        return strpos($haystack, $needle, $offset);
    }
}
/**
 *  mb_stripos()
 *
 *  Included for mbstring pseudo-compatability.
 */
if (!function_exists('mb_stripos')) {
    function mb_stripos($haystack, $needle, $offset = 0)
    {
        return stripos($haystack, $needle, $offset);
    }
}

/**
 *  mb_substr()
 *
 *  Included for mbstring pseudo-compatability.
 */
if (!function_exists('mb_substr')) {
    function mb_substr($str, $start, $length = 0)
    {
        return substr($str, $start, $length);
    }
}

/**
 *  mb_substr_count()
 *
 *  Included for mbstring pseudo-compatability.
 */
if (!function_exists('mb_substr_count')) {
    function mb_substr_count($haystack, $needle)
    {
        return substr_count($haystack, $needle);
    }
}


/**
 * Shortcut to phpQuery::pq($arg1, $context)
 * Chainable.
 *
 * @see phpQuery::pq()
 * @return phpQueryObject|QueryTemplatesSource|QueryTemplatesParse|QueryTemplatesSourceQuery
 * @author Tobiasz Cudnik <tobiasz.cudnik/gmail.com>
 * @package phpQuery
 */
function pq($arg1, $context = null) {
    $args = func_get_args();
    return call_user_func_array(
        array('phpQuery', 'pq'),
        $args
    );
}
/**
 *
 * @param unknown_type $parsed
 * @return unknown
 * @link http://www.php.net/manual/en/function.parse-url.php
 * @author stevenlewis at hotmail dot com
 */
function glue_url($parsed)
{
    if (! is_array($parsed)) return false;
    $uri = isset($parsed['scheme']) ? $parsed['scheme'].':'.((strtolower($parsed['scheme']) == 'mailto') ? '':'//'): '';
    $uri .= isset($parsed['user']) ? $parsed['user'].($parsed['pass']? ':'.$parsed['pass']:'').'@':'';
    $uri .= isset($parsed['host']) ? $parsed['host'] : '';
    $uri .= isset($parsed['port']) ? ':'.$parsed['port'] : '';
    if(isset($parsed['path']))
    {
        $uri .= (substr($parsed['path'],0,1) == '/')?$parsed['path']:'/'.$parsed['path'];
    }
    $uri .= isset($parsed['query']) ? '?'.$parsed['query'] : '';
    $uri .= isset($parsed['fragment']) ? '#'.$parsed['fragment'] : '';
    return $uri;
}
/**
 * Enter description here...
 *
 * @param unknown_type $base
 * @param unknown_type $url
 * @return unknown
 * @author adrian-php at sixfingeredman dot net
 */
function resolve_url($base, $url) {
    if (!strlen($base)) return $url;
    // Step 2
    if (!strlen($url)) return $base;
    // Step 3
    if (preg_match('!^[a-z]+:!i', $url)) return $url;
    $base = parse_url($base);
    if ($url{0} == "#") {
        // Step 2 (fragment)
        $base['fragment'] = substr($url, 1);
        return unparse_url($base);
    }
    unset($base['fragment']);
    unset($base['query']);
    if (substr($url, 0, 2) == "//") {
        // Step 4
        return unparse_url(array(
            'scheme'=>$base['scheme'],
            'path'=>substr($url,2),
        ));
    } else if ($url{0} == "/") {
        // Step 5
        $base['path'] = $url;
    } else {
        // Step 6
        $path = explode('/', $base['path']);
        $url_path = explode('/', $url);
        // Step 6a: drop file from base
        array_pop($path);
        // Step 6b, 6c, 6e: append url while removing "." and ".." from
        // the directory portion
        $end = array_pop($url_path);
        foreach ($url_path as $segment) {
            if ($segment == '.') {
                // skip
            } else if ($segment == '..' && $path && $path[sizeof($path)-1] != '..') {
                array_pop($path);
            } else {
                $path[] = $segment;
            }
        }
        // Step 6d, 6f: remove "." and ".." from file portion
        if ($end == '.') {
            $path[] = '';
        } else if ($end == '..' && $path && $path[sizeof($path)-1] != '..') {
            $path[sizeof($path)-1] = '';
        } else {
            $path[] = $end;
        }
        // Step 6h
        $base['path'] = join('/', $path);

    }
    // Step 7
    return glue_url($base);
}



