<?php


namespace Query\phpQuery\plugins;


/**
 * phpQuery plugin class extending phpQuery static namespace.
 * Methods from this class are callable as follows:
 * phpQuery::$plugins->staticMethod()
 *
 * Class name prefix 'phpQueryPlugin_' must be preserved.
 */
abstract class phpQueryPlugin_example {
    /**
     * Limit binded methods.
     *
     * null means all public.
     * array means only specified ones.
     *
     * @var array|null
     */
    public static $phpQueryMethods = null;
    public static function staticMethod() {
        // this method can be called within phpQuery class namespace, like this:
        // phpQuery::$plugins->staticMethod()
    }
}