<?php
if (!$domain = $this->getVar('domain')) {
    $domain = domain::get(rex_yrewrite::getCurrentDomain()->getId()); ?>
<style>
    :root {
        <?php
        foreach ($domain->getCssVars() as $key => $var) {
            echo '--'.rex_string::normalize($key).': '.$var.';'.PHP_EOL;
        } ?>
    }
</style>
<?php
}
