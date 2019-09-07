<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "result".
 *
 * @property int $idResultado
 * @property int $numEquipo
 * @property int $tiempoLlegada
 * @property int $respuestasCorrectas
 * @property int $bolsasCompletas
 * @property int $penalizacionBolsa
 * @property int $trivia
 * @property int $total
 * @property int $categoria
 * @property int $cantPersonas
 */
class Result extends \yii\db\ActiveRecord
{
    const RESPOBLIGATORIAS=8;
    const BOLSASOBLIGATORIASEQUIPODOSPERSONAS=1;
    const BOLSASOBLIGATORIASEQUIPOCUATROPERSONAS=2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'result';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numEquipo', 'bolsasCompletas'], 'required'],
            [['numEquipo', 'tiempoLlegada', 'respuestasCorrectas', 'bolsasCompletas', 'penalizacionBolsa', 'trivia', 'total', 'categoria', 'cantPersonas'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idResultado' => 'Id Resultado',
            'numEquipo' => 'Num Equipo',
            'tiempoLlegada' => 'Tiempo Llegada',
            'respuestasCorrectas' => 'Respuestas Correctas',
            'bolsasCompletas' => 'Bolsas Completas',
            'penalizacionBolsa' => 'Penalizacion Bolsa',
            'trivia' => 'Trivia',
            'total' => 'Total',
            'categoria' => 'Categoria',
            'cantPersonas' => 'Cant Personas',
        ];
    }
    //si respondio bien 8 o mas trivias, cumplio con el requisito
    public function cumplioRequisitoTrivia(){
        $cumplio=false;
        if($this->respuestasCorrectas>=self::RESPOBLIGATORIAS){
            $cumplio=true;

        }else{
            $cumplio=false;
            //$faltoResponder=self::RESPOBLIGATORIAS-$this->respuestasCorrectas;
            //$totalPena=$this->penalizacionTrivia($faltoResponder);
            //$this->trivia=$totalPena;
            //$this->total=$this->tiempoLlegada+$totalPena;
            //$this->save();
        }

        return $cumplio;
    }
    public function penalidad(){
        $equipo=Equipo::findOne(['nombreEquipo'=>$this->numEquipo]);
        $requisitoTrivia=$this->cumplioRequisitoTrivia();
        if($requisitoTrivia==true){
            //echo 'aca'. $this->numEquipo;
            $this->total=$this->total+$this->tiempoLlegada;
            $this->save();
        }
        if($requisitoTrivia==false){
            $trivaMal=self::RESPOBLIGATORIAS-$this->respuestasCorrectas;
            $penaPorTriviaMal=45000;
            $totalPenalizacionTrivia=$penaPorTriviaMal*$trivaMal;
            $this->trivia=$totalPenalizacionTrivia;
            $this->total=$this->tiempoLlegada+$this->trivia;
            $this->save();
        }

        if($equipo->cantidadPersonas==2){
            if($this->bolsasCompletas==0){
                $penalidadCeroBolsa=600000;
                $this->penalizacionBolsa=$penalidadCeroBolsa;
                $this->total=$this->total+$this->penalizacionBolsa;
                $this->save();

            }
            //cumplio el requisito no penaliza
            if($this->bolsasCompletas==1){
                $penalidadUnaBolsa=0;
                $this->penalizacionBolsa=$penalidadUnaBolsa;
                $this->total=$this->total+$this->penalizacionBolsa;
                $this->save();
                //$penalidadUnaBolsa=180000;
                //$this->penalizacionBolsa=$penalidadUnaBolsa;
                //$this->total=$this->total+$this->penalizacionBolsa;
                //$this->save();

            }
        }
        if($equipo->cantidadPersonas==4){
            if($this->bolsasCompletas==0){
                $penalidadCeroBolsa=600000;
                $this->penalizacionBolsa=$penalidadCeroBolsa;
                $this->total=$this->total+$this->penalizacionBolsa;
                $this->save();

            }
            //penaliza con 3 minutos
            if($this->bolsasCompletas==1){
                $penalidadUnaBolsa=180000;
                $this->penalizacionBolsa=$penalidadUnaBolsa;
                $this->total=$this->total+$this->penalizacionBolsa;
                $this->save();

            }
            //no penaliza
            if($this->bolsasCompletas==2){
                $penalidadDosBolsa=0;
                $this->penalizacionBolsa=$penalidadDosBolsa;
                $this->total=$this->total+$this->penalizacionBolsa;
                $this->save();

            }

        }




    }





    public function existeEquipo(){

        //se busca el modelo del equipo al que pertenece
        $equipoAlQuePertenece=Equipo::findOne(['nombreEquipo'=>$this->numEquipo]);

        return $equipoAlQuePertenece;
    }
    public function cumplioRequisitoBolsa(){
        $cumplio=false;
        //$restantes=0;
        $equipoAlQuePertenece=$this->existeEquipo();

        if($equipoAlQuePertenece){
            //si pertenece a un equipo de 2 personas
            if($equipoAlQuePertenece->cantidadPersonas==2){
                if($this->bolsasCompletas>=self::BOLSASOBLIGATORIASEQUIPODOSPERSONAS){
                    //$cumplio=true;
                    $restantes=0;
                }else{
                    $restantes=self::BOLSASOBLIGATORIASEQUIPODOSPERSONAS-$this->bolsasCompletas;
                }

                //si pertenece a un equipo de  4 personas
            }elseif ($equipoAlQuePertenece->cantidadPersonas==4){
                if($this->bolsasCompletas>=self::BOLSASOBLIGATORIASEQUIPODOSPERSONAS){
                    //$cumplio=true;
                    $restantes=0;
                }else{
                    $restantes=self::BOLSASOBLIGATORIASEQUIPOCUATROPERSONAS-$this->bolsasCompletas;

                }
            }

        }
        return $restantes;
    }

    //como el requisito es minimo 8, se le sumarian 6 minutos si no responde las 8 trivias
    //45 segundos por cada trivia
    public function penalizacionTrivia($cantidadTriviasFaltoResponder){
        //45 segundos son 45000 milisegundos
        $penaPorTriviaMal=45000;
        $totalPenalizacionTrivia=$cantidadTriviasFaltoResponder*$penaPorTriviaMal;
        //$milisegundosPorTrivia=$cantidadTriviasFaltoResponder
        $this->trivia=$totalPenalizacionTrivia;
        $this->save();

        return $totalPenalizacionTrivia;


    }

    public function penalizacionBolsa($bolsasQueFaltaron){
        if($this->existeEquipo()){
            if($bolsasQueFaltaron>0){
                //3 minutos por bolsa faltante
                //3 minutos son 180000 milisegundos
                $tresMinutosAMils=180000;
                $totalPenaBolsa=$tresMinutosAMils*$bolsasQueFaltaron;
                $this->penalizacionBolsa=$totalPenaBolsa;
                $this->save();

            }else{
                $totalPenaBolsa=0;
            }

        }
        return $totalPenaBolsa;

    }


    //suma la penalidad de bolsas y trivias
    /* public function penalidadTotal(){
         if($this->existeEquipo()){
             $totalPena=0;
             if($this->cumplioRequisitoTrivia()==false){
                 $faltoResponder=self::RESPOBLIGATORIAS-$this->respuestasCorrectas;
                 //el total de penas de trivias que respondio mal o falto responder
                 $totalPenaTrivia=$this->penalizacionTrivia($faltoResponder);
                 $totalPena=$totalPena+$totalPenaTrivia;

             }

             if($this->cumplioRequisitoBolsa()==false){
                 $restantes=$this->cumplioRequisitoBolsa();
                 $totalPenaBolsa=$this->penalizacionBolsa($restantes);
                 $totalPena=$totalPena+$totalPenaBolsa;
             }

             return $totalPena;
         }else{
             $mensaje='no existe el equipo';
             $guardado=false;
             return Yii::$app->response->redirect(['result/cargar', 'guardado' => false, 'mensaje' => $mensaje])->send();
         }


     }*/

    public function sumaLaPenaTotal(){
        if($this->existeEquipo()){
            $totalPena=$this->penalidadTotal();
            if($totalPena>0){
                $this->total=$this->tiempoLlegada+$totalPena;

            }else{
                $this->total=$this->tiempoLlegada;
            }

            $this->save();
        }else{
            $mensaje='no existe el equipo';
            $guardado=false;
            return Yii::$app->response->redirect(['result/cargar', 'guardado' => false, 'mensaje' => $mensaje])->send();
        }

    }
}
