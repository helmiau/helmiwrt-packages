<?php
    $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
    $url = end($url_array);
?>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #47477f;">
    <a class="navbar-brand" href="#">Libernet Plus</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		<a>Menu</a>
        <!--<span class="navbar-toggler-icon"></span>-->
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php if ($url === 'index.php') echo 'active'; ?>">
                <a class="nav-link" href="index.php"><i class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?php if ($url === 'config.php') echo 'active'; ?>">
                <a class="nav-link" href="config.php"><i class="fa fa-gear"></i> Configuration</a>
            </li>
            <li class="nav-item <?php if ($url === 'about.php') echo 'active'; ?>">
                <a class="nav-link" href="about.php"><i class="fa fa-info"></i> About</a>
            </li>
        </ul>
    </div>
</nav>
