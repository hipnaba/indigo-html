<?php
namespace Indigo\Html\Element;

/**
 * This element only holds a reference to some other object and it's helper.
 *
 * @package Indigo\Html\Element
 * @author  Danijel Fabijan <danijel.fabijan@bruckom.hr>
 * @link    https://bitbucket.org/bruckom/bwp-core
 */
interface RenderableInterface
{
    /**
     * Returns the object to be rendered.
     *
     * @return mixed
     */
    public function getElement();

    /**
     * Set the object to be rendered.
     *
     * @param mixed $element The object to be rendered.
     *
     * @return void
     */
    public function setElement($element);

    /**
     * Returns the helper to be used to render the object.
     *
     * @return mixed
     */
    public function getHelper();

    /**
     * Sets the helper to be used to render the object.
     *
     * @param string $helper The helper.
     *
     * @return void
     */
    public function setHelper($helper);
}
