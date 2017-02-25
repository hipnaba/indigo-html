# Indigo HTML

[![Build Status](https://travis-ci.org/hipnaba/indigo-html.svg?branch=master)](https://travis-ci.org/hipnaba/indigo-html.svg?branch=master)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/adb446e438a84582acd3c6a9e604b8c3)](https://www.codacy.com/app/hipnaba/indigo-html?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=hipnaba/indigo-html&amp;utm_campaign=Badge_Grade)
[![Codacy Badge](https://api.codacy.com/project/badge/Coverage/adb446e438a84582acd3c6a9e604b8c3)](https://www.codacy.com/app/hipnaba/indigo-html?utm_source=github.com&utm_medium=referral&utm_content=hipnaba/indigo-html&utm_campaign=Badge_Coverage)
[![CII Best Practices](https://bestpractices.coreinfrastructure.org/projects/729/badge)](https://bestpractices.coreinfrastructure.org/projects/729)

Indigo HTML tries to simplify HTML element manipulation. It does not work with
DOMElement but provides an API of its own. It also provides integration with
[Zend View](https://docs.zendframework.com/zend-view/) in the form of view helpers.

## Installation

```
composer require hipnaba/indigo-html dev-master
```

## Usage

```php
<?php
// Creating elements
$link = new \Indigo\Html\Element\Element('a', [
    'class' => 'link',
]);

// Settings attributes
$link->setAttribute('href', '#');

// Working with css classes
$link->addClass('link-default');

// Setting content
$link->setContent('This is a link!');

// Nesting elements
$item = new \Indigo\Html\Element\Element('li');
$item->append($link);

$list = new \Indigo\Html\Element\Element('ul', [
    'id' => 'menu',
]);
$list->append($item);

// Rendering elements using the helper
echo $this->htmlElement($list);
```

The above example would render something like this:

```html
<ul id="menu">
    <li>
        <a class="link link-default" href="#">This is a link!</a>
    </li>
</ul>
```