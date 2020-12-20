<?php
namespace Concrete\Package\TailwindGridFramework\Controller\SinglePage\Dashboard\System\Tailwind;

use C5j\TailwindGridFramework\Page\Theme\GridFramework\Type\TailwindcssFlexbox;
use Concrete\Core\Package\PackageService;
use Concrete\Core\Page\Controller\DashboardPageController;

class Grid extends DashboardPageController
{
    public function view()
    {
        $config = $this->getPackageConfig();
        if ($config) {
            $this->set('containerClass', $config->get('classes.container', TailwindcssFlexbox::DEFAULT_CLASS_CONTAINER));
            $this->set('rowClass', $config->get('classes.row', TailwindcssFlexbox::DEFAULT_CLASS_ROW));
            $this->set('columnClass', $config->get('classes.column', TailwindcssFlexbox::DEFAULT_CLASS_COLUMN));
        }
        $this->set('pageTitle', t('Tailwindcss Grid Framework'));
    }

    public function save()
    {
        if (!$this->token->validate('tailwind_grid')) {
            $this->error->add($this->token->getErrorMessage());
        }

        if (!$this->error->has()) {
            $config = $this->getPackageConfig();
            if ($config) {
                $containerClass = $this->get('containerClass');
                if (!empty($containerClass)) {
                    $config->save('classes.container', $containerClass);
                }
                $rowClass = $this->get('rowClass');
                if (!empty($rowClass)) {
                    $config->save('classes.row', $rowClass);
                }
                $columnClass = $this->get('columnClass');
                if (!empty($columnClass)) {
                    $config->save('classes.column', $columnClass);
                }
            }
            $this->flash('success', t('Successfully updated.'));

            return $this->buildRedirect($this->action('view'));
        }
    }

    private function getPackageConfig(): ?\Concrete\Core\Config\Repository\Liaison
    {
        /** @var PackageService $service */
        $service = $this->app->make(PackageService::class);
        $package = $service->getClass('tailwind_grid_framework');
        return $package->getFileConfig();
    }
}