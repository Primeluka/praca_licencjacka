<?php

function nav($active) {

echo '<nav class="navbar navbar-light navbar-expand-lg">
		<div class="container">
            <div class="navbar-nav">
                <a href="index.php" class="nav-item nav-link '; if ($active == "index") {
                    echo 'active text-warning';
                } echo '">Start</a>
                <a href="menu.php" class="nav-item nav-link '; if ($active == "menu") {
                    echo 'active text-warning';
                } echo '">Menu</a>
                <a href="order.php" class="nav-item nav-link '; if ($active == "order") {
                    echo 'active text-warning';
                } echo '">Koszyk</a>
                <a href="orderlist.php" class="nav-item nav-link '; if ($active == "orderlist") {
                    echo 'active text-warning';
                } echo '">Moje zamówienia</a>
                <a href="#" class="nav-item nav-link '; if ($active == "contacts") {
                    echo 'active text-warning';
                } echo '">Kontakt</a>';
                
                if (isset($_SESSION['permissions']) && ($_SESSION['permissions'] == 1)) {
                    echo '<a href="admin.php"><button class="btn btn-danger ml-2 '; 
                    if ($active == "admin") {
                        echo 'active';
                    } echo '" type="button">Panel Administatora</button></a>';
                }      
echo '</div>';           
                    if (isset($_SESSION['login']) && ($_SESSION['login'] == true)) {
                        echo '<div class="navbar-nav">
                        <div class="navbar-text">Witaj</div>
                        <a href="profile.php" class="nav-item nav-link">' . $_SESSION['name'] . ' ' . $_SESSION['surname'] . ' !</a>
                        <a href="logout.php" class="nav-item nav-link">Wyloguj się</a>
                        </div>';
                    } else {
                        echo '<div class="navbar-nav">
                        <a href="login_form.php" class="nav-item nav-link '; if ($active == "login") {
                        echo 'active text-warning';
                    } echo '">Zaloguj się</a>
                        <a href="form.php" class="nav-item nav-link '; if ($active == "register") {
                        echo 'active text-warning';
                    } echo '">Zarejestruj się</a>
                        </div>';
                    }
echo '</div>
	</nav>';


}

?>