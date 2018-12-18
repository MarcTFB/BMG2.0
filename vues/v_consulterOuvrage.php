<div id="content">
    <h2>Gestion des ouvrages</h2>
    <div id="object-list">          
        <div class="corps-form">
            <fieldset>
                <legend>Consulter un ouvrage</legend>                        
                <div id="breadcrumb">
                    <a href="index.php?uc=gererOuvrages&action=ajouterOuvrage">Ajouter</a>&nbsp;
                    <a href="index.php?uc=gererOuvrages&action=modifierOuvrage&id=<?php echo $leOuvrage->getNum() ?>">Modifier</a>&nbsp;
                    <a href="index.php?uc=gererOuvrages&action=supprimerOuvrage&id=<?php echo $leOuvrage->getNum() ?>">Supprimer</a>
                </div>
                <table>
                    <tr>
                        <td class="h-entete">
                            Id :
                        </td>
                        <td class="h-valeur">
                            <?php echo $id ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="h-entete">
                            Titre :
                        </td>
                        <td class="h-valeur">
                            <?php echo $leOuvrage->getTitre() ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="h-entete">
                            Salle :
                        </td>
                        <td class="h-valeur">
                            <?php echo $leOuvrage->getSalle() ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="h-entete">
                            Rayon :
                        </td>
                        <td class="h-valeur">
                            <?php echo $leOuvrage->getRayon() ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="h-entete">
                            Code du genre :
                        </td>
                        <td class="h-valeur">
                            <?php echo $leOuvrage->getCode_genre() ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="h-entete">
                            date d'acquisition :
                        </td>
                        <td class="h-valeur">
                            <?php echo $leOuvrage->getAcquisition() ?>
                        </td>
                    </tr>
                </table>
            </fieldset>                    
        </div>
    </div>
</div>