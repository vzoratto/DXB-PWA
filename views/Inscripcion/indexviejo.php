 <!-- utilizacion de un widget de jui llamado Tabs, se define cada una de las tabs 
    y dentro de ellas se renderiza su correspondiente vista a las cuales se le envian los 
    modelos correspondientes --> 
    <?php echo Tabs::widget([
    'items' => [
        [
            'label' => 'Datos Personales',
            'content' =>$this->render('datospersonales',['persona'=>$persona,'usuario'=>$usuario,'form'=>$form,'talleRemera'=>$talleRemera,'listadoTalles'=>$listadoTalles]),
        ],
        [
            'label' => 'Datos de contacto',
            'content' => $this->render('datoscontacto',['personaDireccion'=>$personaDireccion,'persona'=>$persona,'localidad' => $localidad,'provincia' => $provincia,'provinciaLista' => $provinciaLista,'form'=>$form, 'datos'=>$datos]),

        ],
        [
            'label' => 'Datos medicos',
            'content' => $this->render('datosmedicos',['persona'=>$persona,'fichaMedica'=>$fichaMedica,'form'=>$form]),
        ],
        [
            'label' => 'Contacto de emergencia',
            'content' => $this->render('contactoemergencia',['datosEmergencia'=>$datosEmergencia,'form'=>$form]),
        ],
        [
            'label' => 'Encuesta',
            'content' => $this->render('encuesta',['form'=>$form]),
        ],
    ],
    'options' => ['tag' => 'div'],
    'itemOptions' => ['tag' => 'div', 'class' => 'tabs-container'],
    'headerOptions' => ['class' => 'my-class'],
    'clientOptions' => ['collapsible' => false],
]);
