<?php
if (!$domain = $this->getVar('domain')) {
    $domain = domain::get(rex_yrewrite::getCurrentDomain()->getId());
}
?>
<style>
    :root {
        <?php
        foreach ($domain->getValue('cssvars') as $key => $var) {
            echo '--'.$key.': '.$var.';'.PHP_EOL;
        }
        ?>
    }
</style>