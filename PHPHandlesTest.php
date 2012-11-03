<?php
/*
 * PHPHandlesTest.php
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
include('PHPHandles.php');
	
$PHPHandles = new PHPHandles\PHPHandles('./handlebars.js');
$tplVars = array(
	'title' => 'My post',
	'body' => 'This is some body text!'
);
echo $PHPHandles->SetVarsArr($tplVars)->ProcessFile('./TemplateTest.html');

/* Alternatively: 
$PHPHandles->setVarsRaw('{title: "My New Post", body: "This is my first post!"}');
echo $PHPHandles->ProcessString("<div class=\"entry\"><h1>{{title}}</h1><div class=\"body\">{{body}}</div></div>");
*/
?>