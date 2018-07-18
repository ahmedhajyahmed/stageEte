<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ILANEO\UserBundle;

use Doctrine\Bundle\CouchDBBundle\DependencyInjection\Compiler\DoctrineCouchDBMappingsPass;
use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Doctrine\Bundle\MongoDBBundle\DependencyInjection\Compiler\DoctrineMongoDBMappingsPass;
use FOS\UserBundle\DependencyInjection\Compiler\CheckForMailerPass;
use FOS\UserBundle\DependencyInjection\Compiler\CheckForSessionPass;
use FOS\UserBundle\DependencyInjection\Compiler\InjectRememberMeServicesPass;
use FOS\UserBundle\DependencyInjection\Compiler\InjectUserCheckerPass;
use FOS\UserBundle\DependencyInjection\Compiler\ValidationPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Matthieu Bontemps <matthieu@knplabs.com>
 * @author Thibault Duplessis <thibault.duplessis@gmail.com>
 */
class FOSUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }

}
