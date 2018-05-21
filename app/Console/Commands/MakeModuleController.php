<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeModuleController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:modulecontroller {module} {controller}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'make controller by module';

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
        $moduleName = $this->argument('module');
        $controllerName = $this->argument('controller');
        
        
        if (file_exists("app/Modules/$moduleName")) {
            $controllerPath = "app/Modules/$moduleName/Controllers";
            if (!file_exists("$controllerPath/$controllerName.php")){
                $controller = @fopen("$controllerPath/$controllerName.php","x");
                if($controller){
                    $content = "<?php\r\nnamespace App\Modules\\$moduleName\Controllers;\r\n\r\nuse App\Http\Controllers\Controller;\r\nuse Illuminate\Http\Request;\r\n\r\nclass $controllerName extends Controller{\r\n\r\n}";
                    fwrite($controller,$content); 
                    fclose($controller);
                }
                $this->info('Controller created successfully!');
            }
            else {
              $this->error('Controller existed!');                
            }
        }
        else{ 
            $this->error("Can not find module moduleName!");
        }
    }
}
