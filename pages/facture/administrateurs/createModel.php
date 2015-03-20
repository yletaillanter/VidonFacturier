<?php
/********************************************
* listeDossiers.php                         *
* Affiche tous les dossiers en liste        *
*                                           *
* Auteurs : Anne-Sophie Balestra            *
*           Abdoul Wahab Haidara            *
*           Yvan-Christian Maso             *
*           Baptiste Quere                  *
*           Yoann Le Taillanter             *
*                                           *
* Date de creation : 06/02/2015             *
********************************************/
require '../../../BDD/SPDO.php';

$pdo = new SPDO();
/*$stmt_nom = "SELECT nom_id, nom_code FROM nomenclature ORDER BY nom_code";
$result_nom = $pdo->prepare($stmt_nom);
$result_nom->execute();

$stmt_ope = "SELECT t_ope_id, t_ope_libelle FROM type_operation";
$result_ope = $pdo->prepare($stmt_ope);
$result_ope->execute();

$stmt_t_dos_ent = "SELECT DISTINCT(t_dos_entite) FROM type_dossier ORDER BY t_dos_entite";
$result_t_dos_ent = $pdo->prepare($stmt_t_dos_ent);
$result_t_dos_ent->execute();*/

$stmt_type_dossier = "SELECT DISTINCT(t_dos_type) FROM type_dossier ORDER BY t_dos_type";
$result_type_dossier = $pdo->prepare($stmt_type_dossier);
$result_type_dossier->execute();

?>
<!-- Contenu principal de la page -->
<div class="container">
    <form id="formNewModel" action="index.php?action=insertModel" method="post" role="form" data-toggle="validator"> 
        <h2>Nouveau Mod�le</h2>        
        <div>
            <fieldset><legend>Etape1</legend>
            <label class="control-label" for="operation">Nom du mod�le :</label>
          	<input type="text" name="ModelName" required>
    <br/>
        	<label class="control-label" for="operation">Zone g�ographique :</label>
          	<input type="radio" name="area" value="France" checked>France
          	<input type="radio" name="area" value="Etranger">Etranger
          </fieldset>
        </div>
        <fieldset><legend>Etape2</legend>
        <div>
     		<label class="control-label" for="operation">Type de dossier :</label>
     		<select name="pays" id="pays" required class="form-control select2">
                <option></option>
            <?php foreach($result_type_dossier->fetchAll(PDO::FETCH_OBJ) as $type_dossier) { ?>
                <optgroup label="<?php echo $type_dossier->t_dos_type; ?>">
                   
                    <?php $stmt_type_dossier = "SELECT DISTINCT(t_dos_type) FROM type_dossier ORDER BY t_dos_type";
					$result_type_dossier = $pdo->prepare($stmt_type_dossier);
					$result_type_dossier->execute();
                    foreach($result_type_dossier->fetchAll(PDO::FETCH_OBJ) as $t_dossier) { ?>
                        <option value="<?php echo $t_dossier->t_dos_type; ?>"></option>
                    <?php } ?>
                </optgroup>
            <?php } ?>
            </select>
        </div>
        <div>
        	<label class="control-label" for="operation">Objet de la facture</label>
        	<textarea name="object" rows="4" required>Saisir l'objet de la facture</textarea>
        </div>
        </fieldset>
        <div>
            <label class="control-label" for="pays">Langue</label>
            <input type="text" name="language" value="Fran�ais">
            <label class="control-label" for="prestation">TVA</label>
            <input type="number" name="TVA" value="20" >
        </div>
        
        
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $("#operation").select2({
            placeholder: "Choisissez une opération..."
        });
        $("#ent_dossier").select2({
            placeholder: "Choisissez une entité..."
        });
        $("#type_dossier").select2({
            placeholder: "Choisissez un type..."
        });
        $("#nom_code").select2({
            placeholder: "Choisissez un code..."
        });
        $("#pays").select2({
            placeholder: "Choisissez un pays..."
        });
    });
</script>