<?php
namespace Indigo\Html\Element;

use Countable;
use Indigo\Html\Attribute\AttributeAwareInterface;
use Indigo\Html\Attribute\CssClassAwareInterface;
use IteratorAggregate;

/**
 * Defines a HTML element.
 *
 * @package Indigo\Html
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
interface ElementInterface extends
    Countable,
    IteratorAggregate,
    AttributeAwareInterface,
    CssClassAwareInterface
{
    /**
     * All HTML tag names
     *
     * @see https://developer.mozilla.org/en/docs/Web/HTML/Element
     */
    const TAG_NAMES = [
        // Main root
        'html',
        // Document metadata
        'base',
        'head',
        'link',
        'meta',
        'style',
        'title',
        // Content sectioning
        'address',
        'article',
        'aside',
        'footer',
        'h1',
        'h2',
        'h3',
        'h4',
        'h5',
        'h6',
        'header',
        'hgroup',
        'nav',
        'section',
        // Text content
        'dd',
        'div',
        'dl',
        'dt',
        'figcaption',
        'figure',
        'hr',
        'li',
        'main',
        'ol',
        'p',
        'pre',
        'ul',
        // Inline text semantics
        'a',
        'abbr',
        'b',
        'bdi',
        'bdo',
        'br',
        'cite',
        'code',
        'data',
        'dfn',
        'em',
        'i',
        'kbd',
        'mark',
        'q',
        'rp',
        'rt',
        'rtc',
        'ruby',
        's',
        'samp',
        'small',
        'span',
        'strong',
        'sub',
        'sup',
        'time',
        'u',
        'var',
        'wbr',
        // Image and multimedia
        'area',
        'audio',
        'img',
        'map',
        'track',
        'video',
        // Embedded content
        'embed',
        'object',
        'param',
        'source',
        // Scripting
        'canvas',
        'noscript',
        'script',
        // Demarcating edits
        'del',
        'ins',
        // Table content
        'caption',
        'col',
        'colgroup',
        'table',
        'tbody',
        'td',
        'tfoot',
        'th',
        'thead',
        'tr',
        // Forms
        'button',
        'datalist',
        'fieldset',
        'form',
        'input',
        'label',
        'legend',
        'meter',
        'optgroup',
        'option',
        'output',
        'progress',
        'select',
        'textarea',
        // Interactive elements
        'details',
        'dialog',
        'menu',
        'menuitem',
        'summary',
        // Web components
        'shadow',
        'slot',
        'template',
    ];

    /**
     * Returns the element's tag name.
     *
     * @return string
     */
    public function getTag();

    /**
     * Sets the element's tag name.
     *
     * @param string $tagName New tag name
     *
     * @return void
     */
    public function setTag($tagName);

    /**
     * Returns the element's content.
     *
     * @return string
     */
    public function getContent();

    /**
     * Sets the element's content.
     *
     * @param string $content New content for the element
     *
     * @return void
     */
    public function setContent($content);

    /**
     * Returns child elements
     *
     * @return ElementInterface[]
     */
    public function getChildren();

    /**
     * Adds another alement as a child.
     *
     * @param ElementInterface $element Element to append to this one
     *
     * @return void
     */
    public function append(ElementInterface $element);
}
