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

        // Dossier pour stocker les PDF finaux
        $pdfDirectory = $uploadDirectory . "pdf/";
        if (!is_dir($pdfDirectory)) {
            mkdir($pdfDirectory, 0755, true);
        }

        // Fonction pour créer un PDF unique par section
        function createPdfForSection($sectionName, $sectionDirectory, $pdfDirectory) {
            $pdf = new FPDI();

            // Récupérer tous les fichiers dans le sous-dossier de la section
            $files = glob($sectionDirectory . "*");

            foreach ($files as $filePath) {
                $extension = pathinfo($filePath, PATHINFO_EXTENSION);

                if (in_array(strtolower($extension), ['jpg', 'png'])) {
                    // Ajouter une image dans le PDF
                    $pdf->AddPage();
                    $pdf->Image($filePath, 10, 10, 190); // Ajuster les dimensions si nécessaire
                } elseif (strtolower($extension) === 'pdf') {
                    // Importer un fichier PDF existant
                    $pageCount = $pdf->setSourceFile($filePath);
                    for ($i = 1; $i <= $pageCount; $i++) {
                        $tplId = $pdf->importPage($i);
                        $pdf->AddPage();
                        $pdf->useTemplate($tplId, 10, 10, 190);
                    }
                }
            }

            // Sauvegarder le PDF final
            $outputPath = $pdfDirectory . $sectionName . ".pdf";
            $pdf->Output('F', $outputPath);

            return $outputPath;
        }

        // Parcourez chaque section et gérez les fichiers
        $sections = [
            'identite' => $_FILES['file_identite'],
            'scolarite' => $_FILES['file_scolarite'],
            'rib_locataire' => $_FILES['file_rib_locataire']
        ];

        foreach ($sections as $sectionName => $fileArray) {
            // Créer un sous-dossier pour chaque section
            $sectionDirectory = $uploadDirectory . $sectionName . "/";
            if (!is_dir($sectionDirectory)) {
                mkdir($sectionDirectory, 0755, true);
            }

            // Vérifiez si des fichiers ont été uploadés pour cette section
            if (isset($fileArray['name']) && is_array($fileArray['name'])) {
                for ($i = 0; $i < count($fileArray['name']); $i++) {
                    $tmpFilePath = $fileArray['tmp_name'][$i];
                    $fileName = $fileArray['name'][$i];
                    $destination = $sectionDirectory . basename($fileName);

                    // Déplacez le fichier temporaire dans le dossier de la section
                    if (move_uploaded_file($tmpFilePath, $destination)) {
                        echo "Fichier déplacé : $destination<br>";
                    } else {
                        echo "Échec du déplacement du fichier : $fileName<br>";
                    }
                }

                // Générer un PDF avec tous les fichiers de la section
                $pdfPath = createPdfForSection($sectionName, $sectionDirectory, $pdfDirectory);
                echo "PDF pour la section $sectionName créé : $pdfPath<br>";
            } else {
                echo "Aucun fichier pour la section $sectionName.<br>";
            }
        }

        // Redirection vers une page de confirmation
        header("Location: ?page=confirmation");
        exit;
    }
}
