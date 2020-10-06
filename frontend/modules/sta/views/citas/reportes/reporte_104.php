<?php
use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\h;
USE frontend\modules\sta\staModule;
$tipo=h::user()->profile->tipo;
$isPsicologo=($tipo==staModule::PROFILE_PSICOLOGO)?true:false;
$isSecre=($tipo==staModule::PROFILE_PSICOLOGO)?true:false;
?>
<div class="titulo">REPORTE TUTORIA PSICOLOGICA POR SESION</div>
<div class="subtitulo">I DATOS DE FILIACIÓN</div>
<div class="afiliacion">
<table>
    <TR>
        <TD width="80%">
            <TABLE>
                <TR>
                    <TD>Nombres y apellidos : </TD>
                    <TD><?=$alumno->fullName()?></TD>
                </TR>
                <TR>
                    <TD>Edad :</TD>
                    <TD>.......</TD>
                </TR>
                <TR>
                    <TD>Código :</TD>
                    <TD><?=$alumno->codalu?></TD>
                </TR>
                <TR>
                    <TD>Facultad :</TD>
                    <TD><?=$alumno->facultad->desfac?></TD>
                </TR>
                <TR>
                   <TD>Especialidad :</TD>
                    <TD><?=$alumno->carrera->descar?></TD> 
                </TR>
                <TR>
                   <TD>Psicólogo Responsable :</TD>
                    <TD><?=$model->talleresdet->trabajador->fullName()?></TD> 
                </TR>
            </TABLE>
        </TD>
        <TD width="20%">
           </TD>
    </TR>
    
</table>
</div>


    <?php foreach($citas as $cita) {  ?>
    <div class="afiliacion">
    <table class="border">
    <tr class="border">
        <td class="gris-oscuro" width='40%'>Numero de Sesión</td>
        <td class="gris-oscuro" width='10%'>Fecha</td>
        <td class="gris-oscuro" width='50%'>Responsable</td>
    </tr>
    <tr class="border">
        <td><?=$cita->numero?></td>
        <td><?=$cita->finicio?></td>
        <td><?=$cita->psicologo->fullName()?></td>
    </tr class="border">
    <tr class="border">
        <td  class="texto-center gris-oscuro" colspan="3">Actividades Realizadas</td>
        
    </tr>
    <tr class="border">
        <td colspan="3">Indicador Trabajado</td>
        
    </tr>
    <tr class="border">
       <td colspan="3"><?=$cita->detalles_indicadores?></td> 
    </tr>
    <tr class="border">
        <td class='gris-claro' width='20%'>Observaciones</td>
        <td class="border" colspan="2" width='80%'><?=($isPsicologo)?$cita->detalles:'[Contenido disponible sólamente para el Psicólogo a cargo]'?></td>
        
    </tr>
    <tr class="border">
        <td class='gris-claro' width='20%' >Tareas pendientes</td>
        <td colspan="2" width='80%'><?=$cita->detalles_tareas_pend?></td>
        
    </tr>
    <tr class="border">
        <td width='20%'>Firma del psicólogo:</td>
        <td colspan="2" width='80%'></td>
        
    </tr>
    </table>
    </div>
    <?php } ?>

