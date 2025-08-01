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

    /** PNG Favicon 96x96 */
    /** @api */
    public function getFaviconPng96(bool $asMedia = false): string|rex_media|null
    {
        if ($asMedia) {
            return rex_media::get($this->getValue('favicon_png_96'));
        }
        return $this->getValue('favicon_png_96');
    }

    /** @api */
    public function getFaviconPng96Url(): string
    {
        return rex_url::media() . $this->getValue('favicon_png_96');
    }

    /** @api */
    public function setFaviconPng96(string $filename): self
    {
        if (null !== rex_media::get($filename)) {
            $this->setValue('favicon_png_96', $filename);
        }
        return $this;
    }

    /** SVG Favicon */
    /** @api */
    public function getFaviconSvg(bool $asMedia = false): string|rex_media|null
    {
        if ($asMedia) {
            return rex_media::get($this->getValue('favicon_svg'));
        }
        return $this->getValue('favicon_svg');
    }

    /** @api */
    public function getFaviconSvgUrl(): string
    {
        return rex_url::media() . $this->getValue('favicon_svg');
    }

    /** @api */
    public function setFaviconSvg(string $filename): self
    {
        if (null !== rex_media::get($filename)) {
            $this->setValue('favicon_svg', $filename);
        }
        return $this;
    }
}
