# 📸 CRÉER LES SCREENSHOTS POUR LE MARKETPLACE

## 🎯 Screenshots Requis

Tu as besoin de **minimum 3 screenshots** de qualité pour le marketplace:

1. ✅ Page de configuration admin
2. ✅ Méthode de paiement au checkout
3. ✅ Page de succès (optionnel mais recommandé)

---

## 📋 ÉTAPE PAR ÉTAPE

### Screenshot 1: Configuration Admin

#### 1. Ouvre ton OpenCart local:
```
http://localhost:9090/admin/
```

#### 2. Login:
- Username: `admin`
- Password: `admin123`

#### 3. Navigation:
```
Extensions → Extensions → (sélectionne "Payments" dans le menu déroulant) → Lodin
```

#### 4. Clique sur le bouton "Edit" (crayon bleu)

#### 5. Prends la capture:
- Appuie sur: `Windows + Shift + S`
- Sélectionne toute la page de configuration
- La capture est copiée dans le presse-papier

#### 6. Sauvegarde:
- Ouvre Paint ou un éditeur d'image
- Colle (Ctrl+V)
- Sauvegarde comme: `lodin-admin-config.png`
- Emplacement: `C:\Users\SAAD\Desktop\module prestashop (1)\opencart\marketplace\screenshots\`

---

### Screenshot 2: Checkout - Méthode de Paiement

#### 1. Ouvre la boutique:
```
http://localhost:9090/
```

#### 2. Ajoute un produit au panier:
- Clique sur n'importe quel produit
- Clique "Add to Cart"

#### 3. Va au checkout:
- Clique sur l'icône panier en haut
- Clique "Checkout"

#### 4. Remplis les informations (si demandé):
- Prénom: Test
- Nom: User
- Email: test@test.com
- Téléphone: 0600000000
- Adresse: 123 Test Street
- Ville: Paris
- Code postal: 75001
- Pays: France

#### 5. Continue jusqu'à la page "Payment Method"

#### 6. Prends la capture:
- Tu devrais voir "Lodin RTP Payment" dans les options
- Appuie sur: `Windows + Shift + S`
- Capture la section des méthodes de paiement
- Sauvegarde comme: `lodin-checkout.png`

---

### Screenshot 3: Page de Succès (Optionnel)

#### 1. Complète un paiement test

#### 2. Sur la page de confirmation:
- Prends une capture: `Windows + Shift + S`
- Sauvegarde comme: `lodin-success.png`

---

## 🎨 CONSEILS POUR DE BONS SCREENSHOTS

### Qualité:
- ✅ Résolution minimum: 1280x720
- ✅ Format: PNG (meilleure qualité)
- ✅ Pas de contenu personnel visible
- ✅ Interface propre (pas d'erreurs visibles)

### Contenu:
- ✅ Montre clairement l'extension
- ✅ Texte lisible
- ✅ Pas de données sensibles (API keys, etc.)
- ✅ Interface en anglais (si possible)

### Édition (optionnel):
- Ajoute des flèches ou annotations pour guider
- Floute les informations sensibles
- Recadre pour enlever les parties inutiles

---

## 🖼️ CRÉER UN LOGO (Optionnel mais Recommandé)

### Dimensions recommandées: 200x200px

#### Option 1: Logo Simple avec Paint
1. Ouvre Paint
2. Crée une image 200x200
3. Fond: Couleur de marque Lodin
4. Texte: "LODIN" en gros
5. Sauvegarde: `lodin-logo.png`

#### Option 2: Utilise Canva (gratuit)
1. Va sur: https://www.canva.com/
2. Crée un design 200x200px
3. Ajoute le texte "LODIN"
4. Ajoute un icône de paiement
5. Télécharge comme PNG

#### Option 3: Logo Professionnel
Si tu as déjà un logo Lodin, redimensionne-le à 200x200px

---

## 📁 ORGANISATION DES FICHIERS

Crée ce dossier:
```
C:\Users\SAAD\Desktop\module prestashop (1)\opencart\marketplace\screenshots\
```

Structure finale:
```
screenshots/
├── lodin-admin-config.png      (Obligatoire)
├── lodin-checkout.png           (Obligatoire)
├── lodin-success.png            (Optionnel)
├── lodin-logo.png               (Recommandé)
└── lodin-banner.png             (Optionnel - 800x400px)
```

---

## 🚀 SCRIPT POWERSHELL POUR CRÉER LE DOSSIER

Copie-colle ça dans PowerShell:

```powershell
# Créer le dossier screenshots
$screenshotsPath = "C:\Users\SAAD\Desktop\module prestashop (1)\opencart\marketplace\screenshots"
New-Item -ItemType Directory -Path $screenshotsPath -Force

Write-Host "Dossier cree: $screenshotsPath"
Write-Host ""
Write-Host "Maintenant:"
Write-Host "1. Ouvre http://localhost:9090/admin/"
Write-Host "2. Va dans Extensions > Payments > Lodin > Edit"
Write-Host "3. Appuie sur Windows + Shift + S"
Write-Host "4. Capture l'ecran"
Write-Host "5. Ouvre Paint et colle (Ctrl+V)"
Write-Host "6. Sauvegarde dans: $screenshotsPath\lodin-admin-config.png"
```

---

## ✅ CHECKLIST SCREENSHOTS

Avant de soumettre au marketplace:

- [ ] Screenshot 1: Admin config créé
- [ ] Screenshot 2: Checkout créé
- [ ] Screenshot 3: Success créé (optionnel)
- [ ] Logo créé (recommandé)
- [ ] Tous les fichiers en PNG
- [ ] Résolution minimum 1280x720
- [ ] Pas d'infos sensibles visibles
- [ ] Images claires et nettes

---

## 🎯 PROCHAINE ÉTAPE

Une fois les screenshots créés:
1. ✅ Ouvre `ACCES_MARKETPLACE.md`
2. ✅ Suis les étapes pour soumettre l'extension
3. ✅ Upload les screenshots lors de la soumission

**Bonne chance! 📸**
