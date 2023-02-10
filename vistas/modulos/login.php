<div class="login-box">
  
  <div class="login-logo">
    
    <a href="../../index2.html"><b>Mix</b>Store</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Ingresar al sistema</p>

    <form method="post">

      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" autocomplete="off">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
       
        <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword">
        
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        
        <!-- /.col -->
        <div class="col-xs-4 pull-right">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
        <!-- /.col -->
      </div>

      <?php
       $login = new ControladorUsuarios();
       $login -> ctrIngresoUsuario();
      ?>

    </form>

    

  </div>
  <span class="label label-warning pull-right">Versión 1.8.0</span>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
