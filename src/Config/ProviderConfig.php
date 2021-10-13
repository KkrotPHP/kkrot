<?php

namespace Kkrot\Config;

class ProviderConfig
{
    /**
     * @var array
     */
    private static $providerConfigs = [];

    /**
     * Load and merge all provider configs from components.
     * Notice that this method will cached the config result into a static property,
     * call ProviderConfig::clear() method if you want to reset the static property.
     */
    public static function load(): array
    {
        if (! static::$providerConfigs) {
            $providers = Composer::getMergedExtra('hyperf')['config'] ?? [];
            static::$providerConfigs = static::loadProviders($providers);
        }
        return static::$providerConfigs;
    }

    public static function clear(): void
    {
        static::$providerConfigs = [];
    }

    protected static function loadProviders(array $providers): array
    {
        $providerConfigs = [];
        foreach ($providers as $provider) {
            if (is_string($provider) && class_exists($provider) && method_exists($provider, '__invoke')) {
                $providerConfigs[] = (new $provider())();
            }
        }

        return static::merge(...$providerConfigs);
    }

    protected static function merge(...$arrays): array
    {
        if (empty($arrays)) {
            return [];
        }
        $result = array_merge_recursive(...$arrays);
        if (isset($result['dependencies'])) {
            $dependencies = array_column($arrays, 'dependencies');
            $result['dependencies'] = array_merge(...$dependencies);
        }

        return $result;
    }
}