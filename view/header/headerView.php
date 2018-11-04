<body>
    <header>
        <nav id="navBar">
            <ul id="navBarList">
                <li class="navbar-item"><a href="index.php"><img  id="logo" src="img/logo.png"></a></li>
                <input id="searchBar" class="navbar-item" type="text" name="searchBar" placeholder="Buscar...">
                <li class="navbar-item" id="profileIconLi">
                    <img id="profileIcon" src="img/profileIcon.png">
                    <?php require_once(dirname(__FILE__) . "/userDropdownView.php"); ?>
                </li>
                <li class="navbar-item" id="cartIconLi">
                    <img id="cartIcon" src="img/cartIcon.png">
                    <div class="dropdown">
                        <div class="dropdown-content">
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
