<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;

class MakeModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make new module';

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
        $moduleName = $this->argument('name');
        
        if (!file_exists("app/Modules/$moduleName")) {
            $controllerPath = "app/Modules/$moduleName/Controllers";
            File::makeDirectory($controllerPath, $mode = 0777, true, true);
            $fileName = $moduleName.'Controller';
            $controller = @fopen("$controllerPath/$fileName.php","x");
            if($controller){
                $content = "<?php\r\nnamespace App\Modules\\$moduleName\Controllers;\r\n\r\nuse App\Http\Controllers\Controller;\r\nuse Illuminate\Http\Request;\r\n\r\nclass $fileName extends Controller{\r\n\r\n}";
                fwrite($controller,$content); 
                fclose($controller);
            }

            $modelPath = "app/Modules/$moduleName/Models";
            File::makeDirectory($modelPath, $mode = 0777, true, true);
            $fileName = $moduleName.'Model';
            $model = @fopen("$modelPath/$fileName.php","x");
            if($model){
                $content = "<?php\r\nnamespace App\Modules\\$moduleName\Models;\r\n\r\nuse Illuminate\Database\Eloquent\Model;\r\n\r\nclass $fileName extends Model{\r\n\r\n}";
                fwrite($model,$content); 
                fclose($model);
            }

            $viewPath = "app/Modules/$moduleName/Views";
            File::makeDirectory($viewPath, $mode = 0777, true, true);

            $routePath = "app/Modules/$moduleName";
            $route = @fopen($routePath."/routes.php","x");
            $moduleNameLower = \strtolower($moduleName);
            $namespace = "'App\Modules\\$moduleName\Controllers'";
            if($route){
                $content = "<?php\r\nnamespace App\Modules\\$moduleName;\r\n\r\nuse Route;
                \r\n\$namespace = $namespace;\r\n\r\nRoute::group(['prefix'=>'$moduleNameLower','namespace'=>$namespace],function(){\r\n\t//route here\r\n});";
                fwrite($route,$content); 
                fclose($route);
            }
            $this->info('Module created successfully!');
        }
        else
            $this->error('Module existed!');

    }
}
