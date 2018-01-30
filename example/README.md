# Song playlist Api 

I created a simple Rest Api app that processes the following use cases:   

-   Get user data by user Id 
-   Get song data by song Id 
-   Get user playlist 
-   Add song to playlist 
-   Remove song from playlist 

The app response in a Json format 

```json
{
  "message": "message",
  "status": 200,
  "data": [
    {
      "name": "name",
      "id": 6,
      "email": "email",
      "token": "token"
    }
  ]
}
```



## HOW TO :  

### Requirement:    
-	Apache Server (LAMP, LEMP…)     
-	Php version superior or equal to 7.1  
-       composer 
-	Browser (Chrome/ Firefox/IE11)      

### Steps:  
-	Unzip the archive / clone the repository
-	Copy the api_rest_player folder in your web folder (exp /var/www/html/)
-	Create a Vhost that point to the **/public** folder
-	Under the root folder use the terminal to run
  
```
composer install
```
This will create Vendor folder and load unit testing dependancies. 
Then run  
  
```
composer dump-autoload -o
```
This commande will generate the autoload file. 

-	 The database sql is under the **/sql** folder  [sql/dz.sql](sql/dz.sql)

### Configuration

Open the [App/Config.php](App/Config.php) file and add your database config : 

```php
    const DB_HOST = '127.0.0.1';
    const DB_NAME = 'dz';
    const DB_USER = 'username';
    const DB_PASSWORD = 'password'; 
```

### Routes

Open the [App/Routes.php](App/Routes.php) file, you can add GET or POST routes by folloing this examples : 


```php
//Example
$router->get([Route_Url], [Controller]#[Action]); 
...

```

### Models
Models need to extends the BaseModel Class [Lib/BaseModel.php](Lib/BaseModel.php).
Static function for simple acces from the Controllers :

```php
$user = User::find($id);

```
### Controllers
Controllors need to extends the BaseController Class [Lib/BaseController.php](Lib/BaseController.php).

### Error / Exception Handler
The app handle Errors and Exceptions and wirte them to a log file under the log folder

### Swagger 
I added the Api doc tool  **Swagger**  under the  [public/api-doc](public/api-doc) folder. 
You can access the api doc with the Url : http://[appUrl]/api-odc/ 

 