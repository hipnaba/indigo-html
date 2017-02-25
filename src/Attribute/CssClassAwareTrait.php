<?php
namespace Indigo\Html\Attribute;

/**
 * Class CssClassAwareTrait
 *
 * @package Indigo\Html\Attribute
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
trait CssClassAwareTrait
{
    /**
     * Adds a css class to the element.
     *
     * @param string $class   The class name
     * @param bool   $prepend If true will add the class to the beggining of the class list
     *
     * @return void
     */
    public function addClass($class, $prepend = false)
    {
        if (!$this->hasClass($class)) {
            $class = $prepend
                ? $class . ' ' . $this->getAttribute('class')
                : $this->getAttribute('class') . ' ' . $class;

            $this->setAttribute('class', $class);
        }
    }

    /**
     * Returns true if the element has the css class.
     *
     * @param string $class Regex for the class
     *
     * @return bool
     */
    public function hasClass($class)
    {
        return preg_match($this->getClassRegex($class), $this->getAttribute('class'));
    }

    /**
     * Removes a css class from the element.
     *
     * @param string $class Regex for the class
     *
     * @return void
     */
    public function removeClass($class)
    {
        $newClass = trim(preg_replace($this->getClassRegex($class), ' ', $this->getAttribute('class')));
        $this->setAttribute('class', $newClass);
    }

    /**
     * Replaces a css class with another.
     *
     * @param string $search  Old class regex.
     * @param string $replace The new class.
     *
     * @return void
     */
    public function replaceClass($search, $replace)
    {
        $search = $this->getClassRegex($search);
        $replace = sprintf(' %s ', $replace);

        $newClass = preg_replace($search, $replace, $this->getAttribute('class'));
        $this->setAttribute('class', trim($newClass));
    }

    /**
     * Prepares the class regex.
     *
     * @param string $class Css class regex
     *
     * @return string
     */
    protected function getClassRegex($class)
    {
        return sprintf('/(^|\s)%s(\s|$)/', $class);
    }
}
