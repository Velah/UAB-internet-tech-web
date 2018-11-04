<div class="dropdown">
    <div class="dropdown-content">
        <?php
        if(isset($_SESSION['user'])){
            echo "<a id='userDropdownUserProfile'>El meu compte</a>";
            if($_SESSION['user']['admin']){
                echo "<a id='userDropdownAdmin'>Administració</a>";
            }
                echo "<a id='userDropdownOrders'>Les meves comandes</a>
                      <a id='userDropdownLogout'>Tanca sessió</a>
                      <span id='welcomeUserSpan'>Benvingut/da " . $_SESSION['user']['name'] . "</span>";
        }
        else{
            echo "<a href='index.php?action=login'>Inicia sessió</a>";
        }
        ?>
    </div>
</div>