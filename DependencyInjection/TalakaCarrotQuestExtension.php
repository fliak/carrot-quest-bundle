<?php

namespace Talaka\CarrotQuestBundle\DependencyInjection;


use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\BadMethodCallException;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;

/**
 * Created by PhpStorm.
 * User: fliak
 * Date: 2.9.16
 * Time: 7.51
 */
class TalakaCarrotQuestExtension extends Extension
{


    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

    }


}
