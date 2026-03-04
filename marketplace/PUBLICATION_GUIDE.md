# Guide de Publication - Lodin RTP Payment Extension

## Package Créé

✅ **Fichier**: `lodin-opencart-1.0.0.zip`

Ce package contient:
- Tous les fichiers de l'extension dans le dossier `lodin/`
- Structure compatible OpenCart 4.0+

## Structure du Package

```
lodin/
├── install.json                          # Métadonnées de l'extension
├── install.xml                           # Configuration OCMOD
├── admin/
│   ├── controller/payment/lodin.php      # Controller admin
│   ├── language/en-gb/payment/lodin.php  # Traductions admin
│   └── view/template/payment/lodin.twig  # Template admin
└── catalog/
    ├── controller/payment/lodin.php      # Controller frontend
    ├── model/payment/lodin.php           # Model payment
    ├── language/en-gb/payment/lodin.php  # Traductions frontend
    └── view/template/payment/lodin.twig  # Template frontend
```

## Étapes de Publication sur OpenCart Marketplace

### 1. Créer un Compte Développeur

1. Allez sur: https://www.opencart.com/index.php?route=marketplace/seller
2. Créez un compte vendeur/développeur
3. Complétez votre profil

### 2. Soumettre l'Extension

1. Connectez-vous au marketplace
2. Allez dans "My Extensions" > "Add Extension"
3. Remplissez les informations:

**Informations Générales:**
- **Name**: Lodin RTP Payment
- **Version**: 1.0.0
- **Category**: Payment Gateways
- **Price**: Free ou Paid (selon votre modèle)
- **OpenCart Version**: 4.0.0.0+

**Description:**
```
Accept instant payments via Lodin RTP (Request to Pay) on your OpenCart store.

Features:
• Instant payment link generation
• Real-time payment notifications via webhook
• Secure HMAC-SHA256 signature verification
• Support for multiple order statuses
• Easy configuration via admin panel

Requirements:
• OpenCart 4.0+
• PHP 8.1+
• Valid Lodin merchant account
```

**Installation Instructions:**
```
1. Download the extension
2. Go to Extensions > Installer
3. Upload the .zip file
4. Go to Extensions > Extensions > Payments
5. Find "Lodin RTP Payment" and click Install
6. Click Edit to configure your Lodin credentials
```

### 3. Upload des Fichiers

1. **Extension Package**: Upload `lodin-opencart-1.0.0.zip`
2. **Screenshots**: Prenez des captures d'écran de:
   - Page de configuration admin
   - Méthode de paiement dans le checkout
   - Page de paiement Lodin (si possible)
3. **Documentation**: Upload `README.md`

### 4. Informations Requises

**Support:**
- Email: support@lodinpay.com
- Documentation URL: https://docs.lodinpay.com
- Demo URL: (optionnel)

**License:**
- Type: Proprietary ou Open Source
- Terms: Définir les conditions d'utilisation

### 5. Review Process

1. Soumettez l'extension pour review
2. L'équipe OpenCart va:
   - Vérifier le code
   - Tester l'installation
   - Vérifier la sécurité
   - Valider la compatibilité
3. Délai: 5-10 jours ouvrables

### 6. Après Approbation

1. L'extension sera visible sur le marketplace
2. Les utilisateurs pourront l'installer
3. Vous recevrez des notifications pour:
   - Nouvelles installations
   - Reviews/ratings
   - Questions support

## Checklist Avant Publication

- [x] Code testé et fonctionnel
- [x] Compatible OpenCart 4.0+
- [x] Pas d'erreurs PHP
- [x] Sécurité: validation des entrées, échappement des sorties
- [x] Documentation complète
- [x] README avec instructions claires
- [x] CHANGELOG avec historique des versions
- [ ] Screenshots de qualité
- [ ] Logo de l'extension (recommandé: 200x200px)
- [ ] Vidéo de démonstration (optionnel mais recommandé)
- [ ] Support email configuré
- [ ] Politique de remboursement (si payant)

## Mise à Jour de l'Extension

Pour publier une nouvelle version:

1. Mettez à jour le numéro de version dans:
   - `install.json`
   - `install.xml`
   - `CHANGELOG.md`

2. Créez un nouveau package:
```bash
Compress-Archive -Path opencart/opencart_files/extension/lodin -DestinationPath opencart/marketplace/lodin-opencart-X.X.X.zip -Force
```

3. Uploadez sur le marketplace avec les notes de version

## Alternative: Distribution Directe

Si vous ne voulez pas passer par le marketplace:

1. **Hébergez le package** sur votre site
2. **Fournissez les instructions** d'installation manuelle
3. **Gérez le support** directement

### Installation Manuelle

Les utilisateurs devront:
1. Télécharger le .zip
2. Extraire dans `/var/www/html/extension/`
3. Ajouter manuellement dans la base de données:
```sql
INSERT INTO oc_extension_install (name, code, version, author, link, status, date_added) 
VALUES ('Lodin RTP Payment', 'lodin', '1.0.0', 'Lodin', 'https://lodinpay.com', 1, NOW());

INSERT INTO oc_extension_path (extension_install_id, path) VALUES 
(LAST_INSERT_ID(), 'lodin/admin/controller/payment/lodin.php'),
(LAST_INSERT_ID(), 'lodin/catalog/controller/payment/lodin.php'),
(LAST_INSERT_ID(), 'lodin/catalog/model/payment/lodin.php');
```

## Support et Maintenance

**Préparez-vous à:**
- Répondre aux questions des utilisateurs
- Corriger les bugs rapidement
- Maintenir la compatibilité avec les nouvelles versions OpenCart
- Fournir des mises à jour régulières

## Ressources

- OpenCart Marketplace: https://www.opencart.com/index.php?route=marketplace/extension
- Developer Documentation: https://docs.opencart.com/en-gb/developer/
- Forum: https://forum.opencart.com/
- GitHub: https://github.com/opencart/opencart

## Contact

Pour toute question sur la publication:
- Email: support@lodinpay.com
- Documentation: https://docs.lodinpay.com
