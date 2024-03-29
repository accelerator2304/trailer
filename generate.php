<?php

/*
  Generator for migrations.
  Usage: php generate.php <migration name>
  Call with no arguments to see usage info.
*/

require 'settings.php';

class Generate extends DbSettings{
	function __construct(){

			$this->ruckusing_db_config = array(
			'development' => $this->DEVELOPMENT,
			'test'		  => $this->TEST,
			'production'  => $this->PRODUCTION
		);
	}

	function get_config(){
		return $this->ruckusing_db_config;
	}


}

$G = new Generate();
$ruckusing_db_config = $G->get_config();

define('RUCKUSING_DB_DIR', __DIR__ . '/db');
define('RUCKUSING_BASE', __DIR__ . '/trailer/modules/migrations' );

require RUCKUSING_BASE . '/lib/classes/util/class.Ruckusing_Logger.php';
require RUCKUSING_BASE . '/lib/classes/util/class.Ruckusing_NamingUtil.php';
require RUCKUSING_BASE . '/lib/classes/util/class.Ruckusing_MigratorUtil.php';
require RUCKUSING_BASE . '/lib/classes/class.Ruckusing_FrameworkRunner.php';

$args = parse_args($argv);
$framework = new Ruckusing_FrameworkRunner($ruckusing_db_config, null);
//input sanity check
if(!is_array($args) || (is_array($args) && !array_key_exists('name', $args)) ) {
  print_help(true);
}
$migration_name = $args['name'];

//clear any filesystem stats cache
clearstatcache();

//generate a complete migration file
$next_version = Ruckusing_MigratorUtil::generate_timestamp();
$klass = Ruckusing_NamingUtil::camelcase($migration_name);
$file_name = $next_version . '_' . $klass . '.php';
$migrations_dir = $framework->migrations_directory();

$template_str = get_template($klass);

if(!is_dir($migrations_dir)) {
  printf("\n\tMigrations directory (%s doesn't exist, attempting to create.", $migrations_dir);
  if(mkdir($migrations_dir) === FALSE) {
    printf("\n\tUnable to create migrations directory at %s, check permissions?", $migrations_dir);
  } else {
    printf("\n\tCreated OK");
  }
}

//check to make sure our destination directory is writable
if(!is_writable($migrations_dir)) {
  die_with_error("ERROR: migration directory '" . $migrations_dir . "' is not writable by the current user. Check permissions and try again.");
}

//write it out!
$full_path = $migrations_dir . '/' . $file_name;
$file_result = file_put_contents($full_path, $template_str);
if($file_result === FALSE) {
  die_with_error("Error writing to migrations directory/file. Do you have sufficient privileges?");
} else {
  echo "\n\tCreated migration: {$file_name}\n\n";
}

/*
  Parse command line arguments.
*/
function parse_args($argv) {
  $num_args = count($argv);
  if($num_args < 2) {
    print_help(true); 
  }
  $migration_name = $argv[1];
  return array('name' => $migration_name);
}


/*
  Print a usage scenario for this script.
  Optionally take a boolean on whether to immediately die or not.
*/
function print_help($exit = false) {
  echo "\nusage: php generate.php <migration name>\n\n";
  echo "\tWhere <migration name> is a descriptive name of the migration, joined with underscores.\n";
  echo "\tExamples: add_index_to_users | create_users_table | remove_pending_users\n\n";
  if($exit) { exit; }
}

function die_with_error($str) {
  die("\n{$str}\n");
}

function get_template($klass) {
$template = <<<TPL
<?php\n
class $klass extends Ruckusing_BaseMigration {\n\n\tpublic function up() {\n\n\t}//up()
\n\tpublic function down() {\n\n\t}//down()
}
?>
TPL;
return $template;
}

?>