<?php

/*
 * This file is part of the Elcodi package.
 *
 * Copyright (c) 2014 Elcodi.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 * @author Aldo Chiecchia <zimage@tiscali.it>
 */

namespace Elcodi\Bundle\PageBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\ConfigurationInterface;

use Elcodi\Bundle\CoreBundle\DependencyInjection\Abstracts\AbstractConfiguration;

/**
 * Class Configuration
 *
 * @author Berny Cantos <be@rny.cc>
 */
class Configuration extends AbstractConfiguration implements ConfigurationInterface
{
    /**
     * Configure the root node
     *
     * @param ArrayNodeDefinition $rootNode
     */
    protected function setupTree(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
                ->arrayNode('mapping')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->append($this->addMappingNode(
                            'page',
                            'Elcodi\Component\Page\Entity\Page',
                            '@ElcodiPageBundle/Resources/config/doctrine/Page.orm.yml',
                            'default',
                            true
                        ))
                    ->end()
                ->end()

                ->arrayNode('routing')
                    ->addDefaultsIfNotSet()
                    ->canBeDisabled()
                    ->children()
                        ->scalarNode('loader')
                            ->defaultValue('elcodi.core.page.router.simple_loader.loader')
                        ->end()

                        ->scalarNode('route_name')
                            ->defaultValue('elcodi_page_render_view')
                        ->end()

                        ->scalarNode('route_path')
                            ->defaultValue('/{path}')
                        ->end()

                        ->scalarNode('controller')
                            ->defaultValue('elcodi.core.page.controller.page:renderAction')
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
