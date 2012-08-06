<?php


class TemplateAdapter{
	public static function render($template){


				require_once (__DIR__.'/../modules/jade/Jade.php');
				require_once (__DIR__.'/../modules/jade/lib/Parser.php');
				require_once (__DIR__.'/../modules/jade/lib/Dumper.php');
				require_once (__DIR__.'/../modules/jade/lib/Lexer.php');
				require_once (__DIR__.'/../modules/jade/lib/node/Node.php');
				require_once (__DIR__.'/../modules/jade/lib/node/DoctypeNode.php');
				require_once (__DIR__.'/../modules/jade/lib/node/FilterNode.php');
				require_once (__DIR__.'/../modules/jade/lib/node/BlockNode.php');
				require_once (__DIR__.'/../modules/jade/lib/node/TagNode.php');
				require_once (__DIR__.'/../modules/jade/lib/node/TextNode.php');
				require_once (__DIR__.'/../modules/jade/lib/node/CodeNode.php');

			    $parser = new lib\Parser(new lib\Lexer());
			    $dumper = new lib\Dumper();

			    $jade = new Jade($parser, $dumper);

			    
			    return $jade->render($template);
	}
}
?>