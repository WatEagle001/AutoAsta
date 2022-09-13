<?php 

    require_once 'session_Manager.php';
    require_once 'page.php';
    $username = createSession();
    $page = new page();
?>

<header>
    <h1>AUTO ASTA</h1>
    <form action="search.php" id="searchForm" method="get" role="search" tabindex="0">
        <input id="search" type="text" placeholder="Digita qui quello che cerchi" name="search" tabindex="0" autocomplete="off" aria-label="Digita qui quello che cerchi">
        <button id="btnSearchForm" type="submit" form="searchForm" tabindex="0" >CERCA</button>    
    </form>

    <div id="accesso">
        <?php $page->printLogin(); ?>
    </div>
</header>  

<nav id="breadcrumb"  tabindex="0" aria-label="Ti trovi in: ">
    <?php $page->printBreadcrumb();?>
</nav>

<nav id="menu" aria-label="Lista delle Pagine di AutoAsta">
    <ul role="menu" aria-label="menu">
        <?php $page->printMenu(); ?>
    </ul>
</nav>