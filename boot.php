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

use function is_object;

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
    if ('yrewrite/domains' !== $ep->getSubject()->getParams()['page']) {
        return;
    }
    $list = $ep->getSubject();
    /** @var rex_list $list */
    $list->addColumn(rex_i18n::msg('yrewrite_metainfo_title'), '', 3);
    $list->setColumnFormat(rex_i18n::msg('yrewrite_metainfo_title'), 'custom', static function ($a) {
        $table = rex_yform_manager_table::get('rex_yrewrite_metainfo');
        if (!is_object($table)) {
            return '';
        }
        $_csrf_key = $table->getCSRFKey();
        $token = rex_csrf_token::factory($_csrf_key)->getUrlParams();

        $domain = Domain::query()
            ->where('yrewrite_domain_id', $a['list']->getValue('id'))
            ->findOne();

        $params = [];
        $params['table_name'] = 'rex_yrewrite_metainfo';
        $params['rex_yform_manager_popup'] = '0';
        $params['_csrf_token'] = $token['_csrf_token'];

        if (null !== $domain) {
            $params['data_id'] = $domain->getId();
            $params['func'] = 'edit';
            return '<a href="' . rex_url::backendPage('yrewrite/metainfo/domain', $params) . '">' . rex_i18n::msg('yrewrite_metainfo_edit') . '</a>';
        }

        // Link zur neuen YRewrite-Metainfo-Domain erstellen
        $params['func'] = 'add';
        return '<a href="' . rex_url::backendPage('yrewrite/metainfo/domain', $params) . '">' . rex_i18n::msg('yrewrite_metainfo_add') . '</a>';
    });
    return $list;
});
