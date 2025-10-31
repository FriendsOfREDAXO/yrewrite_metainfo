<?php

/**
 * YRewrite Metainfo Media Preview Field
 * Modernes Media-Feld mit Vorschau und Modal-Vergrößerung.
 *
 * @package yrewrite_metainfo
 * @author Friends of REDAXO
 */
class rex_yform_value_yrewrite_metainfo_be_media_preview extends rex_yform_value_be_media
{
    public function enterObject()
    {
        // Basis-Funktionalität von be_media nutzen
        parent::enterObject();

        // Eigene Template-Logik für Preview
        if ($this->needsOutput() && $this->isViewable()) {
            if (!$this->isEditable()) {
                $this->params['form_output'][$this->getId()] = $this->parse(
                    'value.yrewrite_metainfo_be_media_preview-view.tpl.php',
                    ['value' => explode(',', $this->getValue()), 'types' => $this->getElement('types') ?? ''],
                );
            } else {
                $types = $this->getElement('types') ?? '';
                if ('*' == $types) {
                    $types = '';
                }

                // Eigenes Template mit Preview und Modal
                $this->params['form_output'][$this->getId()] = $this->parse(
                    'value.yrewrite_metainfo_be_media_preview.tpl.php',
                    compact('types'),
                );
            }
        }
    }

    /**
     * Prefixing-Unterstützung für Feldnamen-Konsistenz
     */
    public function getFieldName($name = '')
    {
        if ('' === $name) {
            $name = $this->getName();
        }
        
        $prefix = $this->getElement('prefix') ?? '';
        if ($prefix) {
            $name = $prefix . '_' . $name;
        }
        
        return parent::getFieldName($name);
    }

    public function getDefinitions(): array
    {
        return [
            'type' => 'value',
            'name' => 'yrewrite_metainfo_be_media_preview',
            'values' => [
                'name' => ['type' => 'name', 'label' => rex_i18n::msg('yform_values_defaults_name')],
                'label' => ['type' => 'text', 'label' => rex_i18n::msg('yform_values_defaults_label')],
                'multiple' => ['type' => 'checkbox', 'label' => rex_i18n::msg('yform_values_be_media_multiple')],
                'category' => ['type' => 'text', 'label' => rex_i18n::msg('yform_values_be_media_category')],
                'types' => ['type' => 'text', 'label' => rex_i18n::msg('yform_values_be_media_types'), 'notice' => rex_i18n::msg('yform_values_be_media_types_notice')],
                'prefix' => ['type' => 'text', 'label' => 'Prefix für Feldnamen', 'notice' => 'Optional: Präfix für konsistente Feldnamen (z.B. "meta" für "meta_image")'],
                'notice' => ['type' => 'text', 'label' => rex_i18n::msg('yform_values_defaults_notice')],
            ],
            'description' => 'Media field with modern preview and modal enlargement',
            'formbuilder' => false,
            'db_type' => ['text', 'varchar(191)'],
        ];
    }

    public static function getListValue($params)
    {
        $files = explode(',', $params['subject']);

        $return = [];
        foreach ($files as $file) {
            if ($file) {
                $media = rex_media::get($file);
                if (!$media) {
                    continue;
                }
                if ($media->isImage()) {
                    // Prüfe ob es ein SVG ist - dann direkten Zugriff verwenden
                    $isSvg = 'svg' === strtolower($media->getExtension());
                    $imageUrl = $isSvg ? rex_url::media($file) : rex_media_manager::getUrl('rex_media_small', $file);

                    // Thumbnail mit Modal-Link und CSS-Klassen
                    $return[] = '<img src="' . $imageUrl . '" 
                                     class="yrewrite-metainfo-preview-img" 
                                     style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px; cursor: pointer; transition: all 0.3s ease; border: 2px solid #ddd;" 
                                     onclick="yrewriteMetainfoMediaPreview(\'' . rex_escape($file) . '\')" 
                                     title="' . rex_i18n::msg('yrewrite_metainfo_click_to_enlarge') . ' - ' . rex_escape($file) . '">';
                } else {
                    // Dateiname für nicht-Bilder mit Icon
                    $return[] = '<div style="display: flex; align-items: center; gap: 5px;">
                                    <span class="rex-icon rex-icon-file-o" style="color: #6c757d;"></span>
                                    <span style="font-size: 11px;">' . rex_escape($file) . '</span>
                                 </div>';
                }
            }
        }

        return implode('<div style="margin: 2px 0;"></div>', $return);
    }
}
