<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Registration Page</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="#"><b>SISTEMA </b>BETCOM</a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Registro nuevo miembro</p>

                <form action="<?= base_url('/grabar') ?>" method="post">
                    <?= csrf_field(); ?>
                 
                    <?php if (!empty(session()->getFlashdata('fail'))) : ?>
                           <div class="alert alert-danger"><?= session()->getFlashdata('fail') ?></div>
                     <?php endif; ?>
                    <?php if (!empty(session()->getFlashdata('success'))) : ?>
                           <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>

                    <?php if (isset($validation) && $validation->hasError('nombre')) : ?>
                        <span class="text-danger"><?= $validation->getError('nombre') ?></span>
                        <br>
                    <?php endif; ?>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nombre completo" name="nombre" value="<?= set_value('nombre'); ?>" >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <?php if (isset($validation) && $validation->hasError('email')) : ?>
                        <span class="text-danger"><?= $validation->getError('email') ?></span>
                        <br>
                    <?php endif; ?>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Correo Electrónico" name="email" value="<?= set_value('email'); ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <?php if (isset($validation) && $validation->hasError('password')) : ?>
                        <span class="text-danger"><?= $validation->getError('password') ?></span>
                        <br>
                    <?php endif; ?>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" value="<?= set_value('password'); ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <?php if (isset($validation) && $validation->hasError('cpassword')) : ?>
                        <span class="text-danger"><?= $validation->getError('cpassword') ?></span>
                        <br>
                    <?php endif; ?>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Reescriba su password" name="cpassword" value="<?= set_value('cpassword'); ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    acepto los terminos <a href="#">terminos</a>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Registarse</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <a href="/entrar" class="text-center">Ya tengo membresia</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
</body>

</html>