<?php
require 'app/model/DocumentModel.php';
require 'vendor/autoload.php'; // Charge FPDF et FPDI via Composer
use setasign\Fpdi\Fpdi;

class Creer_dossierController {
    private $pdo;
    private $documentModel;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->documentModel = new DocumentModel($pdo); // Initialiser le modèle pour les documents
    }

    public function afficherCreer_dossier($userId) {
        require 'app/view/pages/creer_dossier.php';
    }

    public function traiterFichiers($userId) {
        // Dossier de stockage pour cet utilisateur
        $baseDirectory = "app/view/asset/documents/dossier_user_" . $userId . "/";
        $this->createDirectoryIfNotExists($baseDirectory);

        // Sections de fichiers
        $sections = [
            'identite' => [$_FILES['file_identite'] ?? null],
            'scolarite' => [$_FILES['file_scolarite'] ?? null],
            'rib_locataire' => [$_FILES['file_rib_locataire'] ?? null],
            'garant_moral' => [$_FILES['file_garant_moral'] ?? null],
            'garant_identite' => [$_FILES['file_garant_identite'] ?? null],
            'garant_rib' => [$_FILES['file_garant_rib'] ?? null],
            'garant_domicile' => [$_FILES['file_garant_domicile'] ?? null],
            'garant_impot' => [$_FILES['file_garant_impot'] ?? null],
        ];

        $pdfPaths = []; // Liste pour stocker les chemins des fichiers PDF

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
                $pdfPath = $this->createPdfForSection($sectionName, $baseDirectory);
                if ($pdfPath) {
                    $pdfPaths[] = $pdfPath;
                }
            }
        }

        // Nettoyer le dossier pour ne garder que les fichiers PDF
        $this->cleanUpDirectory($baseDirectory);

        // Stocker les fichiers PDF dans la base de données
        $this->storePdfsInDatabase($userId, $pdfPaths);

        // Redirection après traitement
        header("Location: ?page=mon_dossier");
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
                $newFileName = $sectionName . "_" . uniqid() . '.' . $fileExtension;
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

        $files = glob($sectionDirectory . "*");
        if (empty($files)) {
            echo "Aucun fichier pour créer le PDF dans la section : $sectionName<br>";
            return null;
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

        $outputPath = $baseDirectory . $sectionName . ".pdf";
        $pdf->Output('F', $outputPath);
        echo "PDF généré pour la section $sectionName : $outputPath<br>";
        return $outputPath;
    }

    // Fonction pour nettoyer les fichiers inutiles dans un dossier
    private function cleanUpDirectory($baseDirectory) {
        $files = glob($baseDirectory . '*');
        foreach ($files as $file) {
            if (is_dir($file)) {
                // Supprimer récursivement les sous-dossiers
                array_map('unlink', glob("$file/*.*"));
                rmdir($file);
            } elseif (strtolower(pathinfo($file, PATHINFO_EXTENSION)) !== 'pdf') {
                // Supprimer les fichiers non PDF
                unlink($file);
            }
        }
    }

    // Stocker les fichiers PDF dans la base de données
    private function storePdfsInDatabase($userId, $pdfPaths) {
        $dossierId = $this->getOrCreateDossier($userId);
    
        foreach ($pdfPaths as $pdfPath) {
            // Extraire le nom du fichier à partir du chemin
            $nomFichier = pathinfo($pdfPath, PATHINFO_FILENAME);
    
            // Utiliser la méthode du modèle pour insérer le document
            $this->documentModel->insererDocument($nomFichier, $pdfPath, $dossierId);
        }
    }

    // Créer ou récupérer un dossier pour l'utilisateur
    private function getOrCreateDossier($userId) {
        $stmt = $this->pdo->prepare("SELECT id_dossier FROM dossier WHERE utilisateur_id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();

        $dossier = $stmt->fetch();
        if ($dossier) {
            return $dossier['id_dossier'];
        } else {
            // Si le dossier n'existe pas, on le crée
            $stmt = $this->pdo->prepare("INSERT INTO dossier (statut, utilisateur_id) VALUES ('incomplet', :user_id)");
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();
            return $this->pdo->lastInsertId();
        }
    }
    

    // Fonction utilitaire pour créer un dossier s'il n'existe pas
    private function createDirectoryIfNotExists($directory) {
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
    }
}
