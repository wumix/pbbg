<?php
namespace Medusa;

use Medusa\App\Hooks;

class HookContainer {

    /**
     * Object container all hooks that are enabled
     *
     * @var array
     */
    private $hooks;

    public function __construct()
    {

        // Get all the hooks and store them
        $this->hooks = Hooks::enabled();
    }


    public function run($location, ...$args)
    {

        $this->execute('hook_before', $args);
        $this->execute($location, $args);
        $this->execute('hook_after', $args);

    }

    public function execute($location, ...$args)
    {

        // Get hooks based on the location
        $hooks = $this->hooks;

        logDebug("Hook Location: {$location}");
        

        if(count($hooks) > 0) {
            // Loop through and execute each one
            foreach ($hooks as $hook) {
                foreach($hook->locations as $loc)
                {
                    if($loc->location !== $location)
                        continue;

                    $className = $loc->namespace;

                    // Find the class
                    $class = new $className(...$args);

                    // Add some friendly debug
                    logDebug([
                        "hook"=>[
                            "name"      =>  $hook->name,
                            "class"     =>  $className,
                            "location"  =>  $location,
                            "args"      =>  $args
                        ]
                    ], 'hooks');
                    $func = $loc->method;

                    // Allow the plugin to return a view or text or whatever
                    echo $class->$func();
                }


            }
        }
    }

}