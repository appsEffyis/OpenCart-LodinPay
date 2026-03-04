# 🎯 BANNIÈRE PRINCIPALE MARKETPLACE - 710x380px

## 📐 SPÉCIFICATIONS OPENCART MARKETPLACE

### Exigences:
- **Dimensions**: 710 x 380 pixels (EXACT)
- **Taille fichier**: < 500 KB (IMPORTANT!)
- **Format**: PNG ou JPG
- **Usage**: Page d'info extension + Featured list

---

## 🎨 PROMPT POUR GÉNÉRER LA BANNIÈRE 710x380

### Pour Midjourney / DALL-E / Stable Diffusion:

```
Professional payment gateway banner for OpenCart marketplace, 710x380 pixels, modern corporate design. 
Left side: "LodinPay" logo in bold navy blue (#1E3A8A) with checkmark icon. 
Center: Young professional woman smiling while using smartphone for mobile payment, 
holding phone showing clean payment interface with credit card icons. 
Right side: Large bold text "Payment Gateway", subtitle "Accept instant payments" in smaller font. 
Top right corner: Small yellow badge "Real-Time Notifications". 
Background: Clean white with subtle light blue gradient. 
Professional, trustworthy, clean aesthetic. Flat modern design. 
High quality but optimized for web. --ar 71:38 --style professional --quality 1
```

---

## 🎨 PROMPT ALTERNATIF (Plus Simple)

```
Clean payment gateway banner, 710x380 pixels. 
Left: "LodinPay" wordmark in gradient blue. 
Center: Smartphone mockup showing payment interface. 
Right: "Instant Payment Gateway" headline, "Secure • Fast • Easy" tagline. 
White background, minimal design, professional fintech aesthetic. 
Optimized for web, clean and simple. --ar 71:38 --style minimal
```

---

## 📏 CRÉER AVEC CANVA (RECOMMANDÉ)

### Étapes:

1. **Va sur**: https://www.canva.com/

2. **Crée un design personnalisé**:
   - Clique "Create a design"
   - Sélectionne "Custom size"
   - Entre: **710 x 380** pixels
   - Clique "Create new design"

3. **Design la bannière**:
   - Cherche "payment banner" dans les templates
   - Ou commence vide
   - Ajoute:
     * Logo/Texte "LodinPay" (gauche)
     * Image personne avec téléphone (centre)
     * Texte "Payment Gateway" (droite)
     * Badge "Real-Time Notifications" (coin)

4. **Télécharge**:
   - Clique "Share" → "Download"
   - Format: **PNG**
   - Qualité: **Standard** (pas High, pour rester sous 500KB)
   - Télécharge

5. **Vérifie la taille**:
   - Clique droit sur le fichier → Propriétés
   - Si > 500KB, voir section "Réduire la taille" ci-dessous

---

## 📦 RÉDUIRE LA TAILLE DU FICHIER (< 500KB)

### Méthode 1: Avec Canva
1. Télécharge en **JPG** au lieu de PNG
2. Qualité: **Standard** (pas High)
3. Généralement < 200KB

### Méthode 2: Avec TinyPNG (En ligne - Gratuit)
1. Va sur: https://tinypng.com/
2. Upload ton image PNG
3. Télécharge la version compressée
4. Réduit de 50-70% sans perte visible

### Méthode 3: Avec Paint (Windows)
1. Ouvre l'image dans Paint
2. Fichier → Enregistrer sous → JPEG
3. Ajuste la qualité si nécessaire
4. Sauvegarde

### Méthode 4: Avec Photoshop/GIMP
1. Ouvre l'image
2. Fichier → Exporter → Enregistrer pour le Web
3. Format: JPEG
4. Qualité: 80-85%
5. Sauvegarde

### Méthode 5: Avec un outil en ligne
**Compressor.io**: https://compressor.io/
- Upload ton image
- Compression automatique
- Télécharge (généralement < 300KB)

---

## 🎯 TEMPLATE LAYOUT POUR 710x380

```
┌────────────────────────────────────────────────────────────┐
│  [LOGO]                                        [BADGE]     │
│  LodinPay                              Real-Time           │
│                                        Notifications       │
│                                                            │
│         [IMAGE: Person with phone]                         │
│                                                            │
│                                                            │
│  Payment Gateway                                           │
│  Accept instant payments                                   │
└────────────────────────────────────────────────────────────┘
```

---

## 📝 ÉLÉMENTS À INCLURE

### Texte Principal:
- **"LodinPay"** (grand, gauche)
- **"Payment Gateway"** (grand, droite ou centre-bas)

### Texte Secondaire:
- **"Accept instant payments"** (sous Payment Gateway)
- **"Real-Time Notifications"** (badge, coin supérieur droit)

### Visuels:
- Logo/Icône LodinPay
- Image personne avec smartphone (optionnel)
- Icônes: checkmark, carte bancaire, shield (optionnel)

### Couleurs:
- Primary: #1E3A8A (Navy Blue)
- Secondary: #3B82F6 (Blue)
- Accent: #10B981 (Green) ou #F59E0B (Yellow pour badge)
- Background: #FFFFFF (White)

---

## ✅ CHECKLIST AVANT UPLOAD

- [ ] Dimensions: EXACTEMENT 710 x 380 pixels
- [ ] Taille fichier: < 500 KB
- [ ] Format: PNG ou JPG
- [ ] Texte "LodinPay" visible et lisible
- [ ] Design professionnel
- [ ] Pas de fautes d'orthographe
- [ ] Pas de contenu protégé par copyright
- [ ] Qualité suffisante (pas pixelisé)

---

## 🔍 VÉRIFIER LES DIMENSIONS ET LA TAILLE

### Sur Windows:

```powershell
# Vérifier les dimensions
# Clique droit sur l'image → Propriétés → Détails
# Largeur: 710 pixels
# Hauteur: 380 pixels

# Vérifier la taille du fichier
# Clique droit → Propriétés → Général
# Taille: < 500 KB (512,000 bytes)
```

### Script PowerShell pour vérifier:

```powershell
$imagePath = "C:\chemin\vers\lodinpay-banner-710x380.png"

# Charger l'image
Add-Type -AssemblyName System.Drawing
$img = [System.Drawing.Image]::FromFile($imagePath)

# Vérifier dimensions
Write-Host "Dimensions: $($img.Width) x $($img.Height) pixels"

# Vérifier taille fichier
$size = (Get-Item $imagePath).Length / 1KB
Write-Host "Taille: $([math]::Round($size, 2)) KB"

# Validation
if ($img.Width -eq 710 -and $img.Height -eq 380) {
    Write-Host "✓ Dimensions correctes!" -ForegroundColor Green
} else {
    Write-Host "✗ Dimensions incorrectes!" -ForegroundColor Red
}

if ($size -lt 500) {
    Write-Host "✓ Taille OK!" -ForegroundColor Green
} else {
    Write-Host "✗ Taille trop grande! Compresse l'image." -ForegroundColor Red
}

$img.Dispose()
```

---

## 🎨 EXEMPLES DE DESIGN

### Style 1: Professionnel avec Photo
```
- Gauche: Logo LodinPay + nom
- Centre: Photo personne avec smartphone
- Droite: Texte "Payment Gateway"
- Coin: Badge "Real-Time"
- Fond: Blanc avec gradient bleu léger
```

### Style 2: Minimaliste
```
- Gauche: Logo LodinPay
- Centre: Mockup smartphone avec interface
- Droite: Texte + icônes features
- Fond: Blanc pur
```

### Style 3: Coloré
```
- Fond: Gradient bleu
- Centre: Logo + texte blanc
- Icônes: Checkmarks, shield, lightning
- Style: Moderne et dynamique
```

---

## 🚀 PROCESSUS COMPLET

### 1. Génération (Choisis une option):

**Option A: IA (5 min)**
- Copie le prompt dans ChatGPT/Midjourney
- Génère l'image
- Télécharge

**Option B: Canva (15 min)**
- Crée design 710x380px
- Personnalise
- Télécharge

**Option C: Fiverr (24-48h, 5-10€)**
- Commande sur Fiverr
- Fournis les specs
- Reçois le fichier

### 2. Vérification:
- Dimensions: 710x380px ✓
- Taille: < 500KB ✓

### 3. Compression (si nécessaire):
- Upload sur TinyPNG
- Télécharge version compressée

### 4. Upload sur marketplace:
- Section "Images"
- Upload la bannière 710x380
- Sauvegarde

---

## 💡 ASTUCES POUR RESTER SOUS 500KB

### Pour PNG:
- Utilise moins de couleurs (256 couleurs max)
- Évite les dégradés complexes
- Utilise des aplats de couleur
- Compresse avec TinyPNG

### Pour JPG:
- Qualité 80-85% suffit
- Évite les zones très détaillées
- Fond uni plutôt que photo
- JPG généralement < 200KB

### Recommandation:
**Utilise JPG qualité 85%** - Meilleur compromis qualité/taille

---

## 📂 NOM DU FICHIER

Sauvegarde comme:
```
lodinpay-banner-710x380.jpg
ou
lodinpay-marketplace-banner.jpg
```

---

## ✅ RÉSUMÉ RAPIDE

1. **Crée sur Canva**: 710x380px
2. **Télécharge en JPG**: Qualité Standard
3. **Vérifie**: < 500KB
4. **Si trop gros**: Compresse sur TinyPNG
5. **Upload**: Sur marketplace OpenCart

**Temps total**: 15-20 minutes

---

**Commence maintenant avec Canva - c'est le plus simple!**
