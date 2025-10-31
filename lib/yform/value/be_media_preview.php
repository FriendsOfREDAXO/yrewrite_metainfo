<?php

/**
 * YRewrite Metainfo Media Preview Field
 * Modernes Media-Feld mit Vorschau und Modal-Vergrößerung
 *
 * @package yrewrite_metainfo
 * @author Friends of REDAXO
 */
class rex_yform_value_be_media_preview extends rex_yform_value_be_media
{
    public function enterObject()
    {
        // Basis-Funktionalität von be_media nutzen
        parent::enterObject();

        // Eigene Template-Logik für Preview
        if ($this->needsOutput() && $this->isViewable()) {
            if (!$this->isEditable()) {
                $this->params['form_output'][$this->getId()] = $this->parse(
                    'value.be_media_preview-view.tpl.php',
                    ['value' => explode(',', $this->getValue()), 'types' => $this->getElement('types') ?? '']
                );
            } else {
                $types = $this->getElement('types') ?? '';
                if ('*' == $types) {
                    $types = '';
                }
                
                // Eigenes Template mit Preview und Modal
                $this->params['form_output'][$this->getId()] = $this->parse(
                    'value.be_media_preview.tpl.php', 
                    compact('types')
                );
            }
        }
    }

    public function getDefinitions(): array
    {
        return [
            'type' => 'value',
            'name' => 'be_media_preview',
            'values' => [
                'name' => ['type' => 'name', 'label' => rex_i18n::msg('yform_values_defaults_name')],
                'label' => ['type' => 'text', 'label' => rex_i18n::msg('yform_values_defaults_label')],
                'multiple' => ['type' => 'checkbox', 'label' => rex_i18n::msg('yform_values_be_media_multiple')],
                'category' => ['type' => 'text', 'label' => rex_i18n::msg('yform_values_be_media_category')],
                'types' => ['type' => 'text', 'label' => rex_i18n::msg('yform_values_be_media_types'), 'notice' => rex_i18n::msg('yform_values_be_media_types_notice')],
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
            if ($file && rex_media::get($file)) {
                $media = rex_media::get($file);
                if ($media && $media->isImage()) {
                    // Thumbnail mit Modal-Link
                    $return[] = '<img src="' . rex_media_manager::getUrl('rex_media_small', $file) . '" 
                                     style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px; cursor: pointer;" 
                                     onclick="openMediaModal(\'' . rex_escape($file) . '\')" 
                                     title="' . rex_escape($file) . '">';
                } else {
                    // Dateiname für nicht-Bilder
                    $return[] = '<span class="rex-icon rex-icon-file-o"></span> ' . rex_escape($file);
                }
            }
        }
        
        return implode('<br>', $return);
    }
}