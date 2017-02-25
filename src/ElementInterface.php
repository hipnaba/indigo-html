<?php
namespace Indigo\Html;

use Countable;
use IteratorAggregate;

/**
 * Defines a HTML element.
 *
 * @package Indigo\Html
 */
interface ElementInterface extends
    Countable,
    IteratorAggregate
{
    /** @see https://developer.mozilla.org/en/docs/Web/HTML/Element */
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
    /** @see https://developer.mozilla.org/en/docs/Web/HTML/Global_attributes */
    const GLOBAL_ATTRIBUTES = [
        'accesskey' => [
            'type' => 'list',
        ],
        'class' => [
            'type' => 'list',
        ],
        'contenteditable' => [
            'type' => 'enum',
            'values' => ['true', '', 'false'],
            'convert' => [
                true => 'true',
                false => 'false',
            ],
        ],
        'contextmenu',
        'dir' => [
            'type' => 'enum',
            'values' => ['ltr', 'rtl', 'auto'],
        ],
        'hidden' => [
            'type' => 'boolean',
        ],
        'id',
        'lang',
        'style',
        'tabindex' => [
            'type' => 'integer',
        ],
        'title',
        'translate' => [
            'type' => 'enum',
            'values' => ['yes', '', 'no'],
            'convert' => [
                true => 'yes',
                false => 'no',
            ],
        ],
        // Experimental
        'draggable' => [
            'type' => 'enum',
            'values' => ['true', 'false'],
            'convert' => [
                true => 'true',
                false => 'false',
            ],
        ],
        'dropzone' => [
            'type' => 'enum',
            'values' => ['copy', 'move', 'link'],
        ],
        'itemid',
        'itemprop',
        'itemref',
        'itemscope',
        'itemtype',
        'slot',
        'spellcheck' => [
            'type' => 'enum',
            'values' => ['true', 'false'],
            'convert' => [
                true => 'true',
                false => 'false,'
            ],
        ],
    ];
    /** Valid attributes for tags */
    const TAG_ATTRIBUTES = [
        // Main root
        'html' => [
            /** @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/html */
            'xmlns',
        ],
        // Document metadata
        'base' => [
            /** @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/base */
            'href',
            'target',
        ],
        'link' => [
            'crossorigin' => [
                'type' => 'enum',
                'values' => ['anonymous', 'use-credentials'],
            ],
            'disabled',
            'href',
            'hreflang',
            'integrity',
            'media',
            'methods',
            'prefetch',
            'referrerpolicy',
            'rel',
            'sizes' => [
                'type' => 'list',
            ],
            'target',
            'title',
            'type',
        ],
        'meta' => [
            'charset',
            'content',
            'http-equiv' => [
                'type' => 'enum',
                'values' => [
                    'Content-Security-Policy',
                    'default-style',
                    'refresh',
                ],
            ],
            'name' => [
                'type' => 'enum',
                'values' => [
                    'application-name',
                    'author',
                    'description',
                    'generator',
                    'keywords',
                    'referrer',
                    'creator',
                    'googlebot',
                    'publisher',
                    'robots',
                    'viewport',
                ],
            ],
        ],
        'style' => [
            'type',
            'media',
            'title',
        ],
        // Text content
        'li' => [
            'value' => [
                'type' => 'integer',
            ],
        ],
        'ol' => [
            'reversed' => [
                'type' => 'boolean',
            ],
            'start' => [
                'type' => 'integer',
            ],
            'type' => [
                'type' => 'enum',
                'values' => ['a', 'A', 'i', 'I', '1'],
            ],
        ],
        // Inline text semantics
        'a' => [
            'download',
            'href',
            'hreflang',
            'refererpolicy',
            'rel',
            'target',
            'type',
        ],
        'bdo' => [
            'dir' => [
                'type' => 'enum',
                'values' => ['ltr', 'rtl'],
            ],
        ],
        'data' => [
            'value',
        ],
        'q' => [
            'cite',
        ],
        'time' => [
            'datetime',
        ],
        // Image and multimedia
        'area' => [
            'alt',
            'coords',
            'download',
            'href',
            'hreflang',
            'media',
            'refererpolicy',
            'rel',
            'shape',
            'target',
        ],
        'audio' => [
            'autoplay' => [
                'type' => 'boolean'
            ],
            'buffered',
            'controls' => [
                'type' => 'boolean',
            ],
            'loop' => [
                'type' => 'boolean',
            ],
            'muted' => [
                'type' => 'boolean',
            ],
            'played',
            'preload' => [
                'type' => 'enum',
                'values' => ['none', 'metadata', 'auto', ''],
            ],
            'src',
            'volume',
        ],
        'img' => [
            'alt',
            'crossorigin' => [
                'type' => 'enum',
                'values' => ['anonymous', 'use-credentials'],
            ],
            'height',
            'ismap' => [
                'type' => 'boolean',
            ],
            'longdesc',
            'referrerpolicy',
            'sizes' => [
                'type' => 'list',
            ],
            'srcset' => [
                'type' => 'list',
                'separator' => ',',
            ],
            'width',
            'usemap',
        ],
        'map' => [
            'name',
        ],
        'track' => [
            'default',
            'kind' => [
                'type' => 'enum',
                'values' => [
                    'subtitles',
                    'captions',
                    'descriptions',
                    'chapters',
                    'metadata',
                ],
            ],
            'label',
            'src',
            'srclang',
        ],
        'video' => [
            'autoplay' => [
                'type' => 'boolean'
            ],
            'buffered',
            'controls' => [
                'type' => 'boolean',
            ],
            'crossorigin' => [
                'type' => 'enum',
                'values' => ['anonymous', 'use-credentials'],
            ],
            'height',
            'loop' => [
                'type' => 'boolean',
            ],
            'muted' => [
                'type' => 'boolean',
            ],
            'played',
            'preload' => [
                'type' => 'enum',
                'values' => ['none', 'metadata', 'auto', ''],
            ],
            'poster',
            'src',
            'width',
        ],
        // Embedded content
        'embed' => [
            'height',
            'src',
            'type',
            'width',
        ],
        'object' => [
            'form',
            'height',
            'name',
            'type',
            'typemustmatch',
            'usemap',
            'width',
        ],
        'param' => [
            'name',
            'value',
        ],
        'source' => [
            'sizes',
            'src',
            'srcset',
            'type',
            'media',
        ],
        // Scripting
        'canvas' => [
            'height',
            'width',
        ],
        'script' => [
            'async' => [
                'type' => 'boolean',
            ],
            'integrity',
            'src',
            'type',
            'text',
            'defer' => [
                'type' => 'boolean',
            ],
        ],
        // Demarcating edits
        'del' => [
            'cite',
            'datetime',
        ],
        'ins' => [
            'cite',
            'datetime',
        ],
        // Table content
        'col' => [
            'span' => [
                'type' => 'integer',
            ]
        ],
        'colgroup' => [
            'span' => [
                'type' => 'integer',
            ]
        ],
        'td' => [
            'colspan' => [
                'type' => 'integer',
            ],
            'headers' => [
                'type' => 'list',
            ],
            'rowspan' => [
                'type' => 'integer',
            ],
        ],
        'th' => [
            'colspan' => [
                'type' => 'integer',
            ],
            'headers' => [
                'type' => 'list',
            ],
            'rowspan' => [
                'type' => 'integer',
            ],
            'scope' => [
                'type' => 'enum',
                'values' => ['row', 'col', 'rowgroup', 'colgroup', 'auto'],
            ],
        ],
        // Forms
        'button' => [
            'autofocus' => [
                'type' => 'boolean',
            ],
            'disabled' => [
                'type' => 'boolean',
            ],
            'form',
            'formaction',
            'formenctype',
            'formmethod',
            'formnovalidate',
            'formtarget',
            'name',
            'type' => [
                'type' => 'enum',
                'values' => ['submit', 'reset', 'button', 'menu'],
            ],
            'value',
        ],
        'fieldset' => [
            'disabled' => [
                'type' => 'boolean',
            ],
            'form',
            'name',
        ],
        'form' => [
            'accept-charset',
            'action',
            'autocomplete' => [
                'type' => 'enum',
                'values' => ['on', 'off'],
                'convert' => [
                    true => 'on',
                    false => 'off',
                ],
            ],
            'enctype',
            'method',
            'name',
            'novalidate',
            'target',
        ],
        'input' => [
            'type' => [
                'type' => 'enum',
                'values' => [
                    'button',
                    'checkbox',
                    'color',
                    'date',
                    'datetime',
                    'datetime-local',
                    'email',
                    'file',
                    'hidden',
                    'image',
                    'month',
                    'number',
                    'password',
                    'radio',
                    'range',
                    'reset',
                    'search',
                    'submit',
                    'tel',
                    'text',
                    'time',
                    'url',
                    'week',
                ],
            ],
            'accept',
            'autocomplete',
            'autofocus' => [
                'type' => 'boolean',
            ],
            'capture',
            'checked' => [
                'type' => 'boolean',
            ],
            'disabled' => [
                'type' => 'boolean',
            ],
            'form',
            'formaction',
            'formenctype',
            'formmethod',
            'formnovalidate',
            'formtarget',
            'height',
            'inputmode',
            'list',
            'max',
            'maxlength',
            'min',
            'minlength',
            'multiple',
            'name',
            'pattern',
            'placeholder',
            'readonly',
            'required',
            'selectionDirection',
            'selectionEnd',
            'selectionStart',
            'size',
            'spellcheck',
            'src',
            'step',
            'value',
            'width',
        ],
        'label' => [
            'for',
        ],
        'meter' => [
            'value',
            'min',
            'max',
            'low',
            'high',
            'optimum',
            'form',
        ],
        'optgroup' => [
            'disabled',
            'label',
        ],
        'option' => [
            'disabled',
            'label',
            'selected',
            'value',
        ],
        'output' => [
            'for',
            'form',
            'name',
        ],
        'progress' => [
            'max',
            'value',
        ],
        'select' => [
            'autofocus',
            'disabled',
            'form',
            'multiple',
            'name',
            'required',
            'size',
        ],
        'textarea' => [
            'autofocus',
            'cols',
            'disabled',
            'form',
            'maxlength',
            'minlength',
            'name',
            'placeholder',
            'readonly',
            'required',
            'rows',
            'selectionDirection',
            'selectionEnd',
            'selectionStart',
            'spellcheck',
            'wrap',
        ],
        // Interactive elements
        'details' => [
            'open' => [
                'type' => 'boolean',
            ],
        ],
        'dialog' => [
            'open' => [
                'type' => 'boolean',
            ],
        ],
        'menu' => [
            'label',
            'type',
        ],
        'menuitem' => [
            'checked',
            'command',
            'default',
            'disabled',
            'icon',
            'label',
            'radiogroup',
            'type',
        ],
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
     * @param string $tagName
     */
    public function setTag($tagName);

    /**
     * Returns true if the element has an attribute.
     *
     * @param  string $name
     * @return bool
     */
    public function hasAttribute($name);

    /**
     * Returns an element's attribute value.
     *
     * @param  string $name
     * @return mixed
     */
    public function getAttribute($name);

    /**
     * Set an element's attribute value
     *
     * @param  string $name
     * @param  mixed $value
     */
    public function setAttribute($name, $value);

    /**
     * Returns all attributes.
     *
     * @return array
     */
    public function getAttributes();

    /**
     * Sets multiple attributes.
     *
     * @param  array $attributes
     */
    public function setAttributes(array $attributes);

    /**
     * Remove an element's attribute.
     *
     * @param string $name
     */
    public function removeAttribute($name);

    /**
     * Removes multiple attributes.
     *
     * @param array $names
     */
    public function removeAttributes(array $names);

    /**
     * Removes all attributes from the element.
     *
     * @return $this
     */
    public function clearAttributes();

    /**
     * Returns the element's content.
     *
     * @return string
     */
    public function getContent();

    /**
     * Sets the element's content.
     *
     * @param string $content
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
     * @param ElementInterface $element
     */
    public function append(ElementInterface $element);
}
