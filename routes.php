<?php

$router = new Router();

$router->setBasePath('');


$router->map('/', 'SuplierController#index', array('methods' => 'GET'));
$router->map('/users/:format', 'SuplierController:index', array('methods' => 'GET'));

$router->map('/users/:format','SuplierController#index', array('methods' => 'POST', 'name' => 'users_create'));
$router->map('/users/:id/edit.:format', 'SuplierController#index', array('methods' => 'GET', 'name' => 'users_edit', 'filters' => array('id' => '(\d+)')));
$router->map('/contact/:format',array('controller' => 'someController', 'action' => 'contactAction'), array('name' => 'contact'));

//$router->map('/blog/:slug', array('c' => 'BlogController', 'a' => 'showAction'));
// capture rest of URL in "path" parameter (including forward slashes)
// $router->map('/site-section/:path','some#target',array( 'filters' => array( 'path' => '(.*)') ) );

/*
<h3>Try out these URL's.</h3>
<p><a href="<?php echo $router->generate('users_edit', array('id' => 5)); ?>"><?php echo $router->generate('users_edit', array('id' => 5)); ?></a></p>
<p><a href="<?php echo $router->generate('contact'); ?>"><?php echo $router->generate('contact'); ?></a></p>
<p><form action="" method="POST"><input type="submit" value="Post request to current URL" /></form></p>
<p><form action="<?php echo $router->generate('users_create'); ?>" method="POST"><input type="submit" value="POST request to <?php echo $router->generate('users_create'); ?>" /></form></p>
<p><a href="<?php echo $router->generate('users_list'); ?>">GET request to <?php echo $router->generate('users_list'); ?></p>'
*/

$route = $router->matchCurrentRequest();
 
 if($route) { 
	T::exec($route->getTarget(),$route->getParameters());

 } else { ?>
	<pre>No route matched.</pre>
<?php } ?>


