<?php
/*
 * PHPHandles.php
 * 	A Server-Side execution wrapper for Handlebars.js
 * 
 * Copyright (c) 2012 Cody Mays <www.codymays.net>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a 
 * copy of this software and associated documentation files (the "Software"), 
 * to deal in the Software without restriction, including without limitation 
 * the rights to use, copy, modify, merge, publish, distribute, sublicense, 
 * and/or sell copies of the Software, and to permit persons to whom the 
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in 
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR 
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, 
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL 
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER 
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING 
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER 
 * DEALINGS IN THE SOFTWARE.
 */


namespace PHPHandles 
{
	class PHPHandles 
	{
		private $v8;
		private $TemplateContext;
		
		/*
		 * __construct()
		 * Parameters: Takes the location of the handlebars.js file
		 */
		public function __construct($handlebarsLocation)
		{
			$this->v8 = new \v8Js();

			$handlebars = @file_get_contents($handlebarsLocation);
			if($handlebars)
			{
				$this->v8->executeString($handlebars);
			}
			else
			{
				throw new \Exception('The handlebars.js location passed to the PHPHandles constructor was invalid or inaccessible.');
			}
		}
		
		/*
		 * SetVarsRaw()
		 * Parameters: Takes a string of JS to establish template vars
		 */
		public function SetVarsRaw($string)
		{
			if(!is_string($string))
			{
				throw new \Exception('setTemplateVarsRaw() requires a string parameter');
			}
			
			$this->TemplateContext = $string;
			
			return $this;
		}
		
		/*
		 * SetVarsArray()
		 * Parameters: Takes an associative array of values and converts
		 *	       them to template vars
		 */
		public function SetVarsArr($arr)
		{
			if(!is_array($arr))
			{
				throw new \Exception('Parameter passed to setTemplateVarsArray() is not an array');
			}
			
			$this->TemplateContext = json_encode($arr);
			
			return $this;
		}
		
		/*
		 * ProcessString()
		 * Parameters: String of data to execute as a template in
		 *             Handlebars.js
		 */
		public function ProcessString($string)
		{
			$js = "var template = Handlebars.compile('".$string."'); 
				var context = ".$this->TemplateContext.";
				template(context);";
			$out = $this->v8->executeString($js);
			
			return $out;
		}
		
		/* 
		 * ProcessFile()
		 * Parameters: String to the template file to execute
		 */
		public function ProcessFile($file)
		{
			$tpl = @file_get_contents($file);

			if(!$tpl)
			{
				throw new \Exception('The file location passed to ProcessFile() is invalid or inaccessible.');
			}
			
			/* For those curious, file comes in as multi-line string. JS does not like that, fix this */
			return $this->ProcessString(str_replace("\n", '', $tpl)); 
		}
	}
}

?>