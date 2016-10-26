<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/main.css"/>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li class=""><a href="<?= App::Component('router')->to(['page/index', 'name'=>'about'])?>"><?= __('menu.about', $this->_lang);?></a></li>
            <li class=""><a href="<?= App::Component('router')->to(['page/index', 'name'=>'contacts'])?>"><?= __('menu.contacts', $this->_lang);?></a></li>
            <?php
            if(!App::Component('auth')->isGuest()):
            ?>
            <li><a href="<?= App::Component('router')->to(['site/logout'])?>"><?= __('menu.logout', $this->_lang);?></a></li>
            <?php
            else:
            ?>
            <li><a href="<?= App::Component('router')->to(['site/login'])?>"><?= __('menu.login', $this->_lang);?></a></li>
            <?php
            endif;
            ?>
            <li><a href="<?= App::Component('router')->to('/en/')?>">En</a></li>
            <li><a href="<?= App::Component('router')->to('/ru/')?>">Ru</a></li>
            <li><a href="<?= App::Component('router')->to('/uk/')?>">Uk</a></li>
        </ul>
    </div>
</nav>
<div class="container">
    <?=$content;?>
</div>
</body>
</html>