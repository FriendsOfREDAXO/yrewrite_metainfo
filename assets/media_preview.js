/**
 * YRewrite Metainfo Media Preview JavaScript
 * Global functions for media preview functionality
 */

jQuery(function($) {
    // Lazy Loading Implementation
    function initLazyLoading() {
        const lazyImages = document.querySelectorAll('.rex-media-lazy');
        
        // Intersection Observer für moderne Browser
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        const src = img.getAttribute('data-lazy-src');
                        if (src) {
                            img.src = src;
                            img.classList.add('loaded');
                            img.removeAttribute('data-lazy-src');
                        }
                        observer.unobserve(img);
                    }
                });
            }, {
                rootMargin: '50px 0px',
                threshold: 0.01
            });
            
            lazyImages.forEach(function(img) {
                imageObserver.observe(img);
            });
        } else {
            // Fallback für ältere Browser
            lazyImages.forEach(function(img) {
                const src = img.getAttribute('data-lazy-src');
                if (src) {
                    img.src = src;
                    img.classList.add('loaded');
                    img.removeAttribute('data-lazy-src');
                }
            });
        }
    }

    // Global media preview function for list views
    window.yrewriteMetainfoMediaPreview = function(filename) {
        if (!filename) return;
        
        // Sicherheitsvalidierung: Path Traversal verhindern
        filename = filename.replace(/[\/\\]/g, '');
        if (filename.includes('..')) {
            console.error('Invalid filename:', filename);
            return;
        }
        
        // Check if modal already exists
        let modal = $('#yrewrite-metainfo-global-modal');
        if (modal.length === 0) {
            // Create modal dynamically
            const modalHtml = `
                <div class="modal fade" id="yrewrite-metainfo-global-modal" tabindex="-1" role="dialog" style="z-index: 1060;">
                    <div class="modal-dialog modal-lg" role="document" style="margin: 30px auto;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title" id="yrewrite-metainfo-global-title">Media Preview</h4>
                            </div>
                            <div class="modal-body text-center" style="padding: 20px;">
                                <img id="yrewrite-metainfo-global-image" src="" alt="" 
                                     style="max-width: 100%; max-height: 70vh; height: auto; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                            </div>
                        </div>
                    </div>
                </div>
            `;
            $('body').append(modalHtml);
            modal = $('#yrewrite-metainfo-global-modal');
        }
        
        // Robuste URL-Konstruktion für Media-Dateien
        let imageUrl;
        try {
            // Methode 1: Verwende aktuelle URL als Basis
            const currentUrl = new URL(window.location.href);
            const pathParts = currentUrl.pathname.split('/');
            
            // Finde 'redaxo' im Pfad
            const redaxoIndex = pathParts.findIndex(part => part === 'redaxo');
            if (redaxoIndex !== -1) {
                // Konstruiere Pfad bis vor 'redaxo'
                const baseParts = pathParts.slice(0, redaxoIndex);
                imageUrl = currentUrl.origin + baseParts.join('/') + '/media/' + filename;
            } else {
                // Fallback: relative Pfad
                imageUrl = '../media/' + filename;
            }
        } catch (e) {
            // Fallback falls URL-Konstruktion fehlschlägt
            imageUrl = '../media/' + filename;
        }
        
        console.log('Media URL for', filename + ':', imageUrl); // Debug-Ausgabe
        modal.find('#yrewrite-metainfo-global-image').attr('src', imageUrl);
        modal.find('#yrewrite-metainfo-global-title').text(filename);
        modal.modal('show');
    };
    
    // Enhanced hover effects for preview images
    $(document).on('mouseenter', '.yrewrite-metainfo-preview-img', function() {
        $(this).css({
            'transform': 'scale(1.1)',
            'box-shadow': '0 8px 25px rgba(0,0,0,0.2)',
            'border-color': '#337ab7'
        });
    });
    
    $(document).on('mouseleave', '.yrewrite-metainfo-preview-img', function() {
        $(this).css({
            'transform': 'scale(1)',
            'box-shadow': '0 2px 8px rgba(0,0,0,0.1)',
            'border-color': '#ddd'
        });
    });
    
    // Initialize lazy loading
    function initAll() {
        initLazyLoading();
    }
    
    $(document).ready(function() {
        initAll();
        
        // Re-initialize after DOM changes using MutationObserver
        if (window.MutationObserver) {
            const observer = new MutationObserver(function(mutations) {
                let shouldReinit = false;
                mutations.forEach(function(mutation) {
                    if (mutation.addedNodes.length > 0) {
                        mutation.addedNodes.forEach(function(node) {
                            if (node.nodeType === 1 && 
                                (node.matches && node.matches('.rex-form-group') || 
                                 node.querySelector && node.querySelector('.rex-form-group'))) {
                                shouldReinit = true;
                            }
                        });
                    }
                });
                if (shouldReinit) {
                    setTimeout(initLazyLoading, 50);
                }
            });
            
            observer.observe(document.body, {
                childList: true,
                subtree: true
            });
        }
    });
});