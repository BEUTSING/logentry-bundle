LogEntryBundle est un bundle Symfony permettant de journaliser les actions des utilisateurs dans une application.

Il permet d'enregistrer :

✅ L'utilisateur (ou anonymous)

✅ L'action effectuée ( CREATE, UPDATE, DELETE, etc.)

✅ L'entité concernée

✅ Un message descriptif

✅ La date et l'heure (via l'Entité)




** Installation
 

⚠️ Important :
Cette documentation décrit l’installation et l’utilisation du bundle en local uniquement (via Path Repository).
Le bundle n’est pas encore publié sur Packagist.
Cette procédure est donc destinée aux tests et au développement local.



1️⃣ Ajouter le bundle en local (Path Repository)

Si le bundle est en local (non publié sur Packagist), ajoute ceci dans le composer.json de votre projet Symfony :

"repositories": [
    {
        "type": "path",
        "url": "../log-entry-bundle"
    }
],


** Le chemin ../log-entry-bundledoit pointer vers le dossier de ton bundle.


2️⃣ Installer le bundle

composer require beutsing/log-entry-bundle:@dev



3️⃣ Mettre à jour la base de données

⚠️ Important :
La création de la base de données n’est pas incluse dans le bundle.
Elle est nécessaire uniquement si vous n’avez pas encore de base configurée et que vous souhaitez tester le bundle.

Créer la base si nécessaire
php bin/console doctrine:database:create


Cette étape est requise uniquement si aucune base de données n’existe encore dans votre projet Symfony.

Mettre à jour le schéma
php bin/console doctrine:schema:update --force

Ou si vous utilisez les migrations
php bin/console doctrine:migrations:diff
php bin/console doctrine:migrations:migrate



** Utilisation exmple

Injecte le service LogEntryServicedans

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Beutsing\LogEntryBundle\Service\LogEntryService;

class TestLogController extends AbstractController
{
    #[Route('/log-test', name: 'log_test')]
    public function index(LogEntryService $logService): Response
    {
        $logService->log(
            'CREATE',
            'Test de création de log',
            'TestLogController'
        );

        return new Response('Log créé avec succès !');
    }
}


** Méthode disponible


log(string $action, string $message, ?string $entityName = null): void

Paramètres :
Paramètre	Description
$action	Type d'action (CRÉER, METTRE À JOUR, SUPPRIMER…)
$message	Message descriptif
$entityName	Nom de l'entité concernée (optionnel)


** Fonctionnement interne

Le service :

Récupère l'utilisateur connecté viaSecurity

Crée une entitéLogEntry

Persiste automatiquement en base via Doctrine

Sauvegarde immédiate avecflush()

** Compatibilité

PHP ≥ 8.2

Symfony ≥ 7.4

Doctrine ORM ≥ 3.0

🛠 Exemple dans un Service
$this->logEntryService->log(
    'UPDATE',
    'Produit modifié: '.$product->getProductname(),
    Product::class
);
