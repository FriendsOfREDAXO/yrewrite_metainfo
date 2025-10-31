<?php
/**
 * @var rex_yform_value_be_media_preview $this
 * @psalm-scope-this rex_yform_value_be_media_preview
 */

$counter ??= 1000;

$buttonId = $counter;
$name = $this->getFieldName();
$value = rex_escape($this->getValue());
$types ??= $this->getElement('types');

$widget_params = [];
$widget_params['category'] = 0;
if ('' != $this->getElement('category')) {
    $widget_params['category'] = (int) $this->getElement('category');
}
$widget_params['preview'] = 1; // Immer Preview aktivieren
if ('' != $types) {
    $widget_params['types'] = trim($types);
}

// Widget erstellen
if (1 == $this->getElement('multiple')) {
    $widget = rex_var_medialist::getWidget($buttonId, $name, $value, $widget_params);
} else {
    $widget = rex_var_media::getWidget($buttonId, $name, $value, $widget_params);
}

$class_group = trim('form-group ' . $this->getHTMLClass() . ' ' . $this->getWarningClass());

$notice = [];
if ('' != $this->getElement('notice')) {
    $notice[] = rex_i18n::translate($this->getElement('notice'), false);
}
if (isset($this->params['warning_messages'][$this->getId()]) && !$this->params['hide_field_warning_messages']) {
    $notice[] = '<span class="text-warning">' . rex_i18n::translate($this->params['warning_messages'][$this->getId()], false) . '</span>';
}
if (count($notice) > 0) {
    $notice = '<p class="help-block small">' . implode('<br />', $notice) . '</p>';
} else {
    $notice = '';
}

// Media-Dateien für Preview holen
$mediaFiles = [];
if ($value) {
    $files = explode(',', $value);
    foreach ($files as $file) {
        if ($file && rex_media::get($file)) {
            $mediaFiles[] = $file;
        }
    }
}

?>
<div data-be-media-wrapper="<?= $this->getFieldName() ?>" class="<?= $class_group ?>" id="<?= $this->getHTMLId() ?>">
    <label class="control-label" for="<?= $this->getFieldId() ?>"><?= $this->getLabel() ?></label>
    <?= $widget ?>
    
    <?php if (!empty($mediaFiles)): ?>
    <div class="rex-media-preview-container" style="margin-top: 10px;">
        <?php foreach ($mediaFiles as $file): 
            $media = rex_media::get($file);
            if ($media && $media->isImage()): ?>
        <div class="rex-media-preview-item" style="display: inline-block; margin: 5px;">
            <img src="<?= rex_media_manager::getUrl('rex_media_small', $file) ?>" 
                 class="rex-js-media-preview-click" 
                 data-filename="<?= rex_escape($file) ?>"
                 style="width: 80px; height: 80px; object-fit: cover; border: 2px solid #ddd; border-radius: 8px; cursor: pointer; transition: all 0.3s ease;"
                 onmouseover="this.style.borderColor='#337ab7'; this.style.transform='scale(1.05)'"
                 onmouseout="this.style.borderColor='#ddd'; this.style.transform='scale(1)'"
                 title="<?= rex_i18n::msg('yrewrite_metainfo_click_to_enlarge') ?> - <?= rex_escape($file) ?>">
        </div>
        <?php endif; endforeach; ?>
    </div>
    <?php endif; ?>
    
    <?= $notice ?>
</div>

<!-- Modal für Bildvergrößerung (nur einmal pro Seite) -->
<div class="modal fade" id="rex-media-preview-modal-<?= $buttonId ?>" tabindex="-1" role="dialog" style="z-index: 1060;">
    <div class="modal-dialog modal-lg" role="document" style="margin: 30px auto;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="<?= rex_i18n::msg('close') ?>">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="rex-media-preview-title-<?= $buttonId ?>">Media Preview</h4>
            </div>
            <div class="modal-body text-center" style="padding: 20px;">
                <img id="rex-media-preview-image-<?= $buttonId ?>" src="" alt="" 
                     style="max-width: 100%; max-height: 70vh; height: auto; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                <div id="rex-media-preview-info-<?= $buttonId ?>" style="margin-top: 15px; color: #666;"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
jQuery(function($) {
    // Media Preview Modal für dieses Feld
    $(document).on('click', '[data-be-media-wrapper="<?= $this->getFieldName() ?>"] .rex-js-media-preview-click', function(e) {
        e.preventDefault();
        var filename = $(this).data('filename');
        if (!filename) return;
        
        var modalId = '#rex-media-preview-modal-<?= $buttonId ?>';
        var imageUrl = '<?= rex_url::media('') ?>' + filename;
        
        $(modalId + ' #rex-media-preview-image-<?= $buttonId ?>').attr('src', imageUrl);
        $(modalId + ' #rex-media-preview-title-<?= $buttonId ?>').text(filename);
        
        // Media-Informationen laden
        var media = <?= json_encode(array_map(function($file) {
            $m = rex_media::get($file);
            return $m ? [
                'filename' => $m->getFileName(),
                'title' => $m->getTitle(),
                'filesize' => $m->getFormattedSize(),
                'dimensions' => $m->isImage() ? $m->getWidth() . ' × ' . $m->getHeight() . ' px' : null
            ] : null;
        }, $mediaFiles)) ?>;
        
        var mediaInfo = media.find(function(m) { return m && m.filename === filename; });
        var infoHtml = '';
        if (mediaInfo) {
            infoHtml = '<strong>' + mediaInfo.filename + '</strong>';
            if (mediaInfo.title) infoHtml += '<br>Titel: ' + mediaInfo.title;
            if (mediaInfo.dimensions) infoHtml += '<br>Größe: ' + mediaInfo.dimensions;
            infoHtml += '<br>Dateigröße: ' + mediaInfo.filesize;
        }
        
        $(modalId + ' #rex-media-preview-info-<?= $buttonId ?>').html(infoHtml);
        $(modalId).modal('show');
    });
});
</script>