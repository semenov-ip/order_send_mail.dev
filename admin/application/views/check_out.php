<?php
    $this->load->view('header');
?>
<body>
    <div class="container">
        <form class="form-signin" action="<?php echo $header['base_url']."user_login/check_out/"; ?>" method="POST">
            <p class="form-signin-heading">Вход в административную панель:</p>
                <input type="text" name="user" class="input-block-level" placeholder="User">
                <input type="password" name="password" class="input-block-level" placeholder="Password">
            <button class="btn btn-large btn-primary" type="submit" name="submit">Войти</button>
        </form>
    </div>
</body>
</html>