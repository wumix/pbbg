<?php

namespace Medusa\App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Form;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Form::component('xtext',        'components.form.text',     ['name', 'value', 'attributes']);
        Form::component('xpassword',    'components.form.password', ['name', 'attributes']);
        Form::component('xtextarea',    'components.form.textarea', ['name', 'value', 'attributes']);
        Form::component('xnumber',      'components.form.number',   ['name', 'value', 'attributes']);
        Form::component('xemail',       'components.form.email',    ['name', 'value', 'attributes']);
        Form::component('xfile',        'components.form.file',     ['name', 'attributes']);
        Form::component('xcheckbox',    'components.form.checkbox', ['name', 'value', 'checked', 'attributes']);
        Form::component('xradio',       'components.form.radio',    ['name', 'value', 'checked', 'attributes']);
        Form::component('xdate',        'components.form.date',     ['name', 'value', 'attributes']);
        Form::component('xselect',      'components.form.select',   ['name', 'value', 'default', 'attributes']);
        Form::component('xsubmit',      'components.form.submit',   ['value', 'attributes']);
        Form::component('xbutton',      'components.form.button',   ['value', 'attributes']);
        Form::component('xlabel',       'components.form.label',    ['name', 'value', 'attributes', 'escape']);

        Form::component('xopen',                'components.form.open',             ['options']);
        Form::component('xformgroup',           'components.form.group',            []);
        Form::component('xcloseformgroup',      'components.form.close-group',      []);
        Form::component('xbuttonGroup',         'components.form.buttonGroup',      ['buttons']);
        Form::component('xmodal',               'components.modal',                 ['id', 'title', 'body', 'buttons']);


        /**
         * Add character data to the views
         */
        view()->composer('*', function ($view)
        {
            $view->with('char', app('character'));
        });

        view()->composer('layouts/admin/*', function($view)
        {
            $view->with('global_modules', app('modules'));
        });


        // Add hook views namespace so hooks can load views via hook:: prefix
        view()->addNamespace('hook', hook_path());

        /**
         * Allows for easy hook execution in blade
         *
         * @use @hook($location)
         */
        Blade::directive('hook', function($expression)
        {
            return "<?php echo hook()->run($expression); ?>";
        });

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
