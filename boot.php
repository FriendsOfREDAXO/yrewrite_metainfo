<?php

namespace FriendsOfRedaxo\YrewriteMetainfo;

use rex_csrf_token;
use rex_extension;
use rex_extension_point;
use rex_i18n;
use rex_list;
use rex_url;
use rex_yform_manager_dataset;
use rex_yform_manager_table;

rex_yform_manager_dataset::setModelClass(
    'rex_yrewrite_metainfo',
    Domain::class,
);
rex_yform_manager_dataset::setModelClass(
    'rex_yrewrite_metainfo_icon',
    Icon::class,
);

// Listendarstellung von YRewrite Domains um eine Spalte ergänzen mit Link zu YRewrite Metainfos
rex_extension::register('REX_LIST_GET', static function (rex_extension_point $ep) {
    $list = $ep->getSubject();
    /** @var rex_list $list */
    $list->addColumn(rex_i18n::msg('yrewrite_metainfo_title'), '', 3);
    $list->setColumnFormat(rex_i18n::msg('yrewrite_metainfo_title'), 'custom', static function ($a) {
        $table = rex_yform_manager_table::get('rex_yrewrite_metainfo');
        if(!is_object($table)) {
            return '';
        }
        $_csrf_key = $table->getCSRFKey();
        $token = rex_csrf_token::factory($_csrf_key)->getUrlParams();

        $params = [];
        $params['table_name'] = 'rex_yrewrite_metainfo';
        $params['rex_yform_manager_popup'] = '0';
        $params['_csrf_token'] = $token['_csrf_token'];
        $params['data_id'] = $a['list']->getValue('id');
        $params['func'] = 'add';

        $domain = Domain::get($a['list']->getValue('id'));
        if ($domain instanceof Domain) {
            $params['func'] = 'edit';
            return '<a href="' . rex_url::backendPage('yrewrite/metainfo/domain', $params) . '">' . rex_i18n::msg('yrewrite_metainfo_edit') . '</a>';
        }
        // Link zu Neue YRewrite-Metainfo-Domain erstellen
        // https://blaupause.test/redaxo/index.php?func=add&page=yrewrite%2Fmetainfo%2Fdomain&table_name=rex_yrewrite_metainfo&list=&sort=&sorttype=&start=0&_csrf_token=s_AUawHLnRx4uZib-ACHIs9nnbd0tpYpHQP_Vb4PxAg&rex_yform_manager_popup=0

        return '<a href="' . rex_url::backendPage('yrewrite/metainfo/domain', $params) . '">' . rex_i18n::msg('yrewrite_metainfo_add') . '</a>';
    });
    return $list;
});
