<?php
namespace Medusa\Hooks\SampleHook;

use Medusa\App\Http\Controllers\BaseHook;

class SampleHook extends BaseHook {

    private $args;

    /**
     * Setup any args that are passed through
     *
     * SampleHook constructor.
     * @param array ...$args
     */
    public function __construct(...$args)
    {
        $this->args = $args;
    }

    /**
     * What happens when the hook runs
     */
    public function run()
    {
        return view('hook::SampleHook/views/test');
    }
    
    public function first()
    {
        return view('hook::SampleHook/views/test2');
    }

    /**
     * Install the hook
     */
    public function install()
    {

    }

    /**
     * This is called when it needs uninstalling
     *
     * @param array ...$args
     */
    public function uninstall(... $args)
    {

    }

    /**
     * This is called when you activate the plugin
     */
    public function activate()
    {

    }

    /**
     * This is called when you deactivate the plugin
     */
    public function deactivate()
    {

    }

    /**
     * Settings page
     */
    public function settings()
    {
        return view('hook::SampleHook/views/settings');
    }

    /**
     * When settings are updated this method is called
     */
    public function updateSettings()
    {

    }

}