<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JS\SonataExtendsBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;

class CustomAdminController extends Controller
{
    /**
     * Contextualize the admin class depends on the current request
     *
     * @throws \RuntimeException
     * @return void
     */
    protected function configure()
    {
        $adminCode = 'js.admin.lumen.extends.base';
        
        if (!$adminCode) 
        {
            throw new \RuntimeException(sprintf('There is no `_sonata_admin` defined for the controller `%s` and the current route `%s`', get_class($this), $this->container->get('request')->get('_route')));
        }

        $this->admin = $this->container->get('sonata.admin.pool')->getAdminByAdminCode($adminCode);
        
        if (!$this->admin) 
        {
            throw new \RuntimeException(sprintf('Unable to find the admin class related to the current controller (%s)', get_class($this)));
        }

        $rootAdmin = $this->admin;

        if ($this->admin->isChild()) 
        {
            $this->admin->setCurrentChild(true);
            $rootAdmin = $rootAdmin->getParent();
        }

        $request = $this->container->get('request');

        $rootAdmin->setRequest($request);

        if ($request->get('uniqid')) 
        {
            $this->admin->setUniqid($request->get('uniqid'));
        }
    }
}
