<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\PropertyAccess;

/**
 * A sequence of property names or array indices.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
interface PropertyPathInterface extends \Traversable
{
    /**
     * Returns the string representation of the property path.
     *
     * @return string The path as string
     */
    public function __toString();

    /**
     * Returns the length of the property path, i.e. the number of elements.
     *
     * @return int The path length
     */
    public function getLength();

    /**
     * Returns the parent property path.
     *
     * The parent property path is the one that contains the same items as
     * this one except for the last one.
     *
     * If this property path only contains one item, null is returned.
     *
     * @return self|null The parent path or null
     */
    public function getParent();

    /**
     * Returns the elements of the property path as array.
     *
     * @return array An array of property/index names
     */
    public function getElements();

    /**
     * Returns the element at the given index in the property path.
     *
     * @param int $index The index key
     *
     * @return string A property or index name
     *
     * @throws Exception\OutOfBoundsException If the offset is invalid
     */
    public function getElement($index);

    /**
     * Returns whether the element at the given index is a property.
     *
     * @param int $index The index in the property path
     *
     * @return bool Whether the element at this index is a property
     *
     * @throws Exception\OutOfBoundsException If the offset is invalid
     */
    public function isProperty($index);

    /**
     * Returns whether the element at the given index is an array index.
     *
     * @param int $index The index in the property path
     *
     * @return bool Whether the element at this index is an array index
     *
     * @throws Exception\OutOfBoundsException If the offset is invalid
     */
    public function isIndex($index);
}
