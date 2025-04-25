<?php

namespace App\Component\DependencyInjection;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\DependencyInjection\EnvVarProcessorInterface;

#[AutoconfigureTag('container.env_var_processor')]
final class TrimProcessor implements EnvVarProcessorInterface
{
    public function getEnv(string $prefix, string $name, \Closure $getEnv): mixed
    {
        return trim($getEnv($name));
    }

    public static function getProvidedTypes(): array
    {
        return [
            'trim' => 'string',
        ];
    }
}
