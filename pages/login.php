<?
set_config('TITLE', 'Login');
include(get_config('SITE_PATH') . 'includes/html.head.php');
?>

<body class="<?= 'pg_' . GetPage(); ?> gray-bg">

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>

            <img class="logo" src="img/logo_login.png" />

        </div>
        <h3>Bem vindo ao Deep Manager</h3>
        <p>
            Preencha abaixo com suas credenciais para acessar a administração de sua igreja.
        </p>
        <form class="m-t" role="form" method="post" action="<?= get_config('SITE_URL'); ?>script/login.php">
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Seu e-mail" name="mail" required="">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Sua senha" name="pass" required="">
            </div>

            <?
            if(isset($_SESSION['login_msg'])) {
                ?>
                <div class="alert alert-danger" role="alert"><?= $_SESSION['login_msg']; ?></div>
            <?
                unset($_SESSION['login_msg']);
            }
                ?>


            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

            <a href="#"><small>Esqueceu sua senha?</small></a>
            <p class="text-muted text-center"><small>Sua igreja ainda não utiliza o nosso sistema?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="register.html">Crie uma conta pra sua igreja agora</a>
        </form>

        <p class="m-t"> <small><?= get_config('FOOTER_TEXT')?></small> </p>
    </div>
</div>

<!-- Mainly scripts -->
<script src="<?= get_config('SITE_URL'); ?>js/jquery-2.1.1.js"></script>
<script src="<?= get_config('SITE_URL'); ?>js/bootstrap.min.js"></script>

</body>

<?
include(get_config('SITE_PATH') . 'includes/html.foot.php');
?>