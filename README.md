# Beutsing LogEntry Bundle

## Description

The **Beutsing LogEntry Bundle** allows you to easily record user actions in your Symfony application.  
Every significant action (creation, modification, deletion, etc.) can be automatically or manually logged in a `log_entries` table.  

This bundle uses Doctrine ORM to persist logs and can be integrated into any Symfony 6, 7, or 8 project.

---

## Installation

1. Install the bundle via Composer:

```bash
composer require beutsing/log-entry-bundle

Create the migration for the log_entry table:

php bin/console make:migration
php bin/console doctrine:migrations:migrate

Symfony will generate a migration file like Version20260309XXXXXX.php (depending on the date and time), which will create the log_entry table in your database.

LogEntry Table Fields

The log_entry table includes the following fields:

Field	Type	Description
id	auto-increment	Unique identifier of the log
userIdentifier	string (length 180)	Identifier of the user (email, username, etc.)
companyid	string (length 180, null)	Optional company identifier
action	string (length 100)	Action performed by the user
message	string (length 255)	Descriptive message related to the action
createdAt	datetime	Date and time of log creation
Usage

The bundle provides a service to easily create log entries. Example usage:

<?php
use Beutsing\LogEntryBundle\Service\LogEntryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SomeController extends AbstractController
{
    public function someAction(LogEntryService $logService)
    {
        $logService->log(
            'CREATE_USER',                  
            'A new user has been created',  
            'COMPANY123'                     
        );

        return $this->json(['status' => 'ok']);
    }
}
Notes

The log service can be injected in any controller or service using Symfony's autowiring.

The createdAt field is automatically set when a log entry is created.

You can configure the table name and automatic logging through config/packages/beutsing_log_entry.yaml: