<div class="fixed-top">
    <nav class="navbar  navbar-dark bg-dark justify-content-between">
        <div class="container">
            <a  class="nav-left" href="/WWI/">
                <img src="media/images/logo.png"  style="width: 177px;">
            </a>
            <form class="form-inline " action="search">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="q">
           </form>

            <a class="nav-right" href="cart" ><i class="fas fa-shopping-basket fa-2x my-icon-color"></i></a><a class="my-icon-color" href="about">Over ons</a>

            <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1) { ?>
                <p style="margin-bottom: 0;" class="my-icon-color">Ingelogd als: <?= $_SESSION['user'] ?></p>
                <form method="post" action="<?=$request?>">
                    <input class="hidden" type="text" name="logout" value="1">
                    <button type="submit" class="btn btn-primary">Log uit</button>
                </form>

                <a class="nav" href="orders"><i class="fas fa-box fa-2x my-icon-color"></i></a>

                <?php
                    if(isset($_POST) && !empty($_POST) && isset($_POST['logout']) && $_POST['logout'] == 1) {
                        $user = new User();
                        $logout = $user->logout();
                        echo '<script>window.location.replace("/WWI/");</script>';
                    }

                ?>

            <?php } else { ?>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inlogModal">
                  <i class="far fa-user fa-2x"></i>
                </button>
            <?php } ?>
        </div>
    </nav>
</div>
