<?php
# YRewrite
$seo = new rex_yrewrite_seo();
if ($seo) {
    ?>
<!-- YRewrite SEO -->
<?= $seo->getTitleTag() ?>
<?= $seo->getDescriptionTag() ?>
<?= $seo->getRobotsTag() ?>
<?= $seo->getHreflangTags() ?>
<?= $seo->getCanonicalUrlTag() ?>
<?= '<meta property="og:title" content="'. $seo->getTitle() .'" />' ?>
<?= '<meta property="og:description" content="'. $seo->getDescription().'" />' ?>
<?= '<meta property="og:url" content="'. $seo->getCanonicalUrl().'" />' ?>
<!-- / YRewrite SEO -->
<?php
} // $seo
?>
<?php
if (!$domain = $this->getVar('domain')) {
    $domain = domain::getCurrent();
}
?>
<!-- YRewrite Meta-Infos Domain -->
<meta property="og:site_name" content="<?= $domain->getName(); ?>" />
<meta property="og:type" content="<?= $domain->getType(); ?>" />
<!-- / YRewrite Meta-Infos Domain -->
<?php
if ($icon = $domain->getIcon()) {
    ?>
<!-- YRewrite Meta-Infos Icon-Profil -->
<?php if($icon->getTouchIcon()) { ?>
<link rel="apple-touch-icon" sizes="180x180"
    href="<?= $icon->getTouchIcon() ?>">
<?php } ?>
<?php if($icon->getIcon(32)) { ?>
<link rel="icon" type="image/png" sizes="32x32"
    href="<?= $icon->getIcon(32) ?>">
<?php } ?>
<?php if($icon->getIcon(16)) { ?>
<link rel="icon" type="image/png" sizes="16x16"
    href="<?= $icon->getIcon(16) ?>">
<?php } ?>
<?php if($icon->getManifest()) { ?>
<link rel="manifest" href="<?= $icon->getManifest() ?>">
<?php } ?>
<?php if($icon->getPinnedTab()) { ?>
<link rel="mask-icon" href="<?= $icon->getPinnedTab() ?>"
    color="<?= $icon->getThemeColor() ?>">
<?php } ?>
<?php if($icon->getFavicon()) { ?>
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
