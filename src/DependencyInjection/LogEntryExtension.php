<?php

namespace Beutsing\LogEntryBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

class LogEntryExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $container->register(
            \Beutsing\LogEntryBundle\Service\LogEntryService::class)
        ->setAutowired(true)
        ->setAutoconfigured(true)
        ->setPublic(true);
    }
}
