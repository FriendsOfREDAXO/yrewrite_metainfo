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
<?php if ($icon->getSafariPinnedTab()) { ?>
<link rel="mask-icon" href="<?= $icon->getSafariPinnedTabUrl() ?>"
	color="<?= $icon->getThemeColor() ?>">
<?php } ?>
<?php if ($icon->getShortcutIcon()) { ?>
<link rel="shortcut icon" href="<?= $icon->getShortcutIconUrl() ?>">
<?php } ?>
<meta name="apple-mobile-web-app-title"
	content="<?= $icon->getShortName() ?>">
<meta name="application-name" content="<?= $icon->getShortName() ?>">
<meta name="msapplication-TileColor"
	content="<?= $icon->getMsapplicationTitleColor() ?>">
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
