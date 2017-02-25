<?php
namespace Indigo\Html\Helper;

use Indigo\Html\Element\ElementInterface;
use Zend\Json\Json;
use Zend\View\Helper\AbstractHelper as BaseAbstractHelper;
use Zend\View\Helper\EscapeHtml;
use Zend\View\Helper\EscapeHtmlAttr;
use Zend\View\Renderer\PhpRenderer;

/**
 * Abstract Element Helper
 *
 * @package Indigo\Html\Helper
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 *
 * @method PhpRenderer getView()
 */
abstract class AbstractHtmlHelper extends BaseAbstractHelper
{
    /**
     * All HTML tags that don't have an end tag
     *
     * @see https://developer.mozilla.org/en/docs/Web/HTML/Element
     */
    const NO_END_TAG = [
        // Document metadata
        'base',
        'link',
        'meta',
        // Text content
        'hr',
        // Inline text semantics
        'br',
        'wbr',
        // Image and multimedia
        'area',
        'img',
        'track',
        // Embedded content
        'embed',
        'param',
        'source',
        // Table content
        'col',
        // Forms
        'input',
        // Interactive elements
        'menuitem',
    ];

    /**
     * Renders an Indigo Element.
     *
     * If no element is passed, returns itself. Can be used to configure
     * the helper before calling `render`.
     *
     * @param ElementInterface|null $element Element to render
     *
     * @return AbstractHtmlHelper|string
     */
    public function __invoke(ElementInterface $element = null)
    {
        if (null === $element) {
            return $this;
        }

        return $this->render($element);
    }

    /**
     * Returns the element's HTML.
     *
     * @param ElementInterface $element Element to render
     *
     * @return string
     */
    abstract public function render(ElementInterface $element);

    /**
     * Renders the HTML attributes string.
     *
     * @param array $attributes Attributes to render
     *
     * @return string
     */
    protected function getAttributeString(array $attributes)
    {
        /**
         * HTML escaper
         *
         * @var EscapeHtml $escapeHtml
         */
        $escapeHtml = $this->getView()->plugin('escapeHtml');

        /**
         * HTML attribute escaper
         *
         * @var EscapeHtmlAttr $escapeHtmlAttr
         */
        $escapeHtmlAttr = $this->getView()->plugin('escapeHtmlAttr');

        $rendered = [];

        foreach ($attributes as $name => $value) {
            if (!is_scalar($value)) {
                $value = Json::encode($value);
            }

            $rendered[] = sprintf('%s="%s"', $escapeHtml($name), $escapeHtmlAttr($value));
        }

        return implode(' ', $rendered);
    }

    /**
     * Returns true if a given element in fact has an end tag.
     *
     * @param ElementInterface $element Element to check
     *
     * @return bool
     */
    protected function hasEndTag(ElementInterface $element)
    {
        $tag = $element->getTag();
        return !in_array($tag, self::NO_END_TAG);
    }
}
