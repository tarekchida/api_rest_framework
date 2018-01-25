# Api Rest Framework (ARF)

A simple Rest Api framework for building REST api in PHP. It's free and [open-source](LICENSE).
The framework provides Json response with (status, message and data).  

```json
{
"status" : 200, 
"message" : "User added successfully"
"data" : {
        "user_id" : 2341
        }
}
```

## HOW TO :  

### Steps:  
-	Unzip the archive / clone the repository    
-	Copy the api_rest_framework folder in your web folder (exp /var/www/html/)     
-	Create a Vhost that point to the **/public** folder
-       Under the root folder use the terminal to run   
  
```
composer dump-autoload -o
```
This commande will create Vendor folder and generate the autoload file. 

### Configuration

Open the [App/Config.php](App/Config.php) file and add your database config : 

```php
    const DB_HOST = '127.0.0.1';
    const DB_NAME = 'dbname';
    const DB_USER = 'username';
    const DB_PASSWORD = 'password'; 
```

### Routes

Open the [App/Routes.php](App/Routes.php) file, you can add GET or POST routes by folloing this examples : 


```php
//Example
$router->get([Route_Url], [Controller]#[Action]);

//Hello World
$router->get('/', 'IndexController#home');

//Get user by id
$router->get('/get-user', 'UsersController#get');

//Add user
$router->post('/add-user', 'UsersController#add');

...

```

### Models

Under the folder [App/Models](App/Models) you can add Model classes.        
New Models need to extend the BaseModel Class [Lib/BaseModel.php](Lib/BaseModel.php).    
Also create static functions for simple acces from Controllers : 

```php
$user = User::find($id);

```
### Controllers
Under the folder [App/Controllers](App/Controllers) add your Contorller classes.     
New Controllors need to extend the BaseController Class [Lib/BaseController.php](Lib/BaseController.php).       

### Error / Exception Handler
The framwework handle Errors and Exceptions and wirte them to a yyyy-mm-dd.log file under the log folder
