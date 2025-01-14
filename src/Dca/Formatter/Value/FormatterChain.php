<?php

declare(strict_types=1);

namespace Netzmacht\Contao\Toolkit\Dca\Formatter\Value;

use Netzmacht\Contao\Toolkit\Assertion\Assertion;

/**
 * Set of multiple formatter.
 */
final class FormatterChain implements ValueFormatter
{
    /**
     * List of value formatter.
     *
     * @var ValueFormatter[]
     */
    private $formatter = [];

    /**
     * @param ValueFormatter[]|array $formatter Value formatter.
     */
    public function __construct(array $formatter)
    {
        Assertion::allImplementsInterface($formatter, ValueFormatter::class);

        $this->formatter = $formatter;
    }

    /**
     * {@inheritDoc}
     */
    public function accepts(string $fieldName, array $fieldDefinition): bool
    {
        foreach ($this->formatter as $formatter) {
            if ($formatter->accepts($fieldName, $fieldDefinition)) {
                return true;
            }
        }

        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function format($value, string $fieldName, array $fieldDefinition, $context = null)
    {
        foreach ($this->formatter as $formatter) {
            if ($formatter->accepts($fieldName, $fieldDefinition)) {
                return $formatter->format($value, $fieldName, $fieldDefinition, $context);
            }
        }

        return $value;
    }
}
