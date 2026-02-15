<?php
namespace Beutsing\LogEntryBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Beutsing\LogEntryBundle\Entity\LogEntry;

class LogEntryService
{
    public function __construct(
        private Security $security,
        private EntityManagerInterface $entityManager
    ) {}

    public function log(
        string $action,
        string $message,
        ?string $entityName = null
    ): void {
        $user = $this->security->getUser();

        $log = new LogEntry();
        $log->setUserIdentifier(
            $user ? $user->getUserIdentifier() : 'anonymous'
        );
        $log->setAction($action);
        $log->setEntityName($entityName);
        $log->setMessage($message);

        $this->entityManager->persist($log);
        $this->entityManager->flush();
    }
}
