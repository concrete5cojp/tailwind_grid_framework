<?php
namespace Concrete\Package\TailwindGridFramework\Controller\SinglePage\Dashboard\System;

use Concrete\Core\Page\Controller\DashboardPageController;

class Tailwind extends DashboardPageController
{
    public function view()
    {
        return $this->buildRedirect('/dashboard/system/tailwind/grid');
    }
}