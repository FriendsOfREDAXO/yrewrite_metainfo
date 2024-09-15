<?php

use FriendsOfRedaxo\YrewriteMetainfo\Icon;

/**
 * @var rex_addon $this
 * @psalm-scope-this rex_addon
 */

$addon = rex_addon::get('yrewrite_metainfo');
$table_name = 'rex_yrewrite_metainfo_icon';

rex_extension::register(
    'YFORM_MANAGER_DATA_PAGE_HEADER',
    static function (rex_extension_point $ep) {
        if ($ep->getParam('yform')->table->getTableName() === $ep->getParam('table_name')) { // @phpstan-ignore-line
            return '';
        }
    },
    rex_extension::EARLY,
    ['table_name' => $table_name],
);

$_REQUEST['table_name'] = $table_name; /** @phpstan-ignore-line */

// Wenn ein ZIP-File hochgeladen wurde, entpacken und in die Datenbank speichern
if (isset($_FILES['realfaviconzip']) && 0 === $_FILES['realfaviconzip']['error']) {
    $zip = new ZipArchive();
    $res = $zip->open($_FILES['realfaviconzip']['tmp_name']);
    if (true === $res) {
        $zip->extractTo(rex_path::addonCache('yrewrite_metainfo', date('Y-m-d h-i-s')));
        $zip->close();

        $files = glob(rex_path::addonCache('yrewrite_metainfo', date('Y-m-d h-i-s')) . DIRECTORY_SEPARATOR . '*');
        $manifest = file_get_contents(rex_path::addonCache('yrewrite_metainfo', date('Y-m-d h-i-s')) . DIRECTORY_SEPARATOR . 'site.webmanifest');

        $manifest = json_decode($manifest, true);
        if ('' == $manifest['short_name']) {
            $manifest['short_name'] = date('Y-m-d-h-i-s');
        }

        $media_category_id = rex_post('media_category_id', 'int', 0);

        /* Neue Medienpool-Kategorie hinzufügen, wenn -1 */
        if (-1 === $media_category_id) {
            $category = new rex_media_category_service();
            $category->addCategory('Favicon ' . $manifest['short_name'], 0);
            /* Finde zuletzt angelegte Kategorie */
            $latest_category = rex_sql::factory()->setQuery('SELECT id FROM ' . rex::getTable('media_category') . ' ORDER BY id DESC LIMIT 1')->getArray();
            $media_category_id = array_shift($latest_category)['id'];
        }

        $prefix = rex_string::normalize($manifest['short_name']) . '_';

        foreach ($files as $file) {
            if (is_file($file)) {
                $filename = basename($file);

                $data = [];
                $data['title'] = 'Icon-Profil: ' . $manifest['name'];
                $data['category_id'] = $media_category_id;
                $data['file'] = [
                    'name' => $prefix . $filename,
                    'path' => $file,
                ];
                rex_media_service::addMedia($data, false);
            }
        }

        $dataset = Icon::create();
        $dataset->setName($manifest['name']);
        $dataset->setShortName($manifest['short_name']);
        $dataset->setDisplay($manifest['display']);
        $dataset->setThemeColor($manifest['theme_color']);
        $dataset->setBackgroundColor($manifest['background_color']);
        $dataset->setMsapplicationTitleColor($manifest['theme_color']);
        $dataset->setShortcutIcon($prefix . 'favicon.ico');
        $dataset->setIcon16($prefix . 'favicon-16x16.png');
        $dataset->setIcon32($prefix . 'favicon-32x32.png');
        $dataset->setAppleTouchIcon($prefix . 'apple-touch-icon.png');
        $dataset->setSafariPinnedTab($prefix . 'safari-pinned-tab.svg');
        $dataset->setManifest($prefix . 'site.webmanifest');
        $dataset->save();
    }
}

$select = new rex_media_category_select(true);
$select->setName('media_category_id');
$select->addOption($this->i18n('yrewrite_metainfo_domain_icon_zip_upload_media_category_id_option_new'), -1);
$select->addOption($this->i18n('yrewrite_metainfo_domain_icon_zip_upload_media_category_id_option_root'), 0);
$select->setSelected(-1);

$form = '<form id="realfavicon" action="" method="post" enctype="multipart/form-data">
    <label for="realfaviconzip">' . $this->i18n('yrewrite_metainfo_domain_icon_zip_upload_label') . '</label>
    <input type="file" name="realfaviconzip" id="realfaviconzip" class="form-control">
    <p class="notice">' . $this->i18n('yrewrite_metainfo_domain_icon_zip_upload_notice') . '</p>
    <label for="media_category_id">' . $this->i18n('yrewrite_metainfo_domain_icon_zip_upload_media_category_id_label') . '</label>
    ' . $select->get() . '
    <p class="notice">' . $this->i18n('yrewrite_metainfo_domain_icon_zip_upload_media_category_id_notice') . '</p>
    <input class="btn btn-primary" type="submit" value="' . $this->i18n('yrewrite_metainfo_domain_icon_zip_upload_submit') . '">
</form>';

$fragment = new rex_fragment();
$fragment->setVar('title', $this->i18n('yrewrite_metainfo_domain_icon_zip_upload_title'));
$fragment->setVar('body', $form, false);
$fragment->setVar('class', 'info', false);

echo $fragment->parse('core/page/section.php');

/* Weiter mit YForm */
include rex_path::plugin('yform', 'manager', 'pages/data_edit.php');
