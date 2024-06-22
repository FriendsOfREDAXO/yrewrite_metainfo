<?php
if (!$domain = $this->getVar('domain')) {
    $domain = domain::get(rex_yrewrite::getCurrentDomain()->getId());

    $value = json_decode($domain->getCssVars()->getValue('vars'));
    $vars = [];
    array_walk($value, static function ($var) use (&$vars) {
        $vars[$var[0]] = $var[1];
    }) ?>
<style>
    :root {
        <?php foreach ($vars as $key => $value) {
            echo '--' . $key . ': ' . $value . ';' . PHP_EOL . '';
        }

    echo PHP_EOL ?>
    }
</style>
<?php
}
