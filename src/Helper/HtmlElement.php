<?php
namespace Indigo\Html\Helper;

use Indigo\Html\Element\ElementInterface;

/**
 * Renders a HTML element.
 *
 * @package Indigo\Html\Helper
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class HtmlElement extends AbstractHtmlHelper
{
    /**
     * Renders a HTML element.
     *
     * @param ElementInterface $element Element to render
     *
     * @return string
     */
    public function render(ElementInterface $element)
    {
        $rendered = $this->openTag($element);
        $content = '';

        if (count($element) > 0) {
            $content .= "\n";

            foreach ($element as $child) {
                $content .= '    ' . $this->render($child) . "\n";
            }
        }

        if ($this->hasEndTag($element)) {
            $rendered .= $content ?: $element->getContent();
            $rendered .= sprintf('</%s>', $element->getTag());
        }

        return $rendered;
    }

    /**
     * Renders the opening tag for the given element.
     *
     * @param ElementInterface $element Element to render.
     *
     * @return string
     */
    public function openTag(ElementInterface $element)
    {
        $attributes = $element->getAttributes();
        $attributeString = $this->getAttributeString($attributes);

        return sprintf(
            '<%s%s>',
            $element->getTag(),
            $attributeString ? ' ' . $attributeString : ''
        );
    }
}
