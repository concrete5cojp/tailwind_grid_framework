# Tailwind CSS Grid Framework for concrete5

A package to add Tailwindcss Grid Framework to concrete5 CMS

## Known limitation

concrete5 before version 9 can't treat css grid. This package is built for version 8, so this package uses flexbox grid layout.

## Usage

How to Support Tailwindcss Grid Framework in your theme (`page_theme.php`)

```php
<?php
namespace Application\Theme\YourTheme;

use Concrete\Core\Area\Layout\Preset\Provider\ThemeProviderInterface;
use Concrete\Core\Page\Theme\Theme;

class PageTheme extends Theme implements ThemeProviderInterface
{
    protected $pThemeGridFrameworkHandle = 'tailwindcss_flexbox';

    public function registerAssets()
    {
        $this->requireAsset('tailwindcss1');
        // $this->providesAsset('css', 'tailwindcss1'); // If your theme already loaded tailwindcss, remove this comment out.
    }

    public function getThemeName()
    {
        return t('Your Theme');
    }
...
```

## References

* [Requiring an Asset](https://documentation.concrete5.org/developers/assets/requiring-an-asset) 
* [Tailwindcss v1 doc](https://v1.tailwindcss.com/docs)
