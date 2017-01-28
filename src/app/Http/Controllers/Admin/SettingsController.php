<?php
namespace Medusa\App\Http\Controllers\Admin;

use Medusa\App\Http\Requests\SettingsRequest;
use Medusa\App\Settings;

class SettingsController extends AdminController {

    public function __construct()
    {
        $this->name = 'settings';
    }

    public function index()
    {
        $settings = Settings::all();

        return view('admin.settings.index', compact([
            'settings'
        ]));
    }

    public function create()
    {
        return view('admin.settings.create');
    }

    public function store(SettingsRequest $settingsRequest)
    {
        Settings::create($settingsRequest->all());

        session()->flash('success', 'All done');

        return redirect()->route('admin.settings.index');
    }

    public function show()
    {
        return view('admin.settings.show');
    }

    public function edit($setting)
    {
        $setting = Settings::find($setting);

        return view('admin.settings.edit', compact([
            'setting'
        ]));
    }

    public function update(SettingsRequest $settingsRequest, $id)
    {
        $setting = Settings::find($id);
        $setting->fill($settingsRequest->all());
        $setting->save();

        session()->flash('success', 'Setting updated');

        return redirect()->route('admin.settings.index');
    }

    public function delete($id)
    {
        $setting = Settings::find($id);

        return view('admin.settings.delete', compact([
            'setting'
        ]));
    }

    public function destroy($id)
    {

        Settings::find($id)->delete();

        session()->flash('success', 'That item has been deleted');

        return redirect()
            ->route('admin.settings.index');
    }


}