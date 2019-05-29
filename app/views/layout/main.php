<!doctype HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SimplestPHP - <?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="session" content="<?php echo Vendor\Security::siteKey(); ?>">
    <meta property="og:title" content="SimplestPHP.xyz">
    <meta property="og:site_name" content="SimpltestPHP.xyz">
    <meta property="og:description" content="SimplestPHP Framework: Simple thing, for creating big things">
    <meta property="description" content="SimplestPHP Framework: Simple thing, for creating big things">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bulmaswatch/0.7.2/flatly/bulmaswatch.min.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/gh/jmaczan/bulma-helpers/css/bulma-helpers.min.css">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.6.3/css/all.css">
</head>
<body>

    <section class="hero is-info">
        <div class="hero-head">
            <nav class="main-nav navbar ">
                <div class="container">
                    <div class="navbar-start">
                        <a class="navbar-item is-active" href="/">
                            <h1 class="title is-5">SimplestPHP</h1>
                        </a>
                        
                        <?php if($user->isAuth()): ?>
                        <a class="navbar-item" href="/admin">
                            Dashboard
                        </a>
                        <div class="navbar-item has-dropdown is-hoverable">
                            <a class="navbar-link">
                                Category
                            </a>
                            <div class="navbar-dropdown">
                                <a class="navbar-item" href="/admin/categories">
                                    Categories
                                </a>
                                <a class="navbar-item" href="/admin/new_category">
                                    New category
                                </a>
                            </div>
                        </div>
                        <div class="navbar-item has-dropdown is-hoverable">
                            <a class="navbar-link">
                                Pages
                            </a>
                            <div class="navbar-dropdown">
                                <a class="navbar-item" href="/admin/pages">
                                    Pages
                                </a>
                                <a class="navbar-item" href="/admin/new_page">
                                    New page
                                </a>
                            </div>
                        </div>
                        <a class="navbar-item" href="/admin/logout">
                            Logout
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </div>
        <?php if(!isset($nohero)): ?>
        <div class="hero-body">
            <div class="container">
                <h1 class="title">SimplestPHP Framework</h1>
                <h2 class="subtitle">Simple thing, for creating big things</h2>
                <p>
                    <a class="button is-primary is-inverted" href="//github.com/xLaming/SimplestPHP/archive/master.zip" target="_blank">Download</a> 
                    <a class="button is-dark" href="//github.com/xLaming/SimplestPHP" target="_blank" title="Download from Github">
                        <span class="icon"> <i class="fab fa-github"> </i> </span>
                    </a>
                </p>
            </div>
        </div>
        <?php endif; ?>
    </section>
    
    <div class="columns">
        <div class="column is-2">
            <aside class="menu section">
                <?php foreach ($page->getCategories() as $cat): ?>
                <p class="menu-label"> <i class="fa fa-<?php echo $cat['icon']; ?>"> </i> <?php echo $cat['name']; ?> </p>
                <ul class="menu-list">
                    <?php foreach ($page->getAllByCategory($cat['id']) as $p): ?>
                    <li>
                        <a href="/docs/<?php echo $p['slug']; ?>"> <?php echo $p['name']; ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endforeach; ?>
            </aside>
        </div>
        
        <div class="column is-3">
            <div class="has-margin-top-25">
                <nav class="breadcrumb" aria-label="breadcrumbs">
                    <ul>
                        <?php 
                        $urls = array_map('strtolower', $breadcrumb);
                        foreach($urls as $url) {
                            if (end($urls) === $url) {
                                echo '<li class="active"><a aria-current="page" href="', $url, '">', ucfirst($url), '</a></li>';
                            } else if (array_values($urls)[1] === $url) {
                                echo '<li><a href="/', $url, '">', ucfirst($url), '</a></li>';
                            } else {
                                echo '<li><a href="', $url, '">', ucfirst($url), '</a></li>';
                            }
                        }
                        ?>
                    </ul>
                </nav>
                <div class="container">
                    <?php echo $html; ?>
                </div>
            </div>
        </div>
    </div>
    
    <footer class="footer has-background-light">
        <div class="container">
            <div class="content has-text-centered">
                <p>
                    <a class="icon" href="//github.com/jenil/bulmaswatch" target="_blank">
                        <i class="fab fa-github"></i>
                    </a>
                    &nbsp;
                    <a class="icon" href="//twitter.com/xLaming" target="_blank">
                        <i class="fab fa-twitter"></i>
                    </a>
                </p>
                <p>
                    <?php echo date('Y'); ?> - <strong>SimplestPHP</strong>
                    <br>
                    License <a href="//opensource.org/licenses/MIT" target="_blank">MIT</a>.
                </p>
            </div>
        </div>
    </footer>
    
</body>
</html>