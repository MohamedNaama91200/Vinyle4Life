<?php
namespace App\DataFixtures;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use app\Entity\Membre;
use app\Repository\MembreRepository;


class UserFixtures extends Fixture
{

    private $userPasswordHasherInterface;

    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager)
    {
        $this->LoadUsers($manager);
    }

    private function loadUsers(ObjectManager $manager)
    {
        foreach ($this->getUserData() as [
            $email,
            $plainPassword,
            $role
        ]) {
            $user = new User();
            $encodedPassword = $this->userPasswordHasherInterface->hashPassword($user, $plainPassword);
            $user->setEmail($email);
            $user->setPassword($encodedPassword);

            $roles = array();
            $roles[] = $role;
            $user->setRoles($roles);

            $manager->persist($user);
        }
        $manager->flush();
    }

    private function getUserData()
    {
        yield [
            'chris@localhost',
            'chris',
            'ROLE_USER'
        ];
        yield [
            'mohamed@localhost',
            'mohamed',
            'ROLE_ADMIN'
        ];
        foreach (self::MembreDataGenerator() as [$name, $useremail] ) {
            $membre = new Membre();
            if ($useremail) {
                $user = $manager->getRepository(User::class)->findOneByEmail($useremail);
                $membre->setUser($user);
            }
            $membre->setName($name);
            $manager->persist($membre);
        }
        $manager->flush();
        
        
        
    }
}
