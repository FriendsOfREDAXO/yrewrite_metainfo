# Die Klasse `Icon`

Kind-Klasse von `rex_yform_manager_dataset`, damit stehen alle Methoden von YOrm-Datasets zur Verfügung. Greift auf die Tabelle `yrewrite_metainfo_icon` zu.

> Es werden nachfolgend zur die durch dieses Addon ergänzte Methoden beschrieben. Lerne mehr über YOrm und den Methoden für Querys, Datasets und Collections in der [YOrm Doku](https://github.com/yakamara/yform/blob/master/docs/04_yorm.md)

## Alle Einträge erhalten

```php
$domain = Domain::getCurrent();
$icon = $domain->getIcon();
echo $icon->getIcon16();
echo $icon->getIcon16Url();
echo $icon->getIcon32();
echo $icon->getIcon32Url();
echo $icon->getManifest();
// usw.
```

## Methoden und Beispiele

### `getName()`

Gibt den Wert für das Feld `name` (Profilname) zurück: Name des Profils (wird nur für die Anzeige unter "Allgemein" verwendet)

Beispiel:

```php
$dataset = yrewrite_metainfo_icon::get($id);
echo $dataset->getName();
```

### `setName(mixed $value)`

Setzt den Wert für das Feld `name` (Profilname).

```php
$dataset = yrewrite_metainfo_icon::create();
$dataset->setName($value);
$dataset->save();
```

### `getShortName()`

Gibt den Wert für das Feld `short_name` (PWA Kurzname (App-Verknüpfung)) zurück: Wird verwendet, wenn die Website als PWA-Verknüpfung auf dem Home-Screen oder Startmenü dargestellt wird.

Beispiel:

```php
$dataset = yrewrite_metainfo_icon::get($id);
echo $dataset->getShortName();
```

### `setShortName(mixed $value)`

Setzt den Wert für das Feld `short_name` (PWA Kurzname (App-Verknüpfung)).

```php
$dataset = yrewrite_metainfo_icon::create();
$dataset->setShortName($value);
$dataset->save();
```

### `getDisplay()`

Gibt den Wert für das Feld `display` (PWA Browser-UI) zurück: Gibt an, wie viel Browser-UI innerhalb der PWA noch sichtbar ist, z.B. Reload-Button

Beispiel:

```php
$dataset = yrewrite_metainfo_icon::get($id);
echo $dataset->getDisplay();
```

### `setDisplay(mixed $value)`

Setzt den Wert für das Feld `display` (PWA Browser-UI).

```php
$dataset = yrewrite_metainfo_icon::create();
$dataset->setDisplay($value);
$dataset->save();
```

### `getThemeColor()`

Gibt den Wert für das Feld `theme_color` (PWA Theme-Farbe) zurück: `<meta name="theme-color">`

Beispiel:

```php
$dataset = yrewrite_metainfo_icon::get($id);
echo $dataset->getThemeColor();
```

### `setThemeColor(mixed $value)`

Setzt den Wert für das Feld `theme_color` (PWA Theme-Farbe).

```php
$dataset = yrewrite_metainfo_icon::create();
$dataset->setThemeColor($value);
$dataset->save();
```

### `getYrewriteMetainfoThemeColor()`

Gibt den Wert für das Feld `yrewrite_metainfo_theme_color` (PWA Theme-Farbe) zurück: `<meta name="theme-color">`

Beispiel:

```php
$dataset = yrewrite_metainfo_icon::get($id);
echo $dataset->getYrewriteMetainfoThemeColor();
```

### `setYrewriteMetainfoThemeColor(mixed $value)`

Setzt den Wert für das Feld `yrewrite_metainfo_theme_color` (PWA Theme-Farbe).

```php
$dataset = yrewrite_metainfo_icon::create();
$dataset->setYrewriteMetainfoThemeColor($value);
$dataset->save();
```

### `getBackgroundColor()`

Gibt den Wert für das Feld `background_color` (PWA Hintergrund-Farbe) zurück: Hintergrundfarbe, z.B. beim Starten der PWA

Beispiel:

```php
$dataset = yrewrite_metainfo_icon::get($id);
echo $dataset->getBackgroundColor();
```

### `setBackgroundColor(mixed $value)`

Setzt den Wert für das Feld `background_color` (PWA Hintergrund-Farbe).

```php
$dataset = yrewrite_metainfo_icon::create();
$dataset->setBackgroundColor($value);
$dataset->save();
```

### `getMsapplicationTitleColor()`

Gibt den Wert für das Feld `msapplication_title_color` (PWA Titelleisten-Farbe) zurück: (nur Microsoft Windows), `&lt;meta name="msapplication-TileColor"&gt;`

Beispiel:

```php
$dataset = yrewrite_metainfo_icon::get($id);
echo $dataset->getMsapplicationTitleColor();
```

### `setMsapplicationTitleColor(mixed $value)`

Setzt den Wert für das Feld `msapplication_title_color` (PWA Titelleisten-Farbe).

```php
$dataset = yrewrite_metainfo_icon::create();
$dataset->setMsapplicationTitleColor($value);
$dataset->save();
```

### `getShortcutIcon(bool $asMedia = false)`

Gibt den Wert für das Feld `shortcut_icon` (Favicon) zurück: `favicon.ico`

Beispiel:

```php
$dataset = yrewrite_metainfo_icon::get($id);
$media = $dataset->getShortcutIcon(true);
```

### `setShortcutIcon(string $filename)`

Setzt den Wert für das Feld `shortcut_icon` (Favicon).

```php
$dataset = yrewrite_metainfo_icon::create();
$dataset->setShortcutIcon($filename);
$dataset->save();
```

### `getIcon16(bool $asMedia = false)`

Gibt den Wert für das Feld `icon_16` (16x16) zurück: 16×16px

Beispiel:

```php
$dataset = yrewrite_metainfo_icon::get($id);
$media = $dataset->getIcon16(true);
```

### `setIcon16(string $filename)`

Setzt den Wert für das Feld `icon_16` (16x16).

```php
$dataset = yrewrite_metainfo_icon::create();
$dataset->setIcon16($filename);
$dataset->save();
```

### `getIcon32(bool $asMedia = false)`

Gibt den Wert für das Feld `icon_32` (32x32) zurück: 32×32px

Beispiel:

```php
$dataset = yrewrite_metainfo_icon::get($id);
$media = $dataset->getIcon32(true);
```

### `setIcon32(string $filename)`

Setzt den Wert für das Feld `icon_32` (32x32).

```php
$dataset = yrewrite_metainfo_icon::create();
$dataset->setIcon32($filename);
$dataset->save();
```

### `getAppleTouchIcon(bool $asMedia = false)`

Gibt den Wert für das Feld `apple_touch_icon` (Apple Touch) zurück: 180×180px

Beispiel:

```php
$dataset = yrewrite_metainfo_icon::get($id);
$media = $dataset->getAppleTouchIcon(true);
```

### `setAppleTouchIcon(string $filename)`

Setzt den Wert für das Feld `apple_touch_icon` (Apple Touch).

```php
$dataset = yrewrite_metainfo_icon::create();
$dataset->setAppleTouchIcon($filename);
$dataset->save();
```

### `getSafariPinnedTab(bool $asMedia = false)`

Gibt den Wert für das Feld `safari_pinned_tab` (Safari Pinned Tab) zurück: `safari-pinned-tab.svg`

Beispiel:

```php
$dataset = yrewrite_metainfo_icon::get($id);
$media = $dataset->getSafariPinnedTab(true);
```

### `setSafariPinnedTab(string $filename)`

Setzt den Wert für das Feld `safari_pinned_tab` (Safari Pinned Tab).

```php
$dataset = yrewrite_metainfo_icon::create();
$dataset->setSafariPinnedTab($filename);
$dataset->save();
```

### `getManifest(bool $asMedia = false)`

Gibt den Wert für das Feld `manifest` (webmanifest.json) zurück: `site.webmanifest`

Beispiel:

```php
$dataset = yrewrite_metainfo_icon::get($id);
$media = $dataset->getManifest(true);
```

### `setManifest(string $filename)`

Setzt den Wert für das Feld `manifest` (webmanifest.json).

```php
$dataset = yrewrite_metainfo_icon::create();
$dataset->setManifest($filename);
$dataset->save();
```
