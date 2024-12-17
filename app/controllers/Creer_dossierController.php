<?php

require 'vendor/autoload.php'; // Charge FPDF et FPDI via Composer
use setasign\Fpdi\Fpdi;

class Creer_dossierController {
    public function afficherCreer_dossier($userId) {
        require 'app/view/pages/creer_dossier.php';
    }

    public function traiterFichiers($userId) {
        // Dossier de stockage pour cet utilisateur
        $baseDirectory = "app/view/asset/documents/dossier_user_" . $userId . "/";
        $this->createDirectoryIfNotExists($baseDirectory);

        $garant_physique = [
            'garant_identite' => [$_FILES['file_garant_identite'] ?? null],
            'garant_rib' => [$_FILES['file_garant_rib'] ?? null],
            'garant_domicile' => [$_FILES['file_garant_domicile'] ?? null],
            'garant_impot' => [$_FILES['file_garant_impot'] ?? null],
        ];


        // Sections de fichiers
        $sections = [
            
            'identite' => [$_FILES['file_identite'] ?? null],
            'scolarite' => [$_FILES['file_scolarite'] ?? null],
            'rib_locataire' => [$_FILES['file_rib_locataire'] ?? null],
            'garant_moral' => [$_FILES['file_garant_moral'] ?? null]
        ];

        // Parcourir chaque section et traiter les fichiers
        foreach ($sections as $sectionName => $fileArrays) {
            $hasFiles = false;

            foreach ($fileArrays as $fileArray) {
                if ($this->isValidFileArray($fileArray)) {
                    $this->storeUploadedFiles($sectionName, $fileArray, $baseDirectory);
                    $hasFiles = true;
                }
            }

            // Créer le PDF uniquement si des fichiers valides existent pour la section
            if ($hasFiles) {
                $this->createPdfForSection($sectionName, $baseDirectory);
            }
        }

         // Parcourir chaque section et traiter les fichiers
         foreach ($garant_physique as $sectionName => $fileArrays) {
            $hasFiles = false;

            foreach ($fileArrays as $fileArray) {
                if ($this->isValidFileArray($fileArray)) {
                    $this->garantUploadedFiles($sectionName, $fileArray, $baseDirectory);
                    $hasFiles = true;
                }
            }

            // Créer le PDF uniquement si des fichiers valides existent pour la section
            if ($hasFiles) {
                $this->createPdfForSection('garant_physique', $baseDirectory);
            }
        }

        // Redirection après traitement
        header("Location: ?page=confirmation");
        exit;
    }

    // Vérifie si un tableau de fichier est valide
    private function isValidFileArray($fileArray) {
        return $fileArray && isset($fileArray['name']) && is_array($fileArray['name']) && $fileArray['error'][0] === UPLOAD_ERR_OK;
    }

    // Fonction pour déplacer les fichiers dans un dossier
    private function storeUploadedFiles($sectionName, $fileArray, $baseDirectory) {
        $sectionDirectory = $baseDirectory . $sectionName . "/";
        $this->createDirectoryIfNotExists($sectionDirectory);
        

        foreach ($fileArray['name'] as $index => $fileName) {
            if ($fileArray['error'][$index] === UPLOAD_ERR_OK) {
                $tmpFilePath = $fileArray['tmp_name'][$index];
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                $newFileName = $sectionName  . "_" . uniqid() . '.'. $fileExtension;
                $destinationPath = $sectionDirectory . $newFileName;

                if (move_uploaded_file($tmpFilePath, $destinationPath)) {
                    echo "Fichier déplacé : $destinationPath<br>";
                } else {
                    echo "Erreur lors du déplacement de : $fileName<br>";
                }
            }
        }
    }
    private function garantUploadedFiles($sectionName, $fileArray, $baseDirectory) {
        $sectionDirectory = $baseDirectory . 'garant_physique' . "/";
        $this->createDirectoryIfNotExists($sectionDirectory);
        

        foreach ($fileArray['name'] as $index => $fileName) {
            if ($fileArray['error'][$index] === UPLOAD_ERR_OK) {
                $tmpFilePath = $fileArray['tmp_name'][$index];
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                $newFileName = $sectionName  . "_" . uniqid() .'.'.$fileExtension;
                $destinationPath = $sectionDirectory . $newFileName;

                if (move_uploaded_file($tmpFilePath, $destinationPath)) {
                    echo "Fichier déplacé : $destinationPath<br>";
                } else {
                    echo "Erreur lors du déplacement de : $fileName<br>";
                }
            }
        }
    }

    

    // Fonction pour créer un PDF à partir des fichiers d'une section
    private function createPdfForSection($sectionName, $baseDirectory) {
        $pdf = new FPDI();
        $sectionDirectory = $baseDirectory . $sectionName . "/";
        $pdfDirectory = $baseDirectory . "pdfs/";
        $this->createDirectoryIfNotExists($pdfDirectory);

        $files = glob($sectionDirectory . "*");
        if (empty($files)) {
            echo "Aucun fichier pour créer le PDF dans la section : $sectionName<br>";
            return;
        }

        foreach ($files as $filePath) {
            $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
            $pdf->AddPage();

            if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                $pdf->Image($filePath, 10, 10, 190);
            } elseif ($extension === 'pdf') {
                $pageCount = $pdf->setSourceFile($filePath);
                for ($i = 1; $i <= $pageCount; $i++) {
                    $tplId = $pdf->importPage($i);
                    $pdf->AddPage();
                    $pdf->useTemplate($tplId, 10, 10, 190);
                }
            }
        }

        $outputPath = $pdfDirectory . $sectionName . ".pdf";
        $pdf->Output('F', $outputPath);
        echo "PDF généré pour la section $sectionName : $outputPath<br>";
    }

    // Fonction utilitaire pour créer un dossier s'il n'existe pas
    private function createDirectoryIfNotExists($directory) {
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
    }
}
