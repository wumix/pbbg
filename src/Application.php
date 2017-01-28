<?php
namespace Medusa;

class Application extends \Illuminate\Foundation\Application {
    
    public function configPath()
    {
        return __DIR__ . DIRECTORY_SEPARATOR.'config';
    }
    
    public function databasePath()
    {
        return __DIR__.DIRECTORY_SEPARATOR.'database';
    }
    
    public function resourcePath()
    {
        return __DIR__.DIRECTORY_SEPARATOR.'resources';
    }

    public function modulePath($path)
    {
        return $this->basePath . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $path;
    }
    
    public function hookPath($path)
    {
        return $this->basePath . DIRECTORY_SEPARATOR . 'hooks' . DIRECTORY_SEPARATOR . $path;
    }

    public function isInstalled()
    {
        $file = storage_path('installed');

        return \File::exists($file);
    }

}