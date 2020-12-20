<?php
namespace C5j\TailwindGridFramework\Page\Theme\GridFramework\Type;

use Concrete\Core\Package\PackageService;
use Concrete\Core\Page\Theme\GridFramework\GridFramework;
use Concrete\Core\Support\Facade\Application;

class TailwindcssFlexbox extends GridFramework
{
    public const DEFAULT_CLASS_CONTAINER = 'container mx-auto my-4';
    public const DEFAULT_CLASS_ROW = 'md:flex md:flex-row md:-mx-4';
    public const DEFAULT_CLASS_COLUMN = 'flex-grow flex-shrink mx-4';

    public function getPageThemeGridFrameworkName()
    {
        return t('Tailwindcss Flexbox Grid Framework');
    }

    public function getPageThemeGridFrameworkRowStartHTML()
    {
        $class = $this->getConfigClass('row', self::DEFAULT_CLASS_ROW);

        return '<div class="' . h($class) . '">';
    }

    public function getPageThemeGridFrameworkRowEndHTML()
    {
        return '</div>';
    }

    public function getPageThemeGridFrameworkContainerStartHTML()
    {
        $class = $this->getConfigClass('container', self::DEFAULT_CLASS_CONTAINER);

        return '<div class="' . h($class) . '">';
    }

    public function getPageThemeGridFrameworkContainerEndHTML()
    {
        return '</div>';
    }

    public function getPageThemeGridFrameworkColumnClasses()
    {
        return [
            'flex-basis-col-1',
            'flex-basis-col-2',
            'flex-basis-col-3',
            'flex-basis-col-4',
            'flex-basis-col-5',
            'flex-basis-col-6',
            'flex-basis-col-7',
            'flex-basis-col-8',
            'flex-basis-col-9',
            'flex-basis-col-10',
            'flex-basis-col-11',
            'flex-basis-col-12',
        ];
    }

    public function getPageThemeGridFrameworkColumnOffsetClasses()
    {
        return [];
    }

    public function getPageThemeGridFrameworkColumnAdditionalClasses()
    {
        return $this->getConfigClass('column', self::DEFAULT_CLASS_COLUMN);
    }

    public function getPageThemeGridFrameworkColumnOffsetAdditionalClasses()
    {
        return '';
    }

    public function getPageThemeGridFrameworkHideOnExtraSmallDeviceClass()
    {
        return 'sm:hidden';
    }

    public function getPageThemeGridFrameworkHideOnSmallDeviceClass()
    {
        return 'md:hidden';
    }

    public function getPageThemeGridFrameworkHideOnMediumDeviceClass()
    {
        return 'lg:hidden';
    }

    public function getPageThemeGridFrameworkHideOnLargeDeviceClass()
    {
        return 'xl:hidden';
    }

    private function getConfigClass(string $key, string $default)
    {
        $app = Application::getFacadeApplication();
        /** @var PackageService $service */
        $service = $app->make(PackageService::class);
        $package = $service->getClass('tailwind_grid_framework');
        $config = $package->getFileConfig();
        if ($config) {
            $class = (string) $config->get('classes.' . $key);
            if (!empty($class)) {
                return $class;
            }
        }

        return $default;
    }
}