<?php

require 'vendor/autoload.php'; // Charge FPDF et FPDI via Composer
use setasign\Fpdi\Fpdi;

class Creer_dossierController {
    public function afficherCreer_dossier($userId) {
        // Inclure la vue
        require 'app/view/pages/creer_dossier.php';
    }

    public function traiterFichiers($userId) {
        require 'vendor/autoload.php';
        
        // Dossier utilisateur
        $uploadDirectory = "uploads/dossier_user_" . $userId . "/";
        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0755, true);
        }
    
        // Dossier pour stocker le premier fichier
        $premierFichierDirectory = $uploadDirectory . "premier_fichier/";
        if (!is_dir($premierFichierDirectory)) {
            mkdir($premierFichierDirectory, 0755, true);
        }
    
        // Afficher un message de débogage
        echo "Dossier premier_fichier créé à : " . $premierFichierDirectory . "<br>";
    
        // Parcourez les sections pour traiter les fichiers
        $sections = [
            'identite' => $_FILES['file_identite'],
            'scolarite' => $_FILES['file_scolarite'],
            'rib_locataire' => $_FILES['file_rib_locataire']
        ];
    
        foreach ($sections as $sectionName => $fileArray) {
            // Vérifiez si des fichiers ont été uploadés pour cette section
            if (isset($fileArray['name']) && is_array($fileArray['name'])) {
                // Afficher le contenu de $fileArray pour débogage
                var_dump($fileArray); 
                for ($i = 0; $i < count($fileArray['name']); $i++) {
                    $tmpFilePath = $fileArray['tmp_name'][$i];
                    $fileName = $fileArray['name'][$i];
                    $destination = $uploadDirectory . $sectionName . "/" . basename($fileName);
    
                    // Déplacez le fichier temporaire dans le dossier de la section
                    echo "Déplacement du fichier : $tmpFilePath vers $destination<br>";
                    if (move_uploaded_file($tmpFilePath, $destination)) {
                        echo "Fichier déplacé dans la section $sectionName : $destination<br>";
                        
                        // Déplacez le premier fichier dans le dossier 'premier_fichier'
                        if ($i == 0) {  // Assurez-vous que c'est le premier fichier
                            $firstFileDestination = $premierFichierDirectory . basename($fileName);
                            echo "Déplacement du premier fichier vers : $firstFileDestination<br>";
                            if (move_uploaded_file($tmpFilePath, $firstFileDestination)) {
                                echo "Premier fichier déplacé dans premier_fichier : $firstFileDestination<br>";
                            } else {
                                echo "Échec du déplacement du premier fichier : $fileName<br>";
                            }
                        }
                    } else {
                        echo "Échec du déplacement du fichier : $fileName<br>";
                    }
                }
            } else {
                echo "Aucun fichier pour la section $sectionName.<br>";
            }
        }
    
        // Redirection vers une page de confirmation
        header("Location: ?page=confirmation");
        exit;
    }
    
}
