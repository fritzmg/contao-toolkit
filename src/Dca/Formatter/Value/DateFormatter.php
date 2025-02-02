<?php

declare(strict_types=1);

namespace Netzmacht\Contao\Toolkit\Dca\Formatter\Value;

use Contao\Config;
use Contao\Date;

use function in_array;

/**
 * DateFormatter format date values.
 */
final class DateFormatter implements ValueFormatter
{
    /**
     * Contao config.
     *
     * @var Config
     */
    private $config;

    /**
     * @param Config $config Contao config.
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * {@inheritDoc}
     */
    public function accepts(string $fieldName, array $fieldDefinition): bool
    {
        if ($fieldName === 'tstamp') {
            return true;
        }

        if (empty($fieldDefinition['eval']['rgxp'])) {
            return false;
        }

        return in_array($fieldDefinition['eval']['rgxp'], ['date', 'datim', 'time']);
    }

    /**
     * {@inheritDoc}
     */
    public function format($value, string $fieldName, array $fieldDefinition, $context = null)
    {
        if (empty($fieldDefinition['eval']['rgxp'])) {
            $format = 'datim';
        } else {
            $format = $fieldDefinition['eval']['rgxp'];
        }

        $dateFormat = $this->config->get($format . 'Format');

        return Date::parse($dateFormat, $value);
    }
}
