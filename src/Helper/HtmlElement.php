<?php
namespace Indigo\Html\Helper;

use Indigo\Html\Attribute\AttributeInterface;
use Indigo\Html\ElementInterface;
use Indigo\View\Helper\AbstractHelper;
use Zend\View\Helper\EscapeHtml;
use Zend\View\Helper\EscapeHtmlAttr;

/**
 * Renders a HTML element.
 *
 * @package Indigo\Html\Helper
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class HtmlElement extends AbstractHelper
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
     * HTML escaper.
     *
     * @var EscapeHtml
     */
    protected $escapeHtml;

    /**
     * Escaper za atribute.
     *
     * @var EscapeHtmlAttr
     */
    protected $escapeHtmlAttr;

    /**
     * Vraća HTML escaper.
     *
     * @return EscapeHtml
     */
    protected function getEscapeHtmlHelper()
    {
        if (null === $this->escapeHtml) {
            $this->escapeHtml = method_exists($this->view, 'plugin')
                ? $this->view->plugin('escapeHtml')
                : new EscapeHtml();
        }

        return $this->escapeHtml;
    }

    /**
     * Vraća escaper za atribute.
     *
     * @return EscapeHtmlAttr
     */
    protected function getEscapeHtmlAttrHelper()
    {
        if (null === $this->escapeHtmlAttr) {
            $this->escapeHtmlAttr = method_exists($this->view, 'plugin')
                ? $this->view->plugin('escapeHtmlAttr')
                : new EscapeHtmlAttr();
        }

        return $this->escapeHtmlAttr;
    }

    /**
     * Renders a HTML element or returns itself if element not passed.
     *
     * @param ElementInterface|null $element Element to render.
     *
     * @return HtmlElement|string
     */
    public function __invoke(ElementInterface $element = null)
    {
        if (null === $element) {
            return $this;
        }

        return $this->render($element);
    }

    /**
     * Renders a HTML element.
     *
     * @param ElementInterface $element Element to render
     *
     * @return string
     */
    public function render(ElementInterface $element)
    {
        $indent = $this->getIndentHelper();

        $rendered = $this->openTag($element);
        $content = [];

        if ($element->hasChildren()) {
            foreach ($element->getChildren() as $child) {
                $content[] = $this->render($child);
            }
        }

        if ($element->getContent()) {
            $content[] = $element->getContent();
        }

        $rendered .= count($content) > 1
            // Multiline content
            ? PHP_EOL . $indent(implode(PHP_EOL . PHP_EOL, $content)) . PHP_EOL
            : implode($content);


        if ($this->hasEndTag($element)) {
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

    /**
     * Renders the HTML attributes string.
     *
     * @param AttributeInterface[] $attributes Attributes to render
     *
     * @return string
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    protected function getAttributeString($attributes)
    {
        if (0 === count($attributes)) {
            return '';
        }

        $escapeHtml = $this->getEscapeHtmlHelper();
        $escapeHtmlAttr = $this->getEscapeHtmlAttrHelper();

        $rendered = [];

        foreach ($attributes as $attribute) {
            $name = $escapeHtml($attribute->getName());
            $value = $escapeHtmlAttr($attribute->getValue());

            $rendered[] = sprintf('%s="%s"', $name, $value);
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
