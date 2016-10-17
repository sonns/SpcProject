<div class="col-sm-12" style="padding-bottom: 10px;">
    <?php
    use Cake\Core\Configure;
    use Cake\Error\Debugger;

    $this->layout = 'AdminTheme.error';

    if (Configure::read('debug')):
//    $this->layout = 'dev_error';
        $this->assign('title', 'PAGE NOT FOUND');
        $this->assign('templateName', 'missing_action.ctp');

        $this->start('file');
        ?>
        <?php if (!empty($error->queryString)) : ?>
        <p class="notice">
            <strong>SQL Query: </strong>
            <?= h($error->queryString) ?>
        </p>
    <?php endif; ?>
        <?php if (!empty($error->params)) : ?>
        <strong>SQL Query Params: </strong>
        <?php Debugger::dump($error->params) ?>
    <?php endif; ?>
        <?php if ($error instanceof Error) : ?>
        <strong>Error in: </strong>
        <?= sprintf('%s, line %s', str_replace(ROOT, 'ROOT', $error->getFile()), $error->getLine()) ?>
    <?php endif; ?>
        <?php
        echo $this->element('auto_table_warning');

        if (extension_loaded('xdebug')):
            xdebug_print_function_stack();
        endif;

        $this->end();
    endif;
    ?>
    <?php echo $this->Html->image('AdminTheme./images/error-img.png', ['alt' => 'SPC COMPANY']);?>
    <h2 class="col-sm-12"><?= __d('cake', '<strong style="color: red;">Ohh.....</strong>You Requested the page that is no longer There.') ?></h2>
    <p class="error">
        <?php if (Configure::read('debug')): ?>
            <?= h($message) ?>
        <?php endif;?>
    </p>
</div>