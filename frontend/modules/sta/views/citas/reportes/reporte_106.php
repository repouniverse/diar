<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="titulo">INFORME EVALUACION PSICOLÓGICA (EVP)</div>
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
<div class="subtitulo">II INDICADORES PSICOLÓGICOS HALLADOS</div>
<BR>
<div class="afiliacion">
<table>
    <?php foreach($resultados as $resultado) {  ?>
    <tr>
        <td width='70%'><?=$resultado->indicador->nombre?></td>
        <td>Nivel: </td>
        <td><?=$resultado->categoria?></td>
    </tr>
    <tr>
        <td colspan="3"><?=$resultado->interpretacion?></td>
        
    </tr>
    <tr>
        <td width='70%'>.</td>
        <td>.</td>
        <td>.</td>
    </tr>
    <?php } ?>
</table>
</diV>

<div class="subtitulo">III CONCLUSIONES</div>
<div class="afiliacion">
   <?=$model->getAttributeLabel('cuenta_buen') ?>
    
</div>
<div class="afiliacion italica">
   
    <?=$model->cuenta_buen ?>  
</div>
<div class="subtitulo">IV SUGERENCIAS</div>
<div class="afiliacion">
   <?=$model->getAttributeLabel('sugerencias') ?>
</div>
<div class="afiliacion italica">
   <?=$model->sugerencias ?>  
</div>

<div class="subtitulo">Fecha del Informe</div>
<div class="afiliacion">
 
</div>
<div class="subtitulo">Firma del psicólogo</div>
