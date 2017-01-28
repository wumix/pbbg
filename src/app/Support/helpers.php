<?php
if(!function_exists('uri_contains'))
{
    function uri_contains($string)
    {
        if(str_contains(request()->server('REQUEST_URI'), $string))
            return true;

        return false;
    }
}
if(!function_exists('uri_is'))
{
    function uri_is($string)
    {
        return request()->is($string);
    }
}
if(!function_exists('carbon_humans'))
{
    function carbon_humans($time, $emptyString = 'Never')
    {

        if($time === "0000-00-00 00:00:00" || $time === null)
            return $emptyString;

        return \Carbon\Carbon::parse($time)->diffForHumans();
    }
}
if(!function_exists('get_permission_icon'))
{
    function get_permission_icon($name)
    {
        $name = explode('.', $name);

        switch(end($name))
        {
            case 'create':
                return 'plus';
            case 'read':
                return 'search';
            case 'update':
                return 'pencil';
            case 'update_all':
                return 'pencil text-danger';
            case 'delete':
                return 'times';
            case 'delete_all':
                return 'times text-danger';
            case 'rate':
                return 'star';
            case 'access_offline':
                return 'power-off';
            default:
                return end($name);
        }
    }
}
if(!function_exists('user'))
{
    function user()
    {
        return auth()->user();
    }
}

if(!function_exists('role_setting'))
{
    function role_setting($key)
    {
        return \App\Role::setting($key);
    }
}

if(!function_exists('widget_setting'))
{
    /**
     * Checks to see if the widget is using system variables before returning the setting
     *
     * @param $widget
     * @param $key
     * @return mixed
     */
    function widget_setting($widget, $key)
    {

        $settings = $widget->settings->where('name', $key)->first();

        $systemVar = config('settings')->$key;

        $isUsingSystemVars = $settings->use_system;

        $value = $settings->value;

        if($isUsingSystemVars)
            return $systemVar;

        return $value;
    }
}

if(!function_exists('alert'))
{
    /**
     * Helper to quickly flash an alert to the frontend
     *
     * @param $message
     */
    function alert($message)
    {
        session()->flash('alert-success', $message);
    }
}

if(!function_exists('moderation_status'))
{
    /**
     * Helper to quickly flash an alert to the frontend
     *
     * @param $message
     */
    function moderation_status($status)
    {
        switch($status)
        {
            case 0:
                return 'Pending';
            case 1:
                return 'Approved';
            case 2:
                return 'Rejected';
            case 3:
                return 'Postponed';
        }
    }
}

if(!function_exists('alert_warning'))
{
    /**
     * Helper to quickly flash an alert to the frontend
     *
     * @param $message
     */
    function alert_warning($message)
    {
        session()->flash('alert-warning', $message);
    }
}

if(!function_exists('css'))
{
    /**
     * Helper function to grab the css value from the settings
     *
     * @param $value
     * @return mixed
     */
    function css($value)
    {
        echo (config('settings')->css($value));
//        exit;
    }
}

if(!function_exists('isLoggedIn'))
{
    /**
     * Check if user has logged in
     *
     * @return bool
     */
    function isLoggedIn()
    {
        if(user() !== null)
            return true;

        return false;
    }
}

if(!function_exists('cid'))
{
    /**
     * The current characters id
     *
     * @return mixed
     */
    function cid()
    {
        return session('cid');
    }
}

if(!function_exists('is_ajax'))
{
    function is_ajax()
    {
        return app('request')->ajax();
    }
}
if (! function_exists('pd')) {
    /**
     * Pretty dump the passed variables.
     *
     * @param  mixed
     * @return void
     */
    function pd()
    {
        array_map(function ($x) {
            (new \Illuminate\Support\Debug\Dumper)->dump($x);
        }, func_get_args());
    }
}

if(!function_exists('hook'))
{
    /**
     * Helper function to return the HookContainer instance
     *
     * @return \Illuminate\Foundation\Application|mixed
     */
    function hook()
    {
        return app('HookContainer');
    }
}

if(!function_exists('logDebug'))
{
    /**
     * Logs a message in the debugbar
     *
     * @param mixed $message The message to add into the DebugBar
     * @param string $name The tab of the DebugBar to post the message in
     * @param string $type The type of message, any value can be given, however 'error' and 'warning' are both styled to stand out
     */
    function logDebug($message, $name = 'hooks', $type = 'info')
    {
        app('debugbar')[$name]->addMessage($message, $type);
    }
}

if(!function_exists('module_path'))
{
    function module_path($path = '')
    {
        return app()->modulePath($path);
    }
}

if(!function_exists('hook_path'))
{
    function hook_path($path = '')
    {
        return app()->hookPath($path);
    }
}

if(!function_exists('uri_is_route'))
{
    function uri_is_route($route, $params = [])
    {
        if(request()->getUri() === route($route, $params))
            return true;
        
        return false;
    }
}