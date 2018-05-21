- Make new Module: php artisan make:module {ModuleName}
  + Ex: make module Admin: php artisan make:module Admin
- Make new Conntroler by Module: php artisan make:modulecontroller {ModuleName} {ControllerName}
  + Ex: make NewController for module Admin: php artisan make:modulecontroller Admin NewController
- Call view by: view('ModuleName::ViewName')
  + Ex: view("Admin::home")