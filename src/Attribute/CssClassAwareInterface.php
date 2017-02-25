<?php
namespace Indigo\Html\Attribute;

/**
 * Interface CssClassAwareInterface
 *
 * @package Indigo\Html\Attribute
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
interface CssClassAwareInterface extends AttributeAwareInterface
{
    /**
     * Adds a css class to the element.
     *
     * @param string $class   The class name
     * @param bool   $prepend If true will add the class to the beggining of the class list
     *
     * @return void
     */
    public function addClass($class, $prepend = false);

    /**
     * Returns true if the element has the css class.
     *
     * @param string $class Regex for the class
     *
     * @return bool
     */
    public function hasClass($class);

    /**
     * Removes a css class from the element.
     *
     * @param string $class Regex for the class
     *
     * @return void
     */
    public function removeClass($class);

    /**
     * Replaces a css class with another.
     *
     * @param string $search  Old class regex.
     * @param string $replace The new class.
     *
     * @return void
     */
    public function replaceClass($search, $replace);
}
