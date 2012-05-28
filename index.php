<?php

$title = "PHP Script for BaseURL Class";

include('../../www.kalebklein.com/assets/geshi.php');
include('./class.BaseURL.php');

$file_name = './class.BaseURL.php';
$handle = fopen($file_name, 'r');
$file = fread($handle, filesize($file_name));
fclose($handle);
$code = new GeSHi($file, 'php');
$code->set_header_type(GESHI_HEADER_DIV);
$code->enable_line_numbers(true);
$code->enable_keyword_links(false);
$code->set_overall_class('codeBlock phpCode');


$use_code = "<?php
include('./path/to/class.BaseURL.php');
\$url = new BaseURL;
?>

<a href=\"<?php \$url->generate_url(); ?>\">Go to home page</a> | <a href=\"<?php \$url->generate_url();
\$url->generate_uri(\$BOOLEAN[TRUE/FALSE]); ?>/path/to/file/executed\">Page
2</a>";
$use = new GeSHi($use_code, 'php');
$use->set_header_type(GESHI_HEADER_DIV);
$use->enable_line_numbers(true);
$use->enable_keyword_links(false);
$use->set_overall_class('codeBlock useCode');

$url = new BaseURL;

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?=$title?></title>
<link rel="stylesheet" type="text/css" href="modal.css">
<!--[if IE]>
	<link rel="stylesheet" type="text/css" href="./css/modal_ie.css">
<![endif]-->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="modal.js"></script>
<script type="text/javascript">
$(function() {
    $(".use").click(function() {
        $(".useCode").slideToggle();
    });
    $(".php").click(function() {
        $(".phpCode").slideToggle();
    });
});
</script>
<style type="text/css">
.codeBlock {
	background: #F4F7F8;
	border: 1px solid #0D8EFF;
	color: #000;
	padding: 5px;
	font-family: Consolas;
	font-size: 12px;
	display: none;
}
.showToggle {
    background: #F4F7F8;
	border: 1px solid #0D8EFF;
	color: #000;
	padding: 5px;
	font-family: Consolas;
	font-size: 16px;
	cursor: pointer;
	margin-bottom: -1px;
}
</style>
</head>
<body>
<h1><?=$title?></h1>
<? //die("Broken Script...Fixing...") ?>
<? //die("Updating..please refresh every so often!") ?>
<p>For a project I'm working on, a base URL is needed for my install scripts for inserting in my installation configuration.<br>
But, in figuring out just how to go about doing this, I created a seperate class to handle this for me, and being the nice<br>
guy I am, I am making this available for everyone to see and learn from. :D I'm so nice aren't I? So here ya'll go!</p>
<hr>
<a href="#" name="modal">Changelog</a>
<div name="modal" title="BaseURL Changelog"><?php include 'changelog.htm'; ?></div>
<hr>
<strong>Example Base URL</strong><br>
<a href="<?=$url->generate_url()?>"><?=$url->generate_url()?></a> | TRUE: <a href="<? $url->generate_url(); $url->generate_uri(true); ?>"><? $url->generate_url(); $url->generate_uri(true); ?></a> | FALSE: <a href="<? $url->generate_url(); $url->generate_uri(); ?>"><? $url->generate_url(); $url->generate_uri(); ?></a>
<hr>
<strong>Obtaining BaseURL</strong>
<a href="https://github.com/pazuzu156/BaseURL" target="_blank">Github</a> | <strong><u>Clone project with git:</u></strong> git clone git://github.com/pazuzu156/CoolTip.git
<hr>
<strong>Usage</strong><br>
<div class="showToggle use">Show/Hide Code</div>
<?=$use->parse_code()?>
<hr>
<strong>The PHP Code</strong><br>
<div class="showToggle php">Show/Hide Code</div>
<?=$code->parse_code()?>
</body>
</html>
