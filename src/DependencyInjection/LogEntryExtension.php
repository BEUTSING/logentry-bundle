<?php

namespace Beutsing\LogEntryBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

class LogEntryExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $container->registerForAutoconfiguration(
            \Beutsing\LogEntryBundle\Service\LogEntryService::class)
                ->setAutowired(true)
                ->setAutoconfigured(true)
                ->setPublic(true);

        $container->prependExtensionConfig('doctrine',[
            "orm"=> [
                'mappings'=> [
                    'is_bundle'=> false,
                    'type'=>'attribute',
                    'dir'=> '%kernel.project_dir%/vendor/beutsing/log-entry-bundle/src/Entity',
                    'prefix'=> 'Beutsing\LogEntryBundle\Entity',
                    'alias'=> 'LogEntryBundle'
            
                ],
            ],
        ]);        
    }
}
