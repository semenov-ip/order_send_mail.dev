<?php
    $this->load->view('header');
?>
<body>
    <div class="container" id="content">
        
        <!-- TOP menu -->
        <div class="row top_content">
            <?php
                $this->load->view('menu/top_menu.php');
            ?>
        </div>
        
        <!-- body pages -->
        <div class="row">
            <div class="span12 body_content">
                <?php
                    $this->load->view($manag_pag);
                ?>
            </div>
        </div>
        
        <!-- popup menu -->
        <div id="dialog" title="" style="display: none;"></div>
    </div>
</body>
</html>