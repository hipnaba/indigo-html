# Indigo HTML

[![Build Status](https://travis-ci.org/hipnaba/indigo-html.svg?branch=master)](https://travis-ci.org/hipnaba/indigo-html.svg?branch=master)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/adb446e438a84582acd3c6a9e604b8c3)](https://www.codacy.com/app/hipnaba/indigo-html?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=hipnaba/indigo-html&amp;utm_campaign=Badge_Grade)
[![Codacy Badge](https://api.codacy.com/project/badge/Coverage/adb446e438a84582acd3c6a9e604b8c3)](https://www.codacy.com/app/hipnaba/indigo-html?utm_source=github.com&utm_medium=referral&utm_content=hipnaba/indigo-html&utm_campaign=Badge_Coverage)
[![CII Best Practices](https://bestpractices.coreinfrastructure.org/projects/729/badge)](https://bestpractices.coreinfrastructure.org/projects/729)

Indigo HTML tries to simplify HTML element manipulation. It does not work with
DOMElement but provides an API of its own. It also provides integration with
[Zend View](https://docs.zendframework.com/zend-view/) in the form of view helpers.

## Instalation

```
composer require hipnaba/indigo-html dev-master
```

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