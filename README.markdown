
#fpJSHelpersPlugin

## Overview

The fpJSHelpersPlugin is a Symfony 1.x plugin that allows to add JS libs independent to version and its versions will store in config file

## Requirements

* [Symfony](http://www.symfony-project.org) 1.1 - 1.4

## Installation

### Download:
#### Pear package

    php symfony plugin:install fpJSHelpersPlugin

#### Git dev:

    git clone git://github.com/66Ton99/fpJSHelpersPlugin.git

### Enable it

    class ProjectConfiguration extends sfProjectConfiguration
    {
      public function setup()
      {
        $this->enablePlugins('fpJSHelpersPlugin');
      }
    }

## Getting Started

_app.yml_

    all:
      js_remote_libs:
        jquery:
          main:     'jquery-1.7.1.min.js'
          validate: 'jquery.validate-1.9.min.js'
        ko:
          main:    'knockout-2.1.0.min.js'
          mapping: 'knockout.mapping-latest.min.js'
        simple: 'simple.js'

_web folder_

    web
      js
        vendor
          jquery
            jquery-1.7.1.js
            jquery-1.7.1.min.js
            jquery.validate-1.9.js
            jquery.validate-1.9.min.js
          ko
            knockout-2.1.0.js
            knockout-2.1.0.min.js
            knockout.mapping-latest.js
            knockout.mapping-latest.min.js
          simple.js


_Using_

    js_add(
      array(
        'jquery-main',
        'jquery-validate',
        'ko-main',
        'ko-mapping',
        'simple',
      )
    );
