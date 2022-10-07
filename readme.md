# Installation
1. git clone https://github.com/aannn123/Chart.git
2. run composer install
3. change config in application/config/database.php

    'hostname' => 'localhost',<br/>
	'username' => 'your_username',<br/>
	'password' => 'your_password',<br/>
	'database' => 'your_password',<br/>
	
4. change $config['base_url'] if you not run application using php -S localhost:8888
5. run application
6. to access the page chart product, go to route /product
