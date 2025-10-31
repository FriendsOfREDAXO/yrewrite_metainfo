<?php
/**
 * @var rex_yform_value_yrewrite_metainfo_be_media_preview $this
 * @psalm-scope-this rex_yform_value_yrewrite_metainfo_be_media_preview
 */

$value = $this->getValue();
$files = [];
if ($value) {
    $files = explode(',', $value);
}

if (empty($files) || (1 == count($files) && empty($files[0]))): ?>
    <p class="form-control-static">-</p>
<?php else: ?>
    <div class="rex-media-preview-view">
        <?php foreach ($files as $file):
            if (!$file) {
            continue;
            }
            $media = rex_media::get($file);
            if (!$media) {
            continue;
            }

            if ($media->isImage()):
                // Prüfe ob es ein SVG ist - dann direkten Zugriff verwenden
                $isSvg = 'svg' === strtolower($media->getExtension());
                $viewUrl = $isSvg ? rex_url::media($file) : rex_media_manager::getUrl('rex_media_small', $file);
            ?>
                <div class="rex-media-item" style="display: inline-block; margin: 5px 10px 5px 0;">
                    <img src="<?= $viewUrl ?>" 
                         class="rex-js-media-preview-view" 
                         data-filename="<?= rex_escape($file) ?>"
                         style="width: 60px; height: 60px; object-fit: <?= $isSvg ? 'contain' : 'cover' ?>; border: 1px solid #ddd; border-radius: 4px; cursor: pointer; <?= $isSvg ? 'background: #f8f9fa; padding: 4px;' : '' ?>"
                         title="<?= rex_escape($file) ?> <?= $isSvg ? '(SVG)' : '' ?>">
                    <div style="font-size: 11px; max-width: 60px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                        <?= rex_escape($file) ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="rex-media-item" style="display: inline-block; margin: 5px 10px 5px 0;">
                    <div style="width: 60px; height: 60px; border: 1px solid #ddd; border-radius: 4px; display: flex; align-items: center; justify-content: center; background: #f8f9fa;">
                        <i class="rex-icon rex-icon-file-o" style="font-size: 24px; color: #6c757d;"></i>
                    </div>
                    <div style="font-size: 11px; max-width: 60px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                        <?= rex_escape($file) ?>
                    </div>
                </div>
            <?php endif;
        endforeach ?>
    </div>
    
    <!-- Modal für View-Modus -->
    <div class="modal fade" id="rex-media-view-modal" tabindex="-1" role="dialog" style="z-index: 1060;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="<?= rex_i18n::msg('close') ?>">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="rex-media-view-title">Media Preview</h4>
                </div>
                <div class="modal-body text-center">
                    <img id="rex-media-view-image" src="" alt="" style="max-width: 100%; max-height: 70vh; height: auto;">
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
    jQuery(function($) {
        $('.rex-js-media-preview-view').click(function(e) {
            e.preventDefault();
            var filename = $(this).data('filename');
            if (!filename) return;
            
            var imageUrl = '<?= rex_url::media('') ?>' + filename;
            $('#rex-media-view-image').attr('src', imageUrl);
            $('#rex-media-view-title').text(filename);
            $('#rex-media-view-modal').modal('show');
        });
    });
    </script>
<?php endif ?>