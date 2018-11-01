<?php
// Inlog if statement hier voor andere weergave

?>
<div class="col-md-10 offset-md-1">
    <nav class="navbar">
        <a class="navbar-brand" href="localhost/WWI/index.php">
            <img src="<?php if($request_uri[0]!=='/WWI/'){ print('../'); }?>media/images/logo.png" width="177" height="64">
        </a>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <h4>World Wide Importers</h4>
            </li>
        </ul>
    </nav>
</div>