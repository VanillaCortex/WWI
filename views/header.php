<?php
// Inlog if statement hier voor andere weergave
?>


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

            <a class="nav-right" href="cart" >
                <a href="about">Over ons</a>
                <i class="fas fa-shopping-basket fa-2x my-icon-color"></i>
            </a> <!-- Hier begint de modal-->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inlogModal">
              <i class="far fa-user fa-2x"></i>
            </button>
        </div>
    </nav>
</div>
