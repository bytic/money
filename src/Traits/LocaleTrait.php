<?php

namespace ByTIC\Money\Traits;

/**
 * Trait LocaleTrait
 * @package ByTIC\Money\Traits
 */
trait LocaleTrait
{
    /**
     * @var string
     */
    protected static $locale;

    /**
     * Get locale.
     *
     * @return string
     */
    public static function getLocale()
    {
        if (!isset(static::$locale)) {
            static::setLocale(
                'en_US'
//                config('money.locale', 'en_US')
            );
        }

        return static::$locale;
    }

    /**
     * Set locale.
     *
     * @param string $locale
     */
    public static function setLocale($locale)
    {
        static::$locale = $locale;
    }
}