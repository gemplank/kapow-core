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

## [Hooks and Filters](#hooks-filters)
The plugin takes advantage of various hooks and filters:

### Filters
Here are all the filters within the plugin:

#### Testing
- See [Testing](#testing).

#### Enqueues
CSS and JS Enqueues exist within the plugin for reference and development, but
we highly recommend that the appropriate filters are used to deactivate these
enqueues, and these are concatenated and enqueued using your own theme workflow.

Don't have a workflow? We recommend [Kapow](https://github.com/mkdo/kapow-setup).

The enqueue filters all accept a boolean, and are true by default. Use the
following method to enable them:

`add_filter( 'kapow_core_[filter_name]', '__return_true');`

The filters available are:

- `kapow_core_do_public_enqueue` &mdash; show all the public asset enqueues.
- `kapow_core_do_public_css_enqueue` &mdash; show the public CSS enqueue.
- `kapow_core_do_public_js_enqueue` &mdash; show the public JS enqueue.
- `kapow_core_do_admin_enqueue` &mdash; show all the admin asset enqueues.
- `kapow_core_do_admin_css_enqueue` &mdash; show the admin CSS enqueue.
- `kapow_core_do_admin_editor_css_enqueue` &mdash; show the admin editor CSS enqueue.
- `kapow_core_do_admin_js_enqueue` &mdash; show the admin JS enqueue.
- `kapow_core_do_customizer_enqueue` &mdash; show the customizer CSS enqueue.

#### Render Views
Views reside within the `/views` folder in the plugin, but you may wish to override these views in your theme.

Use the filter `kapow_core_view_template_folder` to set where the view
sits within your theme. EG:

`add_filter( 'kapow_core_view_template_folder', function() {  
	return get_stylesheet_directory() . '/template-parts/kapow-core/';  
} );`  

You can also return a boolean for the filter `kapow_core_view_template_folder_check_exists`
to perform an optional check if the template exists in your theme. However best
practice is duplicating the `/views` folder within your theme at a custom location.

## [Credit](#credits)

Built by [Matt Watson](https://github.com/mwtsn/) and [Dave Green](https://github.com/davetgreen/), with thanks to [Make Do](https://www.makedo.net/).

[Kapow Grunt](https://github.com/mkdo/kapow-grunt) workflow comes with thanks to [Dave Green](https://github.com/davetgreen/) and [Make Do](https://www.makedo.net/).
