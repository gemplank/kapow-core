# Kapow Core

The main plugin for Kapow! Stick this in your my-plugins folder and enjoy!

## [Workflow](#workflow)

The plugin comes with its own Grunt based workflow based on [Kapow Grunt](https://github.com/mkdo/kapow-grunt). You don't have to use it, but it will
help you organise your assets better if you do.

To get this up and running, when you first download the project run the following
commands from the root of the plugin:

`cd tools`  
`sudo npm install`  
`bower update`  
`cd ..`  

This will change the directory to the tools directory, install all the components
you need to run commands such as Grunt, as well as any dependancies that your
project has.

From here on you just need to run the Grunt command:

`grunt`

from your root directory, to compile all of the assets in `/assets/raw/` to the
relevant folders in `/assets/`.

For more information about what this does, read up on [Kapow Grunt](https://github.com/mkdo/kapow-grunt).

## [Configuration (Hooks and Filters)](#hooks-filters)
All configuration details are in the file `kapow-core-config-template.php` in the root of this project.

## [Credit](#credits)

Built by [Matt Watson](https://github.com/mwtsn/) and [Dave Green](https://github.com/davetgreen/), with thanks to [Make Do](https://www.makedo.net/).

[Kapow Grunt](https://github.com/mkdo/kapow-grunt) workflow comes with thanks to [Dave Green](https://github.com/davetgreen/) and [Make Do](https://www.makedo.net/).
