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
     *
     * @SuppressWarnings(PHPMD.ElseExpression)
     */
    public function render(ElementInterface $element)
    {
        $tag = $element->getTag();

        $attributes = $element->getAttributes();
        $attributeString = $this->getAttributeString($attributes);

        $rendered = sprintf('<%s%s>', $tag, $attributeString ? ' ' . $attributeString : '');

        if (count($element)) {
            $rendered .= "\n";

            foreach ($element as $child) {
                $rendered .= '    ' . $this->render($child) . "\n";
            }
        } else {
            $rendered .= $element->getContent();
        }

        if ($this->hasEndTag($element)) {
            $rendered .= sprintf('</%s>', $tag);
        }

        return $rendered;
    }
}
