<h3><?= __('title.welcome', $this->_lang)?></h3>
<pre>
<?php echo App::Component('router')->to(['page/about', 'a'=>1, 'b'=>2323])?>
</pre>
