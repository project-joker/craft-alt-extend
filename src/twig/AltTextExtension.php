<?php

namespace projectjoker\altextend\twig;

use craft\elements\Asset;
use projectjoker\altextend\Plugin;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Provides the `| alt` Twig filter.
 *
 * Accepts an Asset element or a plain string and extends the alt text
 * with the globally configured text (as suffix or prefix).
 */
class AltTextExtension extends AbstractExtension
{
    /** Handle of the Lightswitch field created during plugin install. */
    private const TOGGLE_FIELD_HANDLE = 'altExtendDisabled';

    public function getFilters(): array
    {
        return [
            new TwigFilter('alt', [$this, 'alt']),
        ];
    }

    /**
     * Extends an alt text value with the configured text.
     *
     * When an Asset is passed the native alt text is read automatically.
     * If the opt-out Lightswitch is enabled on the asset, the original
     * alt text is returned unchanged.
     */
    public function alt(Asset|string|null $value): string
    {
        $settings = Plugin::getInstance()->getSettings();
        $altText = '';

        if ($value instanceof Asset) {
            if (!empty($value->{self::TOGGLE_FIELD_HANDLE})) {
                return $value->alt ?? '';
            }

            $altText = $value->alt ?? '';
        } elseif (is_string($value)) {
            $altText = $value;
        }

        return $this->extend($altText, $settings->text, $settings->position, $settings->separator);
    }

    private function extend(string $altText, string $text, string $position, string $separator): string
    {
        if ($text === '') {
            return $altText;
        }

        if ($altText === '') {
            return $text;
        }

        if ($position === 'prefix') {
            return $text . $separator . $altText;
        }

        return $altText . $separator . $text;
    }
}
