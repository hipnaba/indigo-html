# Indigo HTML

- A HTML abstraction layer.
- Rendering powered by [Zend View](https://docs.zendframework.com/zend-view/).

## Elements

### [Element](src/Element.php)

- A generic HTML element.

### Custom elements

1. Implement [ElementInterface](src/ElementInterface.php) or extend 
[Element](src/Element.php).

## View helpers

- Plugin manager configuration provided by [Module](src/Module.php).

### [htmlElement](src/Helper/HtmlElement.php)

- Renders a generic HTML element.

### Custom view helpers

1. Extend [AbstractHelper](src/Helper/AbstractHelper.php) or 
[HtmlElement](src/Helper/HtmlElement.php).
2. Register your helper with the plugin manager.