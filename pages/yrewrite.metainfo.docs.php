<?php

/**
 * @var rex_addon $this
 * @psalm-scope-this rex_addon
 */

$mdFiles = [];
$files = (array) glob(rex_addon::get('yrewrite_metainfo')->getPath('docs') . '/*.md');
foreach ($files as $file) {
    $mdFiles[mb_substr(basename((string) $file), 0, -3)] = $file;
}

$currentMDFile = rex_request('mdfile', 'string', '01_intro');
if (!array_key_exists($currentMDFile, $mdFiles)) {
    $currentMDFile = '01_intro';
}

$page = rex_be_controller::getPageObject('yrewrite/metainfo/docs');

if (null !== $page) {
    foreach ($mdFiles as $key => $mdFile) {
        $keyWithoudPrio = mb_substr($key, 3);
        $currentMDFileWithoudPrio = mb_substr($currentMDFile, 3);
        $page->addSubpage(
            (new rex_be_page($key, rex_i18n::msg('yrewrite_metainfo_docs_' . $keyWithoudPrio)))
            ->setSubPath((string) $mdFile)
            ->setHref('index.php?page=yrewrite/metainfo/docs&mdfile=' . $key)
            ->setIsActive($key === $currentMDFile),
        );
    }
}

[$Toc, $Content] = rex_markdown::factory()->parseWithToc(rex_file::require((string) $mdFiles[$currentMDFile]), 2, 3, [
    rex_markdown::SOFT_LINE_BREAKS => false,
    rex_markdown::HIGHLIGHT_PHP => true,
]);

$fragment = new rex_fragment();
$fragment->setVar('content', $Content, false);
$fragment->setVar('toc', $Toc, false);
$content = $fragment->parse('core/page/docs.php');

$fragment = new rex_fragment();
$fragment->setVar('title', rex_i18n::msg('package_help') . ' ', false);
$fragment->setVar('body', $content, false);
echo $fragment->parse('core/page/section.php');
