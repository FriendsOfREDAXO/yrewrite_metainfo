<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<?php

use Alexplusde\YrewriteMetainfo\Domain;
use Url\Seo;

if (rex_addon::get('url')->isAvailable()) {
    $seo = new Seo();
} else {
    $seo = new rex_yrewrite_seo();
}
if (!is_array($seo->getTags())) {
    echo $seo->getTags();
}

if (!$domain = $this->getVar('domain')) {
    $domain = Domain::getCurrent();
}
?>
<!-- YRewrite Meta-Infos Domain -->
<meta property="og:site_name" content="<?= $domain->getName() ?>" />
<meta property="og:type" content="<?= $domain->getType() ?>" />
<!-- / YRewrite Meta-Infos Domain -->
<?php
if ($icon = $domain->getIcon()) {
    ?>
<!-- YRewrite Meta-Infos Icon-Profil -->
<?php if ($icon->getTouchIcon()) { ?>
<link rel="apple-touch-icon" sizes="180x180"
	href="<?= $icon->getTouchIcon() ?>">
<?php } ?>
<?php if ($icon->getIcon(32)) { ?>
<link rel="icon" type="image/png" sizes="32x32"
	href="<?= $icon->getIcon(32) ?>">
<?php } ?>
<?php if ($icon->getIcon(16)) { ?>
<link rel="icon" type="image/png" sizes="16x16"
	href="<?= $icon->getIcon(16) ?>">
<?php } ?>
<?php if ($icon->getManifest()) { ?>
<link rel="manifest" href="<?= $icon->getManifest() ?>">
<?php } ?>
<?php if ($icon->getPinnedTab()) { ?>
<link rel="mask-icon" href="<?= $icon->getPinnedTab() ?>"
	color="<?= $icon->getThemeColor() ?>">
<?php } ?>
<?php if ($icon->getFavicon()) { ?>
<link rel="shortcut icon" href="<?= $icon->getFavicon() ?>">
<?php } ?>
<meta name="apple-mobile-web-app-title"
	content="<?= $icon->getShortName() ?>">
<meta name="application-name" content="<?= $icon->getShortName() ?>">
<meta name="msapplication-TileColor"
	content="<?= $icon->getTitleColor() ?>">
<meta name="theme-color" content="<?= $icon->getThemeColor() ?>">
<!-- / YRewrite Meta-Infos Icon-Profil -->
<?php
} // $icon

foreach (array_filter($domain->getStyles()) as $style) {
    ?>
<link href="/assets/styles/<?= $style ?>" rel="stylesheet">

<?php
}

foreach (array_filter($domain->getScripts()) as $script) {
    ?>
<script src="/assets/scripts/<?= $script ?>"></script>


<?php
}

if (rex_addon::get('speed_up') && rex_addon::get('speed_up')->isAvailable()) {
    $speed_up = new speed_up();
    $speed_up->show();
}

if (rex_addon::get('wenns_sein_muss') && rex_addon::get('wenns_sein_muss')->isAvailable()) {
    echo wsm_fragment::getCss();
    echo wsm_fragment::getScripts();
    echo wsm_fragment::getJs();
} ?>
