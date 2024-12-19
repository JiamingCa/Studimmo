<!-- Popup -->
<div id="popup-contacter" class="popup-overlay">
    <div class="popup-content">
        <button class="close-popup" onclick="togglePopup()">✖</button>
        <div class="popup-container">
            <!-- Left: Contact Form -->
            <div class="popup-left">
                <h2>Contacter le propriétaire</h2>
                <p>NB : Le propriétaire refuse le démarchage commercial.</p>
                <form>
                    <div class="form-group">
                        <label for="prenom">Votre prénom</label>
                        <input type="text" id="prenom" placeholder="Prénom">
                    </div>
                    <div class="form-group">
                        <label for="nom">Votre nom</label>
                        <input type="text" id="nom" placeholder="Nom">
                    </div>
                    <div class="form-group">
                        <label for="email">Votre e-mail</label>
                        <input type="email" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="telephone">Votre téléphone</label>
                        <input type="tel" id="telephone" placeholder="Téléphone">
                    </div>
                    <div class="form-group">
                        <label for="message">Votre message</label>
                        <textarea id="message" placeholder="Indiquez votre situation"></textarea>
                        <small>0 / 1000 caractères</small>
                    </div>
                    <button type="submit" class="btn-envoyer">Envoyer votre message</button>
                </form>
            </div>

            <!-- Divider -->
            <div class="popup-divider"></div>

           <!-- Right: Document Requirements -->
            <div class="popup-right">
                <h2>Préparer votre dossier</h2>
                <p class="intro-text">Pour augmenter vos chances d'obtenir ce logement, préparez les documents suivants :</p>
                <ul class="documents-list">
                    <li>
                        <i class="fas fa-id-card"></i>
                        <div>
                            <strong>Pièce d’identité</strong>
                            <p>Carte d’identité, passeport ou carte de séjour.</p>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-school"></i>
                        <div>
                            <strong>Justificatif de scolarité</strong>
                            <p>Attestation d’inscription ou certificat étudiant.</p>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-university"></i>
                        <div>
                            <strong>RIB</strong>
                            <p>Relevé d’identité bancaire.</p>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-file-invoice"></i>
                        <div>
                            <strong>Dernier avis d’imposition</strong>
                            <p>Ou justificatif de non-imposition.</p>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-money-check"></i>
                        <div>
                            <strong>Bulletins de salaire</strong>
                            <p>Les trois derniers (si applicable).</p>
                        </div>
                    </li>
               <!-- <li>
                        <i class="fas fa-user-shield"></i>
                        <div>
                            <strong>Documents du garant</strong>
                            <p>Identité, RIB, bulletins de salaire, etc.</p>
                        </div>
                    </li> -->
                </ul>
                <button class="btn-dossier" onclick="location.href='creer_dossier.php'">
                    Créer mon dossier
                </button>
            </div>

        </div>
    </div>
</div>

<script>
    function togglePopup() {
        const popup = document.getElementById('popup-contacter');
        popup.style.display = popup.style.display === 'flex' ? 'none' : 'flex';
    }
</script>