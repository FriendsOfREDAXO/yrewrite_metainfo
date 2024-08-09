<?php

use Alexplusde\YrewriteMetainfo\Domain;
use Url\Seo;

$seo = rex_addon::get('url')->isAvailable() ? new Seo() : new rex_yrewrite_seo();
if (!is_array($seo->getTags())) {
    echo $seo->getTags();
}

if (!$domain = $this->getVar('domain')) {
    $domain = Domain::getCurrent();
}
?>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
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
	href="<?= $icon->getTouchIconUrl() ?>">
<?php } ?>
<?php if ($icon->getIcon32(true)) { ?>
<link rel="icon" type="image/png" sizes="32x32"
	href="<?= $icon->getIcon32Url() ?>">
<?php } ?>
<?php if ($icon->getIcon16(true)) { ?>
<link rel="icon" type="image/png" sizes="16x16"
	href="<?= $icon->getIcon16Url() ?>">
<?php } ?>
<?php if ($icon->getManifest()) { ?>
<link rel="manifest" href="<?= $icon->getManifestUrl() ?>">
<?php } ?>
<?php if ($icon->getPinnedTab()) { ?>
<link rel="mask-icon" href="<?= $icon->getPinnedTabUrl() ?>"
	color="<?= $icon->getThemeColor() ?>">
<?php } ?>
<?php if ($icon->getFavicon()) { ?>
<link rel="shortcut icon" href="<?= $icon->getFaviconUrl() ?>">
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

if (class_exists('speed_up')) {
    $speed_up = new speed_up();
    $speed_up->show();
}

if (class_exists('wsm_fragment')) {
    echo wsm_fragment::getCss();
    echo wsm_fragment::getScripts();
    echo wsm_fragment::getJs();
} ?>
