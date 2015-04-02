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
 * Date de creation : 30/01/2015             *
 ********************************************/
$pdo = new SPDO();

$stmt = "SELECT t_fac_id, t_fac_modelname, t_fac_type, t_fac_rf_ent, t_fac_rf_typdos, t_fac_rf_ope, t_fac_objet FROM type_facture";
$result_model = $pdo->prepare($stmt);
$result_model->execute();


?>

<!-- Contenu principal de la page -->
<div class="container" style="width:90%;">
    <h2>Modèles</h2>
    <table class="table table-striped table-bordered table-condensed table-hover" id="list_models">
        <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Type</th>
            <th scope="col">Entit&eacute</th>
            <th scope="col">Dossier</th>
            <th scope="col">Opération</th>
            <th scope="col">Objet</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Type</th>
            <th scope="col">Entit&eacute</th>
            <th scope="col">Dossier</th>
            <th scope="col">Opération</th>
            <th scope="col">Objet</th>
            <th scope="col">Afficher</th>
            <th scope="col">Modifier</th>
        </tr>
        </thead>
        <tbody>
        <?php /* On parcours les chantiers pour les inserer dans le tableau */
        foreach($result_model->fetchAll(PDO::FETCH_OBJ) as $models) { ?>
            <tr>
                <td><?php echo $models->t_fac_modelname; ?></td>
                <td><?php echo $models->t_fac_type; ?></td>
                <td><?php echo $models->t_fac_rf_ent; ?></td>
                <td><?php echo $models->t_fac_rf_typdos; ?></td>
                <td><?php echo $models->t_fac_rf_ope; ?></td>
                <!--<td>
                    <?php /*
                    $query = "SELECT t_lig_id from type_ligne l, type_facture t WHERE t.t_fac_id = :id_fac"; // l.t_lig_rf_typ_fac = t.t_fac_id AND 
                    $result_presta = $pdo->prepare($query);
                    $result_presta->bindParam(':id_fac', $models->t_fac_id);
                    $result_presta->execute();

                    foreach($result_presta->fetchAll(PDO::FETCH_OBJ) as $lig_presta)
                        echo '<table class="table table-striped"><tr><td>'.$lig_presta->t_lig_id.'</td></tr></table>';

                    */?>
                </td>-->
                <td><?php $models->t_fac_objet; ?></td>

                <td align=center>
                    <button class="btn btn-primary btn-sm" onclick="genererModalModelView('modalPrestation','<?php echo $models->t_fac_id; ?>');">
                        <i class="icon-plus fa fa-edit"></i> Afficher
                    </button>
                    <!--<a href="createModel.php?id=<?php echo $models->t_fac_id; ?>"><i class="icon-plus fa fa-pencil"></i></a>-->
                </td>

                <td align=center>
                    <button class="btn btn-primary btn-sm" onclick="genererModalModelUpdate('modalPrestation','<?php echo $models->t_fac_id; ?>');">
                        <i class="icon-plus fa fa-edit"></i> Modifier
                    </button>
                    <!--<a href="createModel.php?id=<?php echo $models->t_fac_id; ?>"><i class="icon-plus fa fa-pencil"></i></a>-->
                </td>
            </tr>
        <?php } ?>
        </tbody>
        <tfoot>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Type</th>
            <th scope="col">Entit&eacute</th>
            <th scope="col">Dossier</th>
            <th scope="col">Opération</th>
            <th scope="col">Objet</th>
            <th></th>
            <th></th>

        </tr>
        </tfoot>
    </table>
</div>
<script type="text/javascript" charset="utf-8">
    $('#list_models').dataTable({
        "language":{
            sProcessing:   "Traitement en cours...",
            sLengthMenu:   "Afficher _MENU_ &eacute;l&eacute;ments",
            sZeroRecords:  "Aucun &eacute;l&eacute;ment &agrave; afficher",
            sInfo:         "Affichage des &eacute;lements _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            sInfoEmpty:    "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
            sInfoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            sInfoPostFix:  "",
            sSearch:       "Rechercher&nbsp;:",
            sUrl:          "",
            "oPaginate": {
                sFirst:    "Premier",
                sPrevious: "Pr&eacute;c&eacute;dent",
                sNext:     "Suivant",
                sLast:     "Dernier"
            }
        }
    }).columnFilter({
        sPlaceHolder: "head:after",
        aoColumns: [
            {
                type: "text"
            },
            {
                type: "text"
            },
            {
                type: "text"
            },
            {
                type: "text"
            },
            {
                type: "text"
            },
            {
                type: "text"
            }
        ]

    });
</script>