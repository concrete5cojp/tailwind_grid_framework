<?php

namespace Concrete\Package\TailwindGridFramework;

use C5j\TailwindGridFramework\Page\Theme\GridFramework\Type\TailwindcssFlexbox;
use Concrete\Core\Asset\AssetList;
use Concrete\Core\Package\Package;
use Concrete\Core\Page\Page;
use Concrete\Core\Page\Theme\GridFramework\Manager;
use Concrete\Core\View\View;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class Controller extends Package
{
    protected $pkgHandle = 'tailwind_grid_framework';
    protected $appVersionRequired = '8.5.4';
    protected $pkgVersion = '0.1';
    protected $pkgAutoloaderRegistries = [
        'src' => '\C5j\TailwindGridFramework',
    ];

    /**
     * {@inheritdoc}
     */
    public function getPackageName()
    {
        return t('Tailwind CSS Grid Framework');
    }

    /**
     * {@inheritdoc}
     */
    public function getPackageDescription()
    {
        return t('Add tailwindcss Grid Framework to use from themes.');
    }

    /**
     * Install process of the package.
     */
    public function install()
    {
        $pkg = parent::install();

        $this->installContentFile('config/install.xml');
    }

    public function on_start()
    {
        $app = $this->app;

        /** @var Manager $manager */
        $manager = $app->make('manager/grid_framework');
        $manager->extend('tailwindcss_flexbox', function () {
            return new TailwindcssFlexbox();
        });

        $list = AssetList::getInstance();
        if ($list) {
            $list->register('css', 'tailwindcss1', 'https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css', ['local' => false]);
            $list->register('css', 'tailwindcss_layoutfix_v8', 'css/layoutfix_v8.css', [], 'tailwind_grid_framework');
            $list->register('css', 'tailwindcss_editfix_v8', 'css/editfix_v8.css', [], 'tailwind_grid_framework');
            $list->registerGroup('tailwindcss1', [
                ['css', 'tailwindcss1'],
                ['css', 'tailwindcss_layoutfix_v8']
            ]);
        }

        /** @var EventDispatcherInterface $dispatcher */
        $dispatcher = $app->make(EventDispatcherInterface::class);
        $dispatcher->addListener('on_before_render', function ($event) use ($app) {
            /** @var GenericEvent $event */
            $page = Page::getCurrentPage();
            if ($page->isEditMode()) {
                /** @var View $view */
                $view = $event->getArgument('view');
                $view->requireAsset('css', 'tailwindcss_editfix_v8');
            }
        });
    }
}