<?php

namespace FriendsOfRedaxo\YrewriteMetainfo;

use rex_media;
use rex_url;
use rex_yform_manager_dataset;

class Icon extends rex_yform_manager_dataset
{
    /* Profilname */
    /** @api */
    public function getName(): ?string
    {
        return $this->getValue('name');
    }

    /** @api */
    public function setName(mixed $value): self
    {
        $this->setValue('name', $value);
        return $this;
    }

    /* PWA Kurzname (App-Verknüpfung) */
    /** @api */
    public function getShortName(): ?string
    {
        return $this->getValue('short_name');
    }

    /** @api */
    public function setShortName(mixed $value): self
    {
        $this->setValue('short_name', $value);
        return $this;
    }

    /* PWA Browser-UI */
    /** @api */
    public function getDisplay(): ?string
    {
        return $this->getValue('display');
    }

    /** @api */
    public function setDisplay(mixed $value): self
    {
        $this->setValue('display', $value);
        return $this;
    }

    /* PWA Theme-Farbe */
    /** @api */
    public function getThemeColor(): ?string
    {
        return $this->getValue('theme_color');
    }

    /** @api */
    public function setThemeColor(mixed $value): self
    {
        $this->setValue('theme_color', $value);
        return $this;
    }

    /* PWA Hintergrund-Farbe */
    /** @api */
    public function getBackgroundColor(): ?string
    {
        return $this->getValue('background_color');
    }

    /** @api */
    public function setBackgroundColor(mixed $value): self
    {
        $this->setValue('background_color', $value);
        return $this;
    }

    /* [translate:msapplication_title_color] */
    /** @api @deprecated ab 2025-08-02: Nicht mehr aus ZIP/Manifest befüllbar. */
    public function getMsapplicationTitleColor(): ?string
    {
        return $this->getValue('msapplication_title_color');
    }

    /** @api @deprecated ab 2025-08-02: Nicht mehr aus ZIP/Manifest befüllbar. */
    public function setMsapplicationTitleColor(mixed $value): self
    {
        $this->setValue('msapplication_title_color', $value);
        return $this;
    }

    /* Favicon */
    /** @api */
    public function getShortcutIcon(bool $asMedia = false): string|rex_media|null
    {
        if ($asMedia) {
            return rex_media::get($this->getValue('shortcut_icon'));
        }
        return $this->getValue('shortcut_icon');
    }

    /** @api */
    public function getShortcutIconUrl(): string
    {
        return rex_url::media() . $this->getValue('shortcut_icon');
    }

    /** @api */
    public function setShortcutIcon(string $filename): self
    {
        if (null !== rex_media::get($filename)) {
            $this->setValue('shortcut_icon', $filename);
        }
        return $this;
    }

    /* 16x16 */
    /** @api @deprecated ab 2025-08-02: Nicht mehr aus ZIP/Manifest befüllbar. */
    public function getIcon16(bool $asMedia = false): string|rex_media|null
    {
        if ($asMedia) {
            return rex_media::get($this->getValue('icon_16'));
        }
        return $this->getValue('icon_16');
    }

    /** @api @deprecated ab 2025-08-02: Nicht mehr aus ZIP/Manifest befüllbar. */
    public function getIcon16Url(): string
    {
        return rex_url::media() . $this->getValue('icon_16');
    }

    /** @api @deprecated ab 2025-08-02: Nicht mehr aus ZIP/Manifest befüllbar. */
    public function setIcon16(string $filename): self
    {
        if (null !== rex_media::get($filename)) {
            $this->setValue('icon_16', $filename);
        }
        return $this;
    }

    /* 32x32 */
    /** @api @deprecated ab 2025-08-02: Nicht mehr aus ZIP/Manifest befüllbar. */
    public function getIcon32(bool $asMedia = false): string|rex_media|null
    {
        if ($asMedia) {
            return rex_media::get($this->getValue('icon_32'));
        }
        return $this->getValue('icon_32');
    }

    /** @api @deprecated ab 2025-08-02: Nicht mehr aus ZIP/Manifest befüllbar. */
    public function getIcon32Url(): string
    {
        return rex_url::media() . $this->getValue('icon_32');
    }

    /** @api @deprecated ab 2025-08-02: Nicht mehr aus ZIP/Manifest befüllbar. */
    public function setIcon32(string $filename): self
    {
        if (null !== rex_media::get($filename)) {
            $this->setValue('icon_32', $filename);
        }
        return $this;
    }

    /* Apple Touch */
    /** @api */
    public function getAppleTouchIcon(bool $asMedia = false): string|rex_media|null
    {
        if ($asMedia) {
            return rex_media::get($this->getValue('apple_touch_icon'));
        }
        return $this->getValue('apple_touch_icon');
    }

    /** @api */
    public function getAppleTouchIconUrl(): string
    {
        return rex_url::media() . $this->getValue('apple_touch_icon');
    }

    /** @api */
    public function setAppleTouchIcon(string $filename): self
    {
        if (null !== rex_media::get($filename)) {
            $this->setValue('apple_touch_icon', $filename);
        }
        return $this;
    }

    /* Safari Pinned Tab */
    /** @api @deprecated ab 2025-08-02: Nicht mehr aus ZIP/Manifest befüllbar. */
    public function getSafariPinnedTab(bool $asMedia = false): string|rex_media|null
    {
        if ($asMedia) {
            return rex_media::get($this->getValue('safari_pinned_tab'));
        }
        return $this->getValue('safari_pinned_tab');
    }

    /** @api @deprecated ab 2025-08-02: Nicht mehr aus ZIP/Manifest befüllbar. */
    public function getSafariPinnedTabUrl(): string
    {
        return rex_url::media() . $this->getValue('safari_pinned_tab');
    }

    /** @api @deprecated ab 2025-08-02: Nicht mehr aus ZIP/Manifest befüllbar. */
    public function setSafariPinnedTab(string $filename): self
    {
        if (null !== rex_media::get($filename)) {
            $this->setValue('safari_pinned_tab', $filename);
        }
        return $this;
    }

    /* webmanifest.json */
    /** @api */
    public function getManifest(bool $asMedia = false): mixed
    {
        if ($asMedia) {
            return rex_media::get($this->getValue('manifest'));
        }
        return $this->getValue('manifest');
    }

    /** @api */
    public function getManifestUrl(): string
    {
        return rex_url::media() . $this->getValue('manifest');
    }

    /** @api */
    public function setManifest(string $filename): self
    {
        if (null !== rex_media::get($filename)) {
            $this->setValue('manifest', $filename);
        }
        return $this;
    }
}
