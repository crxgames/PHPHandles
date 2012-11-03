
PHPHandles
=============

PHPHandles is a wrapper that allows for the execution of [Handlebars.js](https://github.com/wycats/handlebars.js/) on the server-side. This allows you to use the full functionality of Handlebars.js as a template engine for your site, while also using the same templates on the front end.


Usage
-----
Usage of PHPHandles is easy! Just include PHPHandles.php and you're set. Everything needed is in the PHPHandles namespace.

```php
include('PHPHandles.php');
	
$PHPHandles = new PHPHandles\PHPHandles('./handlebars.js');
$tplVars = array(
	'title' => 'My post',
	'body' => 'This is some body text!'
);
echo $PHPHandles->SetVarsArr($tplVars)->ProcessFile('./TemplateTest.html');
```