<?php

namespace App\Repository;

use App\Entity\Developer;
use App\Entity\ProjectManager;
use App\Entity\Tester;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use mysql_xdevapi\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    private $validator;

    public function __construct(
        ManagerRegistry $registry,
        ValidatorInterface $validator
    )
    {
        $this->validator = $validator;
        parent::__construct($registry, User::class);
    }

    public function getUser($id): User
    {
        $em = $this->getEntityManager();
        return $em->getRepository(User::class)->find($id);
    }

    public function createUser($position = 1): ?User
    {
        switch($position) {
            case 1:
                return new Tester();
            case 2:
                return new Developer();
            case 3:
                return new ProjectManager();
        }
        throw new Exception('There is no passed position');
    }

    public function setUpFromRequestUser(User $user, Request $request): User
    {
        $em = $this->getEntityManager();
        $r = $request->request;
        $user->setFirstName($r->get('firstName'));
        $user->setLastName($r->get('lastName'));
        $user->setEmail($r->get('email'));
        $user->setDescription($r->get('description'));
        $user->setPosition($em->getRepository(\App\Entity\Position::class)->find($r->get('position')));

        if ($user->getPosition()->getName() === 'tester') {
            /** @var Tester $user */
            $user->setReportSystems($r->get('reportSystems'));
            $user->setTestSystems($r->get('testSystems'));
            $user->setIsSelenium($r->get('isSelenium') == '1');
        }

        if ($user->getPosition()->getName() === 'developer') {
            /** @var Developer $user */
            $user->setIdeEnvironments($r->get('ideEnvironments'));
            $user->setProgramingLanguages($r->get('programingLanguages'));
            $user->setIsSql($r->get('isSql') == '1');
        }

        if ($user->getPosition()->getName() === 'project manager') {
            /** @var ProjectManager $user */
            $user->setReportSystems($r->get('reportSystems'));
            $user->setProjectMethodology($r->get('projectMethodology'));
            $user->setIsScrum($r->get('isScrum') == '1');
        }

        return $user;
    }

    public function validateUser($user): array
    {
        $errors = $this->validator->validate($user);
        $re = [];
        if (count($errors) > 0) {
            foreach($errors as $error) {
                $re[$error->getPropertyPath()] = $error->getMessage();
            }
        }
        return $re;
    }

    public function saveUser($user): void
    {
        $em = $this->getEntityManager();
        $em->persist($user);
        $em->flush();
    }
}
