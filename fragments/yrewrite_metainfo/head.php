<?php

use Alexplusde\Wsm\Fragment;
use FriendsOfRedaxo\YrewriteMetainfo\Domain;
use FriendsOfRedaxo\YrewriteMetainfo\Icon;

$seo = new rex_yrewrite_seo();

if (!$domain = $this->getVar('domain')) {
    $domain = Domain::getCurrent();
}
if ($domain instanceof Domain) {
?>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<!-- YRewrite Meta-Infos Domain -->
<meta property="og:site_name" content="<?= $domain->getName() ?>" />
<meta property="og:type" content="<?= $domain->getType() ?>" />
<!-- / YRewrite Meta-Infos Domain -->
<?= $seo->getTags();
?>
<?php
if ($icon = $domain->getIcon()) {
    /** @var Icon $icon */
    ?>
<!-- YRewrite Meta-Infos Icon-Profil -->
<?php if ($icon->getAppleTouchIcon()) { ?>
<link rel="apple-touch-icon" sizes="180x180"
	href="<?= $icon->getAppleTouchIconUrl() ?>">
<?php } ?>
<?php if ($icon->getManifest()) { ?>
<link rel="manifest" href="<?= $icon->getManifestUrl() ?>">
<?php } ?>
<?php if ($icon->getShortcutIcon()) { ?>
<link rel="shortcut icon" href="<?= $icon->getShortcutIconUrl() ?>">
<?php } ?>
<?php if ($icon->getFaviconPng96()) { ?>
<link rel="icon" type="image/png" href="<?= $icon->getFaviconPng96Url() ?>" sizes="96x96" />
<?php } ?>
<?php if ($icon->getFaviconSvg()) { ?>
<link rel="icon" type="image/svg+xml" href="<?= $icon->getFaviconSvgUrl() ?>" />
<?php } ?>
<meta name="apple-mobile-web-app-title"
	content="<?= $icon->getShortName() ?>">
<meta name="application-name" content="<?= $icon->getShortName() ?>">
<meta name="theme-color" content="<?= $icon->getThemeColor() ?>">
<!-- / YRewrite Meta-Infos Icon-Profil -->
<?php
} // $icon
}

if (class_exists('speed_up')) {
    $speed_up = new speed_up();
    $speed_up->show();
}

if (rex_addon::get('wenns_sein_muss')->isAvailable()) {
    echo Fragment::getCss();
    echo Fragment::getScripts();
    echo Fragment::getJs();
} ?>
