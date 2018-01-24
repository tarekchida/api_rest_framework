# api_rest_framework

A simple Rest Api framework for building REST api in PHP. It's free and [open-source](LICENSE).
The framework provides Json response with (status, message and data).  

## HOW TO :  

### Steps:  
-	Unzip the archive / clone the repository    
-	Copy the api_rest_framework folder in your web folder (exp /var/www/html/)     
-	Create a Vhost that point to the **/public** folder      
-       Under the root folder use the terminal to run : 
  
```php
composer dump-autoload -o
```


### Configuration

Open the [App/Config.php](App/Config.php) file and add your database config : 

```php
    const DB_HOST = '127.0.0.1';
    const DB_NAME = 'dbname';
    const DB_USER = 'username';
    const DB_PASSWORD = 'password'; 
```

### Routes

Open the [App/Routes.php](App/Routes.php) file, you can add GET or POST routes by folloing this exampls : 


```php
//Hello World
$router->get('/', 'IndexController#home');

//Get user by id
$router->get('/get-user', 'UsersController#get');

//Add youser
$router->post('/add-user', 'UsersController#add');

```

### Models

Under the folder [App/Models](App/Models) you can add Model classes 
New Models need to extends the BaseModel Class [Core/BaseModel.php](Core/BaseModel.php). 
Also create static function for simple acces from Controller : 

```php
$user = User::find($id)

```
### Controllers
Under the folder [App/Controllers](App/Controllers) add your contorllers classes. 
New Controllor need to extends the BaseController Class [Core/BaseController.php](Core/BaseController.php). 

### Error / Exception Handler
The framwework can handle Errors and exception and wirte on log file under the log folder
