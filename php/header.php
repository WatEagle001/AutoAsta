<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once 'session_Manager.php';
    require_once 'page.php';
    $username = createSession();
    $page = new page();
?>

<header>
    <h1>AUTO ASTA</h1>
    <form action="../php/search.php" id="searchForm" method="get">
        <input id="search" type="text" placeholder="Digita qui quello che cerchi" name="search" tabindex="1" autocomplete="off">
        <button id="btnSearchForm" type="submit" form="searchForm" tabindex="2" >CERCA</button>    
    </form>

    <div id="accesso" tabindex="3">
        <?php $page->printLogin(); ?>
    </div>
</header>  

<nav id="breadcrumb" tabindex="4">
    <?php $page->printBreadcrumb();?>
</nav>

<div id="menu" tabindex="5">
    <ul>
        <?php $page->printMenu(); ?>
    </ul>
</div>