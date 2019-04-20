<?php
namespace app\custom;

use yii\base\Widget;
use yii\helpers\Html;

class ProgressBar extends Widget
{
    public $items;
    public $grouped = false;
    public $summary = false;
    public $label = 'descripcion';
    public $value = 'avance';
    public $groupTag = 'hijos';
    public $LevelLabel = 'nivel';
    // public $inline  = false;
    public $contador;
    public $prefix = "m";
    private $str = "";
    private $res = "";
       

    public function init()
    {
        parent::init();
        if ($this->items === null) {
            $items = [[$this->label=>"TEST" ,$this->value=>20]];
        }
        $this->contador[0]=1;
        $this->contador[1]=1;
        $this->contador[2]=1;
        $this->contador[3]=1;
        $this->contador[4]=1;
        $this->contador[5]=1;
        $this->contador[6]=1;
        $this->contador[7]=1;
        $this->contador[8]=1;
        $this->contador[9]=1;
        $str = "";
    }

    public function run()
    {
        if(!$this->grouped){
            if($this->summary){
                $total = 0;
                 foreach ($this->items[0] as $key=> $item) {
                    $total += $item[$this->value];
                }
                $total =  number_format ($total /sizeof($this->items[0]) , 2);
                $this->crearGrafica("GENERAL", $total);
            }

            foreach ($this->items[0] as $key=> $item) {
                $this->crearGrafica($item[$this->label], $item[$this->value]);
            }
        }else{
            $this->crearGrupoPrincipal();
            echo $this->str;
        }

    }

    private function crearGrafica($label , $value){
        echo  "<h4>".$label."</h4><div class='progress'>
            <div class='progress-bar progress-bar-striped' role='progressbar'
            aria-valuenow='".$value."' aria-valuemin='0' aria-valuemax='100' style='width:".($value>10?$value:10)."%'>"
         .$value."% 
            </div></div>";
    }

    private function crearGrupoPrincipal(){
         $this->str = "<div class='panel-group' id='accordion'>";
         foreach ($this->items[0] as $key=> $item) {
            $this->str.= $this->crearGrupo("accordion" , $this->crearID($item['nivel']) , $item[$this->label] , $item[$this->value] , "" , $item );
        }
         $this->str.="</div>";
    }

    private function crearGrupo($parent , $id , $titulo , $valor ,$contenido ,$arreglo  ){
        $t =    "<div class='panel panel-default'>

            <div class='panel-heading'>
              <div class='panel-title'>
                <a data-toggle='collapse' data-parent='#$parent' href='#$id'>
                <div class='protitle'>$titulo</div>
                  <div class='progress1'>
                    <div class='progress-bar  progress-bar-striped' role='progressbar' aria-valuenow='$valor'
                    aria-valuemin='0' aria-valuemax='100' style='width:".($valor>10?$valor:10)."%'>
                      $valor% 
                    </div>
                  </div>
                </a>
              </div>
            </div>
            <div id='$id' class='panel-collapse collapse'>
              <div class='panel-body'>";
              if(!empty($arreglo['fk'])){
                  if($arreglo['fk']==99)
                  {
                    d($arreglo);
                    die();
                  }
              
              }
              if(!empty($arreglo[$this->groupTag])){
                foreach ($arreglo[$this->groupTag] as $item) {
                    if(!empty($item[$this->groupTag])){
                    $t.=$this->crearGrupo($this->getParent($item[$this->LevelLabel]),$this->crearID($item[$this->LevelLabel]) , $item[$this->label] , $item[$this->value] , $item[$this->label]." - ".$item[$this->value] , $item  );
                    }else{
                        $t.=$item[$this->label]." - ".$item[$this->value]."</br>";
                    }
                    
                }
                    
              }else{
                
                $t.=$contenido."</br>";
              }
                 $this->incCounter($item[$this->LevelLabel]);
            $t.= "</div>
            </div>
            </div>";
            return $t;
    }

    private function crearID($nivel){
        $r = "";
        $c = 0 ;
        for($c ; $c < $nivel ; $c++){
            $r .= $this->leadZeros($this->contador[$c]);
        }
        $this->incCounter($nivel);
        return $this->prefix.$r;
    }

    private function getParent($nivel){
         $r = "";
        $c = 0 ;
        for($c ; $c < $nivel -1; $c++){
            $r .= $this->leadZeros($this->contador[$c]);
        }
        return $this->prefix.$r;
     
       
    }

    private function leadZeros($valor){
        return  sprintf("%02d", $valor);
    }



    private function incCounter($nivel){
        if($nivel==1){
            $this->contador[0]++; 
        }else if($nivel==2){
            $this->contador[1]++; 
        }else if($nivel==3){
            $this->contador[2]++; 
        }else if($nivel==4){
            $this->contador[3]++; 
        }else if($nivel==5){
            $this->contador[4]++; 
        }else if($nivel==6){
            $this->contador[5]++; 
        }else if($nivel==7){
            $this->contador[6]++; 
        }else if($nivel==8){
            $this->contador[7]++; 
        }else if($nivel==9){
            $this->contador[8]++;
        }else if($nivel==10){
            $this->contador[9]++;
        }
    }




}