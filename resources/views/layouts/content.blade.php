<div class="login-box">
  <div class="login-logo">
    <a href=""><img src="/Views/img/plantilla/AF_LOGO_GRANDE-01.jpg" alt="Main Page" class="img-fluid"
           style="margin: -25% 0px -20% 0px; border-radius: 5px"></a>
  </div>
  <!-- /.login-logo -->
  <div class="card mt-5">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Ingresar placa de la motocicleta</p>

      <form method="post">
        @csrf

        <div class="form-group has-feedback">

          <input type="text" class="form-control plate" placeholder="PLACA" name="plate" required>

          <span class="fa fa-motorcycle form-control-feedback"></span>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12 col-sm-6">
            <div class="btn btn-warning btn-block btn-flat btnRegistrar">Registrar</div>
          </div>
          <div class="col-12 col-sm-6">
            <div class="btn btn-secondary btn-block btn-flat btnConsultar">Consultar</div>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>