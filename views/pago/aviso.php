<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

if (!empty($mensaje)) {
    $msg = $mensaje;
    
} else{
    $msg="No se encontro la pagina solicitada";
}

$this->title = "Atencion!";
?>
<section id="cambiapass" style="background-image:url('assets/img/fondo.jpg');" class="cover-background contenedor-full full-section">
     <div class="jumbotron box-bd1">
          <img src="../web/assets/img/logo-color.png" alt="logo-color" class="mb-20" style="max-width:150px;">
    
      
        <div class="site-error" align="center">
          
           <h2><?= Html::encode($this->title) ?></h2>
            <div class="alert alert-danger">
              <?php echo nl2br(Html::encode($msg));?>
            </div>
            
           <div class="alert alert-info">
               <div>
                  <?php echo "El costo de inscripcion $".Html::encode($importecarrera->importe);?>
               </div>
               <div>
                  <?php
                  if($suma==''){
                      $suma=0;
                  }
                       echo "Importe total pagado $".Html::encode($suma);?>
               </div>
               <div>
                  <?php echo "Tu saldo a abonar es $".Html::encode($importecarrera->importe - $suma);?>
               </div>
               <div>
                  <?php echo "Administracion: carreraxbarda@gmail.com";?>
               </div>
        </div>
    
  </div>
</section>