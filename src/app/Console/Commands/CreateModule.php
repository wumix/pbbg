<?php

namespace Medusa\App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CreateModule extends Command
{

    use \Illuminate\Console\AppNamespaceDetectorTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'x:module {module?} {author?} {version=0.1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new game module';

    /**
     * Name of the module
     *
     * @var string
     */
    private $module;

    /**
     * Author Name
     *
     * @var string
     */
    private $author;

    /**
     * Version number of the module
     *
     * @var float
     */
    private $version;

    private $requires_controller;

    private $requires_model;

    private $requires_migrations;

    private $requires_views;

    private $table;

    private $ns;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->module = ucfirst($this->argument('module'));
        $this->author = $this->argument('author');
        $this->version = (float) $this->argument('version');

        $correct = false;

        if(empty($this->module) || empty($this->author) || empty($this->version))
            $correct = $this->askQuestions(true);

        if(is_dir($this->getFullModulePath()))
        {
            $this->info('Module already exists');
            return;
        }

        $this->ns = "Medusa\\Modules\\" . ucfirst($this->module);

        if($correct)
        {
            $this->info('Your module is being created');

            $this->table = str_replace([
                ' ',
                '-'
            ], [
                '_',
                '_',
            ], $this->getModuleName());

            $this->table = strtolower($this->table);

            $this->createModule();
            $this->info("{$this->module} has been created");
        }

    }

    /**
     * Asks the questions
     *
     * @return bool
     */
    private function askQuestions($askAll = false)
    {

        if(!$askAll)
            $this->info('Is the following information correct?');

        $correct = false;

        do {

            if(!$correct)
                $this->displayQuestions();

            if(!empty($this->module) && !empty($this->author) && !empty($this->version))
                $askAll = false;

            if(!$askAll)
            {
                $this->displayAnswers();
                $correct = $this->confirm('Correct?');
            }


        }while(!$correct);


        return true;

    }

    /**
     * Displays a set of questions
     */
    private function displayAnswers()
    {
        $this->info("The Module Name is: {$this->module}");
        $this->info("The Author is: {$this->author}");
        $this->info("The build version is: {$this->version}");
    }

    /**
     * Shows a set of questions
     */
    private function displayQuestions()
    {
        $this->module = ucfirst($this->ask('What is the module name?', $this->module));
        $this->author = $this->ask('Who is the author?', $this->author);
        $this->version = $this->ask('What is the build version?', $this->version);
    }

    private function createModule()
    {
        // First let's grab the files

        $controllerDir  = $this->modulePath() . 'controllers';
        $modelDir       = $this->modulePath() . 'models';
        $providerDir    = $this->modulePath() . 'providers';
        $databaseDir    = $this->modulePath() . 'database';
        $migrationDir   = $this->modulePath() . 'database/migrations';
        $seedDir        = $this->modulePath() . 'database/seeds';

        // If module doesn't exist
        if(!is_dir($this->getFullModulePath()))
        {
            // Make the directories
            File::makeDirectory($this->modulePath());
            File::makeDirectory($controllerDir);
            File::makeDirectory($modelDir);
            File::makeDirectory($databaseDir);
            File::makeDirectory($migrationDir);
            File::makeDirectory($providerDir);
            File::makeDirectory($seedDir);

            $this->info('Directories are built');


            // Create the controller
            $this->buildController();

            // And the model
            $this->buildModel();

            // And the migration
            $this->buildMigration();

            // And the views
            $this->buildView();

            // And the provider
            $this->buildProvider();

            // And the config
            $this->buildConfig();

            // Add the routes
            $this->buildRoutes();

            // Add the info.json
            $this->buildInfo();
        }
    }

    private function getFullModulePath()
    {
        return base_path($this->modulePath());
    }

    private function modulePath()
    {
        return 'medusa/modules/' . $this->module . '/';
    }

    private function replaceDefaults($file)
    {
        $file = str_replace('{{rootNamespace}}', $this->getAppNamespace(), $file);

        return $file;
    }

    /**
     * Build the main controller for the module
     */
    private function buildController()
    {
        $file = File::get(resource_path('stubs/controller.stub.php'));

        $file = $this->replaceDefaults($file);

        $file = str_replace([
            '{{class}}',
            '{{namespace}}',
            '{{lcmodulename}}'
        ], [
            $this->getModuleName() . 'Controller',
            $this->ns . '\\Controllers',
            strtolower($this->getModuleName())
        ], $file);

        File::put($this->getFileName('Controller'), $file);
    }

    /**
     * @todo build models
     *
     */
    private function buildModel()
    {
        $file = File::get(resource_path('stubs/model.stub.php'));
        $file = $this->replaceDefaults($file);

        $file = str_replace([
            '{{class}}',
            '{{namespace}}',
            '{{table}}'
        ], [
            $this->getModuleName(),
            $this->ns . '\\Models',
            $this->getTableName(),
        ], $file);

        File::put($this->getFileName('Model'), $file);
    }

    /**
     * @todo build migrations
     *
     */
    private function buildMigration()
    {
        $file = File::get(resource_path('stubs/migration.stub.php'));
        $file = str_replace([
            '{{class}}',
            '{{table}}',
        ], [
            $this->getModuleName(),
            $this->getTableName(),
            ''
        ], $file);

        File::put($this->getFileName('migrations'), $file);
    }

    /**
     * @todo build default Request class
     *
     */
    private function buildRequest()
    {

    }

    /**
     * @todo build default views
     *
     */
    private function buildView()
    {

    }

    private function buildConfig()
    {

    }

    private function buildRoutes()
    {
        File::put($this->getFullModulePath() . 'routes.php', '');
    }

    private function buildInfo()
    {
        $file = File::get(resource_path('stubs/info.stub.json'));

        $file = str_replace([
            '{{author}}',
            '{{name}}',
            '{{version}}'
        ], [
            $this->author,
            $this->module,
            $this->version
        ], $file);

        File::put($this->getFullModulePath() . 'info.json', $file);
    }

    /**
     * @todo Build a provider for each module
     *
     */
    private function buildProvider()
    {
        $file = File::get(resource_path('stubs/provider.stub.php'));

        $file = $this->replaceDefaults($file);

        $file = str_replace('{{class}}', 'ModuleProvider', $file);

        $file = str_replace('{{modulename}}', $this->getModuleName(), $file);

        $file = str_replace('{{namespace}}', $this->ns . '\\Providers', $file);

        $file = str_replace('{{lcmodulename}}', strtolower($this->getModuleName()), $file);

        File::put($this->getFileName('Provider'), $file);
    }

    private function getModuleName()
    {
        return ucfirst($this->module);
    }

    private function getTableName()
    {
        return $this->table;
    }

    private function getFileName($ext)
    {
        if($ext === 'Provider')
            return $this->getFullModulePath() . '\\Providers\\ModuleProvider.php';
        else if($ext === 'migrations')
            return $this->getFullModulePath() . '\\database\\migrations\\' . time() . '_create_table_' . strtolower($this->getModuleName()) . '.php';

        return $this->getFullModulePath() . str_plural(lcfirst($ext)) . '\\' . $this->getModuleName() . $ext . '.php';
    }
}
