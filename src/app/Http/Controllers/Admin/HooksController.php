<?php
namespace Medusa\App\Http\Controllers\Admin;

use Medusa\App\HookLocations;
use Medusa\App\Hooks;
use File;

class HooksController extends AdminController {

    public function __construct()
    {
        $this->name = 'hooks';
    }

    public function index()
    {

        $availableHooks = Hooks::all();

        foreach($availableHooks as $hook)
        {
            $file = hook_path($hook->directory) . DIRECTORY_SEPARATOR . 'info.json';
            $file = json_decode(File::get($file));
            $hook->meta = $file;
        }

        $uninstalled = File::directories(hook_path());
        $hooks = collect();

        foreach($uninstalled as $file)
        {
            $name = explode(hook_path() , $file)[1];
            $name = str_replace('\\', '', $name);
            $filePath = $file . '/info.json';
            $info = File::exists($filePath);

            if($info && ($availableHooks->where('directory', '=', $name)->first() === null))
            {
                $info = json_decode(File::get($filePath));
                $hooks->hooks[] = collect($info);
            }

        }

        
        return view('admin.hooks.index', [
            'a_hooks' =>  $availableHooks,
            'u_hooks' =>  $hooks
        ]);
    }

    public function install($name)
    {
        session()->flash('success', 'Hook installed');

        $path = hook_path(studly_case($name) . '\\info.json');
        $info = json_decode(File::get($path));

        $hook_locations = $info->hooks;

        $hook = new Hooks();
        $hook->name = $name;
        $hook->directory = studly_case($name);
        $hook->enabled = 1;
        $hook->save();

        foreach($hook_locations as $k=>$v)
        {
            $modal = new HookLocations();
            $modal->hook_id     = $hook->id;
            $modal->location    = $k;
            $modal->namespace   = $v[0];
            $modal->method      = $v[1];
            $modal->save();
        }

        return redirect()->route('admin.hooks.index');
    }

    public function settings($id)
    {
        $hook = Hooks::find($id);
        $path = hook_path($hook->directory);

        $name = '\Medusa\Hooks\\' . $hook->directory . '\\' . $hook->directory;

        $class = new $name;

        if(method_exists($class, 'settings'))
            return $class->settings();

        session()->flash('success', 'That plugin has no specific settings');
        return redirect()->route('admin.hooks.index');
    }

    public function remove()
    {
//        dd('dead');
//        session()->flash('success', 'Hook has been removed');
        return redirect()->route('admin.hooks.index');
    }

    public function disable($id)
    {
        $hook = Hooks::find($id)->delete();
        session()->flash('success', 'Hook has been disabled');
        return redirect()->route('admin.hooks.index');
    }

}