I like Rails, realy like! But sometimes at work I should develop with php. But I don't want!!! :) This is the reason I started to develop this framework. We can not say that it has some structure, but looking closer, you may notice that it is very similar to the Rails! It's obvious that I was not able to develop a good framework alone, so I'll be glad esly you help me in this!

Now there is a router that works in both rails, activerecord for php, haml, jade, less, coffeescript, migrations tools. Now we need all these components together into a single system.

#Template Engines
	- Jade - https://github.com/everzet/jade.php
	- Haml - https://github.com/wilkerlucio/limber-haml

#ROUTING
	- https://github.com/dannyvankooten/PHP-Router/

#ASSETS
	- CSS
	- LESS - https://github.com/leafo/lessphp
	- JAVASCRIPT
	- COFFEESCRIPT - https://github.com/alxlit/coffeescript-php/

#MODELS
	see this:
	-PHP-ACTIVERECORD - https://github.com/kla/php-activerecord/

#MIGRATIONS
	For create migration use:

	$ php generate.php SomeMigration

	For apply migration use:

	$ php migrate.php db:setup (once)
	$ php migrate.php db:migrate (after every migration)

#NGINX SETTINGS

	server {
	    listen 80;
	    server_name localhost;
	    root /your/trailer/root/public;
	    index /index.php;
	 
	    location / {
	        if (!-f $request_filename) {
	            rewrite ^(.*)$ /index.php?q=$1 last;
	            break;
	        }
	    }
	 
	    location ~* ^.+.(css|js|jpeg|jpg|gif|png|ico) {
	        expires 30d;
	    }
	 
	    location ~ .(php|phtml)$ {
	        fastcgi_pass 127.0.0.1:9000;
	        fastcgi_index /index.php;
	        fastcgi_param SCRIPT_FILENAME /your/trailer/root/$fastcgi_script_name;
	 
	        include fastcgi_params;
	    }
	}

#Logging
	- Log::info(message[,environment])
	- Log::warn(message[,environment])
	- Log::error(message[,environment])

	Environment may be development, production or test. if u 