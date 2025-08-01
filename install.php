<?php

rex_sql_table::get(rex::getTable('yrewrite_metainfo'))
    ->ensurePrimaryIdColumn()
    ->ensureColumn(new rex_sql_column('yrewrite_domain_id', 'int(10) unsigned'))
    ->ensureColumn(new rex_sql_column('name', 'varchar(191)', false, ''))
    ->ensureColumn(new rex_sql_column('logo', 'text'))
    ->ensureColumn(new rex_sql_column('type', 'varchar(191)', false, 'website'))
    ->ensureColumn(new rex_sql_column('thumbnail', 'text'))
    ->ensureColumn(new rex_sql_column('icon', 'int(10) unsigned'))
    ->ensureColumn(new rex_sql_column('favicon_png_96', 'text'))
    ->ensureColumn(new rex_sql_column('favicon_svg', 'text'))
    ->ensureIndex(new rex_sql_index('yrewrite_domain_id', ['yrewrite_domain_id']))
    ->ensure();

rex_sql_table::get(rex::getTable('yrewrite_metainfo_icon'))
    ->ensurePrimaryIdColumn()
    ->ensureColumn(new rex_sql_column('name', 'varchar(191)', false, ''))
    ->ensureColumn(new rex_sql_column('short_name', 'varchar(191)', false, ''))
    ->ensureColumn(new rex_sql_column('display', 'varchar(191)'))
    ->ensureColumn(new rex_sql_column('theme_color', 'varchar(191)', false, '#ffffff'))
    ->ensureColumn(new rex_sql_column('background_color', 'varchar(191)', false, ''))
    ->ensureColumn(new rex_sql_column('shortcut_icon', 'text'))
    ->ensureColumn(new rex_sql_column('apple_touch_icon', 'text'))
    ->ensureColumn(new rex_sql_column('manifest', 'text'))
    ->removeColumn('icon_16')
    ->removeColumn('icon_32')
    ->removeColumn('safari_pinned_tab')
    ->removeColumn('msapplication_title_color')
    ->removeColumn('yrewrite_metainfo_theme_color')
    ->ensure();

$addon = rex_addon::get('yrewrite_metainfo');

if (rex_addon::get('yform')->isAvailable() && !rex::isSafeMode()) {
    rex_yform_manager_table_api::importTablesets(rex_file::get(__DIR__ . '/install/rex_yrewrite_metainfo.tableset.json')); // @phpstan-ignore-line
    rex_yform_manager_table_api::importTablesets(rex_file::get(__DIR__ . '/install/rex_yrewrite_metainfo_icon.tableset.json')); // @phpstan-ignore-line
    rex_yform_manager_table::deleteCache();
}
