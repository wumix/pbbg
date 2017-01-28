<?php
namespace Medusa\App\Http\Controllers\Admin;

use Medusa\App\Modules;
use File;

class ModulesController extends AdminController {


    public function index()
    {

        $availableModules = Modules::all();

        foreach($availableModules as $module)
        {
            $path = module_path($module->directory)  . DIRECTORY_SEPARATOR .'info.json';
            $file = json_decode(File::get($path));
            $module->meta = $file;
        }

        $uninstalled = File::directories(module_path());
        $modules = collect();

        foreach($uninstalled as $file)
        {
            $name = explode(module_path(), $file);
            $name = str_replace('\\', '', $name);
            $filePath = $file . '/info.json';
            $info = File::exists($filePath);

            if($info && ($availableModules->where('directory', '=', $name)->first() === null))
            {
                $info = json_decode(File::get($filePath));
                $modules->modules[] = collect($info);
            }

        }

        return view('admin.modules.index', [
            'a_modules' =>  $availableModules,
            'u_modules' =>  $modules
        ]);
    }

    public function install($name)
    {
        $rawName = $name;
        $name = studly_case($name);
        $infoFilePath = module_path($name) . DIRECTORY_SEPARATOR . 'info.json';
        $info = json_decode(File::get($infoFilePath));

        $module = new Modules();
        $module->name = $rawName;
        $module->directory = $name;
        $module->enabled = false;
        $module->icon = $info->navigation->icon;
        $module->save();

        session()->flash('success', $rawName . ' has been installed, you can now configure it below');

        return redirect()->route('admin.modules.settings', ['id'=>$module->id]);
    }

    public function settings($id)
    {
        $module = Modules::find($id);

        $controller = 'Medusa\\Modules\\' . $module->directory . '\\Controllers\\' . $module->directory . 'Controller';

        if(class_exists($controller))
        {
            $class = new $controller();
            return $class->settings();
        }
    }

}