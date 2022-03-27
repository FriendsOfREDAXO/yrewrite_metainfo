<?php

if(!$domain = $this->getVar('domain')) {
    $domain = domain::get(rex_yrewrite::getCurrentDomain()->getId()); 
}

$seo = new rex_yrewrite_seo();
echo $seo->getTitleTag() . PHP_EOL;
echo $seo->getDescriptionTag() . PHP_EOL;
echo $seo->getRobotsTag() . PHP_EOL;
echo $seo->getHreflangTags() . PHP_EOL;
echo $seo->getCanonicalUrlTag() . PHP_EOL;
echo '<meta property="og:title" content="'. $seo->getTitle() .'" />';
echo '<meta property="og:image" content="'. trim(rex_yrewrite::getFullUrlByArticleId(rex_article::getSiteStartArticleId()), '/').'" />';
echo '<meta property="og:description" content="'. $seo->getDescription().'" />';
echo '<meta property="og:url" content="'. $seo->getCanonicalUrl().'" />';

?>    

<meta property="og:site_name" content="<?= rex::getServerName(); ?>" />
<meta property="og:type" content="company" />
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png?v=2022-01-06">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png?v=2022-01-06">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png?v=2022-01-06">
<link rel="manifest" href="/site.webmanifest?v=2022-01-06">
<link rel="mask-icon" href="/safari-pinned-tab.svg?v=2022-01-06" color="<?= $domain->getColor() ?>">
<link rel="shortcut icon" href="/favicon.ico?v=2022-01-06">
<meta name="apple-mobile-web-app-title" content="<?= $domain->getName() ?>">
<meta name="application-name" content="<?= $domain->getName() ?>">
<meta name="msapplication-TileColor" content="<?= $domain->getColor() ?>">
<meta name="theme-color" content="<?= $domain->getColor() ?>">
