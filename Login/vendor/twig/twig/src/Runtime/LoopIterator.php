<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Twig\Runtime;

use Twig\Error\RuntimeError;

/**
 * Represents a for loop variable.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @internal
 *
 * @template TKey
 * @template TValue
 *
 * @implements \Iterator<TKey, TValue>
 */
final class LoopIterator implements \Iterator
{
    private \Iterator $seq;
    private int $index0;
    private int $length;
    /** @var array{valid: bool, key: mixed, value: mixed} */
    private array $previous;
    /** @var array{valid: bool, key: mixed, value: mixed} */
    private array $current;
    /** @var array{valid: bool, key: mixed, value: mixed}|null */
    private ?array $next = null;

    /**
     * @param iterable<TKey, TValue> $seq
     */
    public function __construct($seq)
    {
        if (\is_array($seq)) {
            $this->seq = new \ArrayIterator($seq);
        } elseif ($seq instanceof \IteratorAggregate) {
            do {
                /** @var \Iterator<TKey, TValue> $seq */
                $seq = $seq->getIterator();
            } while ($seq instanceof \IteratorAggregate);
            $this->seq = $seq;
        } elseif (is_iterable($seq)) {
            /** @var \Iterator<TKey, TValue> $seq */
            $this->seq = $seq;
        } else {
            $this->seq = new \EmptyIterator();
        }
        $this->rewind();
    }

    public function current(): mixed
    {
        return $this->current['value'];
    }

    public function key(): mixed
    {
        return $this->current['key'];
    }

    public function next(): void
    {
        $this->previous = $this->current;
        if ($this->next) {
            $this->next = null;
        } else {
            $this->seq->next();
        }
        if ($this->seq->valid()) {
            $this->current = ['valid' => $this->seq->valid(), 'key' => $this->seq->key(), 'value' => $this->seq->current()];
        } else {
            $this->current = ['valid' => false, 'key' => null, 'value' => null];
        }
        ++$this->index0;
    }

    public function rewind(): void
    {
        $this->seq->rewind();
        $this->previous = ['valid' => false, 'key' => null, 'value' => null];
        if ($this->seq->valid()) {
            $this->current = ['valid' => $this->seq->valid(), 'key' => $this->seq->key(), 'value' => $this->seq->current()];
        } else {
            // EmptyIterator
            $this->current = ['valid' => false, 'key' => null, 'value' => null];
        }
        $this->next = null;
        $this->index0 = 0;
    }

    public function valid(): bool
    {
        return $this->current['valid'];
    }

    public function getIndex0(): int
    {
        return $this->index0;
    }

    public function getLength($var = 'length'): int
    {
        if (isset($this->length)) {
            return $this->length;
        }

        if (!$this->seq instanceof \Countable) {
            throw new RuntimeError(\sprintf('The "loop.%s" variable is not defined as the loop iterates on a non-countable iterator.', $var));
        }

        return $this->length = \count($this->seq);
    }

    /**
     * @return array{valid: bool, key: mixed, value: mixed}
     */
    public function getPrevious(): array
    {
        return $this->previous;
    }

    /**
     * @return array{valid: bool, key: mixed, value: mixed}
     */
    public function getNext(): array
    {
        if (!$this->next) {
            $this->seq->next();
            if ($this->seq->valid()) {
                $this->next = ['valid' => $this->seq->valid(), 'key' => $this->seq->key(), 'value' => $this->seq->current()];
            } else {
                // EmptyIterator
                $this->next = ['valid' => false, 'key' => null, 'value' => null];
            }
        }

        return $this->next;
    }
}
