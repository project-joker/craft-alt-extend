<p align="center">
  <img src="https://raw.githubusercontent.com/project-joker/craft-alt-extend/main/banner.svg" alt="Alt Extend for Craft CMS" width="100%">
</p>

# Alt Extend

A Craft CMS 5 plugin that automatically extends image alt attributes with a configurable text — as suffix or prefix — keeping your SEO and accessibility consistent across the entire site.

## Why?

Many websites need a recurring brand name or location appended to every image alt text. Doing this manually across hundreds of images is tedious and error-prone. Alt Extend handles it globally through a single Twig filter while still allowing you to opt out on individual assets.

## Requirements

- Craft CMS 5.3.0+
- PHP 8.2+

## Installation

```bash
composer require projectjoker/craft-alt-extend
php craft plugin/install alt-extend
```

Or install through the Craft Control Panel under **Settings > Plugins**.

## Configuration

Open **Settings > Plugins > Alt Extend** in the Control Panel:

| Setting | Default | Description |
|---|---|---|
| **Text** | — | The text to append or prepend (e.g. `My Company in Berlin`) |
| **Position** | Suffix | Whether the text is added after or before the existing alt text |
| **Separator** | ` \| ` | Characters placed between the original alt text and your text |

### Example output

With the text set to `My Company` and the default separator:

| Input | Output |
|---|---|
| `A sunny beach` | `A sunny beach \| My Company` |
| *(empty)* | `My Company` |

## Usage

Pass an asset directly to the `alt` filter. The filter reads the native alt text from the asset:

```twig
<img src="{{ image.url }}" alt="{{ image | alt }}">
```

Plain strings work as well:

```twig
<img src="{{ image.url }}" alt="{{ 'Product photo' | alt }}">
```

### Per-asset opt-out

During installation the plugin creates a Lightswitch field called **Disable Alt Extend** (handle: `altExtendDisabled`). Add this field to your asset volume's field layout to gain per-image control.

When the switch is enabled on an asset, the `alt` filter returns the original alt text without any additions.

## Roadmap

- Multi-site / multi-language support
- Configurable field handle for the opt-out switch

## License

This plugin is licensed under the [MIT License](LICENSE.md).

---

Built by [Project Joker](https://project-joker.com)
