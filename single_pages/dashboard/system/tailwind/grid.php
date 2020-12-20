<?php
defined('C5_EXECUTE') or die('Access Denied.');
/** @var \Concrete\Core\Validation\CSRF\Token $token */
/** @var \Concrete\Core\Form\Service\Form $form */
$containerClass = $containerClass ?? '';
$rowClass = $rowClass ?? '';
$columnClass = $columnClass ?? '';
?>
<form method="post" action="<?= $this->action('save') ?>" class="ccm-dashboard-content-form">
    <?php $token->output('tailwind_grid'); ?>
    <fieldset>
        <div class="form-group">
            <?= $form->label('containerClass', t('Container Class')) ?>
            <?= $form->text('containerClass', $containerClass) ?>
        </div>
        <div class="form-group">
            <?= $form->label('rowClass', t('Row Class')) ?>
            <?= $form->text('rowClass', $rowClass) ?>
        </div>
        <div class="form-group">
            <?= $form->label('columnClass', t('Column Class')) ?>
            <?= $form->text('columnClass', $columnClass) ?>
        </div>
        <pre><?php
            $sample = <<<EOT
<div class="$containerClass">
    <div class="$rowClass">
        <div class="$columnClass"></div>
        <div class="$columnClass"></div>
        <div class="$columnClass"></div>
    </div>
</div>
EOT;
            echo htmlentities($sample);
            ?></pre>
    </fieldset>
    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <?= $form->submit('submit', t('Save'), ['class' => 'btn btn-primary pull-right']) ?>
        </div>
    </div>
</form>