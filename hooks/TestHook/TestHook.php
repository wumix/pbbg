<?php
namespace Medusa\Hooks\TestHook;

use Medusa\App\Http\Controllers\BaseHook;

class TestHook extends BaseHook {

    private $args;

    public function __construct(...$args)
    {
        $this->args = $args;
    }

    public function run()
    {
        echo 'Second Hook';
    }

    public function install()
    {

    }

    public function uninstall(... $args)
    {

    }

    public function activate()
    {

    }

    public function deactivate()
    {

    }

}