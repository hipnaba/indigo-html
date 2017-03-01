<?php
namespace Indigo\Html\Attribute;

use Indigo\Html\ElementInterface;
use Indigo\Html\Exception;

/**
 * Attribute Factory
 *
 * @package Indigo\Html\Attribute
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class AttributeFactory
{
    /**
     * Global attribute specs.
     *
     * @see https://developer.mozilla.org/en/docs/Web/HTML/Global_attributes
     */
    const GLOBAL_ATTRIBUTES = [
        'accesskey' => [
            'type' => 'list',
        ],
        'class' => [
            'type' => 'list',
        ],
        'contenteditable' => [
            'type' => 'enum',
            'options' => [
                'validValues' => ['true', '', 'false'],
                'valueMap' => [
                    0 => 'false',
                    1 => 'true',
                ],
            ],
        ],
        'contextmenu' => [
            'type' => 'string',
        ],
        'dir' => [
            'type' => 'enum',
            'values' => ['ltr', 'rtl', 'auto'],
        ],
        'hidden' => [
            'type' => 'boolean',
        ],
        'id' => [],
        'lang' => [],
        'style' => [],
        'tabindex' => [
            'type' => 'integer',
        ],
        'title' => [],
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
        'itemid' => [],
        'itemprop' => [],
        'itemref' => [],
        'itemscope' => [],
        'itemtype' => [],
        'slot' => [],
        'spellcheck' => [
            'type' => 'enum',
            'values' => ['true', 'false'],
            'convert' => [
                true => 'true',
                false => 'false,'
            ],
        ],
    ];

    /**
     * Valid attributes for tags
     */
    const TAG_ATTRIBUTES = [
        // Main root
        'html' => [
            'xmlns' => [],
        ],
        // Document metadata
        'base' => [
            'href' => [],
            'target' => [],
        ],
        'link' => [
            'crossorigin' => [
                'type' => 'enum',
                'values' => ['anonymous', 'use-credentials'],
            ],
            'disabled' => [],
            'href' => [],
            'hreflang' => [],
            'integrity' => [],
            'media' => [],
            'methods' => [],
            'prefetch' => [],
            'referrerpolicy' => [],
            'rel' => [],
            'sizes' => [
                'type' => 'list',
            ],
            'target' => [],
            'title' => [],
            'type' => [],
        ],
        'meta' => [
            'charset' => [],
            'content' => [],
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
            'type' => [],
            'media' => [],
            'title' => [],
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
            'download' => [],
            'href' => [],
            'hreflang' => [],
            'refererpolicy' => [],
            'rel' => [],
            'target' => [],
            'type' => [],
        ],
        'bdo' => [
            'dir' => [
                'type' => 'enum',
                'values' => ['ltr', 'rtl'],
            ],
        ],
        'data' => [
            'value' => [],
        ],
        'q' => [
            'cite' => [],
        ],
        'time' => [
            'datetime' => [],
        ],
        // Image and multimedia
        'area' => [
            'alt' => [],
            'coords' => [],
            'download' => [],
            'href' => [],
            'hreflang' => [],
            'media' => [],
            'refererpolicy' => [],
            'rel' => [],
            'shape' => [],
            'target' => [],
        ],
        'audio' => [
            'autoplay' => [
                'type' => 'boolean'
            ],
            'buffered' => [],
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
            'src' => [],
            'volume' => [],
        ],
        'img' => [
            'src' => [],
            'alt' => [],
            'crossorigin' => [
                'type' => 'enum',
                'values' => ['anonymous', 'use-credentials'],
            ],
            'height' => [],
            'ismap' => [
                'type' => 'boolean',
            ],
            'longdesc' => [],
            'referrerpolicy' => [],
            'sizes' => [
                'type' => 'list',
            ],
            'srcset' => [
                'type' => 'list',
                'separator' => ',',
            ],
            'width' => [],
            'usemap' => [],
        ],
        'map' => [
            'name' => [],
        ],
        'track' => [
            'default' => [],
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
            'label' => [],
            'src' => [],
            'srclang' => [],
        ],
        'video' => [
            'autoplay' => [
                'type' => 'boolean'
            ],
            'buffered' => [],
            'controls' => [
                'type' => 'boolean',
            ],
            'crossorigin' => [
                'type' => 'enum',
                'values' => ['anonymous', 'use-credentials'],
            ],
            'height' => [],
            'loop' => [
                'type' => 'boolean',
            ],
            'muted' => [
                'type' => 'boolean',
            ],
            'played' => [],
            'preload' => [
                'type' => 'enum',
                'values' => ['none', 'metadata', 'auto', ''],
            ],
            'poster' => [],
            'src' => [],
            'width' => [],
        ],
        // Embedded content
        'embed' => [
            'height' => [],
            'src' => [],
            'type' => [],
            'width' => [],
        ],
        'object' => [
            'form' => [],
            'height' => [],
            'name' => [],
            'type' => [],
            'typemustmatch' => [],
            'usemap' => [],
            'width' => [],
        ],
        'param' => [
            'name' => [],
            'value' => [],
        ],
        'source' => [
            'sizes' => [],
            'src' => [],
            'srcset' => [],
            'type' => [],
            'media' => [],
        ],
        // Scripting
        'canvas' => [
            'height' => [],
            'width' => [],
        ],
        'script' => [
            'async' => [
                'type' => 'boolean',
            ],
            'integrity' => [],
            'src' => [],
            'type' => [],
            'text' => [],
            'defer' => [
                'type' => 'boolean',
            ],
        ],
        // Demarcating edits
        'del' => [
            'cite' => [],
            'datetime' => [],
        ],
        'ins' => [
            'cite' => [],
            'datetime' => [],
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
            'form' => [],
            'formaction' => [],
            'formenctype' => [],
            'formmethod' => [],
            'formnovalidate' => [],
            'formtarget' => [],
            'name' => [],
            'type' => [
                'type' => 'enum',
                'options' => [
                    'validValues' => [
                        'button',
                        'menu',
                        'reset',
                        'submit',
                    ],
                ],
            ],
            'value' => [],
        ],
        'fieldset' => [
            'disabled' => [
                'type' => 'boolean',
            ],
            'form' => [],
            'name' => [],
        ],
        'form' => [
            'accept-charset' => [],
            'action' => [],
            'autocomplete' => [
                'type' => 'enum',
                'values' => ['on', 'off'],
                'convert' => [
                    true => 'on',
                    false => 'off',
                ],
            ],
            'enctype' => [],
            'method' => [],
            'name' => [],
            'novalidate' => [],
            'target' => [],
        ],
        'input' => [
            'type' => [
                'type' => 'enum',
                'options' => [
                    'validValues' => [
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
            ],
            'accept' => [],
            'autocomplete' => [],
            'autofocus' => [
                'type' => 'boolean',
            ],
            'capture' => [],
            'checked' => [
                'type' => 'boolean',
            ],
            'disabled' => [
                'type' => 'boolean',
            ],
            'form' => [],
            'formaction' => [],
            'formenctype' => [],
            'formmethod' => [],
            'formnovalidate' => [],
            'formtarget' => [],
            'height' => [],
            'inputmode' => [],
            'list' => [],
            'max' => [],
            'maxlength' => [],
            'min' => [],
            'minlength' => [],
            'multiple' => [],
            'name' => [],
            'pattern' => [],
            'placeholder' => [],
            'readonly' => [],
            'required' => [
                'type' => 'boolean',
            ],
            'selectionDirection' => [],
            'selectionEnd' => [],
            'selectionStart' => [],
            'size' => [],
            'spellcheck' => [],
            'src' => [],
            'step' => [],
            'value' => [],
            'width' => [],
        ],
        'label' => [
            'for' => [],
        ],
        'meter' => [
            'value' => [],
            'min' => [],
            'max' => [],
            'low' => [],
            'high' => [],
            'optimum' => [],
            'form' => [],
        ],
        'optgroup' => [
            'disabled' => [],
            'label' => [],
        ],
        'option' => [
            'disabled' => [],
            'label' => [],
            'selected' => [],
            'value' => [],
        ],
        'output' => [
            'for' => [],
            'form' => [],
            'name' => [],
        ],
        'progress' => [
            'max' => [],
            'value' => [],
        ],
        'select' => [
            'autofocus' => [],
            'disabled' => [],
            'form' => [],
            'multiple' => [],
            'name' => [],
            'required' => [],
            'size' => [],
        ],
        'textarea' => [
            'autofocus' => [],
            'cols' => [],
            'disabled' => [],
            'form' => [],
            'maxlength' => [],
            'minlength' => [],
            'name' => [],
            'placeholder' => [],
            'readonly' => [],
            'required' => [],
            'rows' => [],
            'selectionDirection' => [],
            'selectionEnd' => [],
            'selectionStart' => [],
            'spellcheck' => [],
            'wrap' => [],
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
            'label' => [],
            'type' => [],
        ],
        'menuitem' => [
            'checked' => [],
            'command' => [],
            'default' => [],
            'disabled' => [],
            'icon' => [],
            'label' => [],
            'radiogroup' => [],
            'type' => [],
        ],
    ];

    /**
     * Attribute implementations by type
     *
     * @var array
     */
    protected $types = [
        'boolean' => BooleanAttribute::class,
        'enum' => EnumAttribute::class,
        'integer' => IntegerAttribute::class,
        'list' => ListAttribute::class,
        'string' => StringAttribute::class,
    ];

    /**
     * Creates a new attribute
     *
     * @param mixed            $spec    Attribute to create.
     * @param ElementInterface $element The element this attribute belongs to.
     *
     * @return AttributeInterface
     */
    public function create($spec, ElementInterface $element = null)
    {
        if (is_string($spec)) {
            $spec = $this->getAttributeSpec($spec, $element);
        }

        if (!isset($spec['type'])) {
            $spec['type'] = 'string';
        }

        if (!isset($spec['name'])) {
            throw new \InvalidArgumentException('Must specify the attribute name');
        }

        if (!$this->isValidAttributeName($spec['name'], $element)) {
            throw new Exception\InvalidAttributeNameException(
                sprintf('%s is not a valid HTML attribute', $spec['name'])
            );
        }

        $attributeClass = isset($this->types[$spec['type']])
            ? $this->types[$spec['type']]
            : Attribute::class;

        /**
         * The created attribute
         *
         * @var AttributeInterface $attribute
         */
        $options = isset($spec['options']) ? $spec['options'] : [];
        $attribute = new $attributeClass($spec['name'], $options);

        return $attribute;
    }

    /**
     * Returns an attribute spec based on its name and possibly element.
     *
     * @param string                $name    Attribute name.
     * @param ElementInterface|null $element Element this attribute belongs to
     *
     * @return array
     */
    protected function getAttributeSpec($name, ElementInterface $element = null)
    {
        $spec = [
            'type' => 'string',
            'name' => $name,
        ];

        if (null !== $element
            && array_key_exists($element->getTag(), self::TAG_ATTRIBUTES)
            && array_key_exists($name, self::TAG_ATTRIBUTES[$element->getTag()])
        ) {
            return array_merge($spec, self::TAG_ATTRIBUTES[$element->getTag()][$name]);
        }

        if (array_key_exists($name, self::GLOBAL_ATTRIBUTES)) {
            return array_merge($spec, self::GLOBAL_ATTRIBUTES[$name]);
        }

        return $spec;
    }

    /**
     * Returns true if the attribute is valid base on the sent name and possibly element.
     *
     * @param string                $name    Attribute name.
     * @param ElementInterface|null $element Element this attribute belongs to.
     *
     * @return boolean
     */
    protected function isValidAttributeName($name, ElementInterface $element = null)
    {
        if (preg_match('/^(aria|data)-/', $name)) {
            return true;
        }

        if (array_key_exists($name, self::GLOBAL_ATTRIBUTES)) {
            return true;
        }

        if (null !== $element
            && array_key_exists($element->getTag(), self::TAG_ATTRIBUTES)
            && array_key_exists($name, self::TAG_ATTRIBUTES[$element->getTag()])
        ) {
            return true;
        }

        return false;
    }
}
