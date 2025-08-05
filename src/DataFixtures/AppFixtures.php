<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $userPasswordHasher) {}

    public function load(ObjectManager $manager): void
    {
        //Création des utilisateurs
        $usersData = [
            ['email' => 'user@bookapi.com', 'roles' => ['ROLE_USER']],
            ['email' => 'admin@bookapi.com', 'roles' => ['ROLE_ADMIN']],
        ];

        foreach ($usersData as $data) {
            $user = new User();
            $user->setEmail($data['email']);
            $user->setRoles($data['roles']);
            $user->setPassword($this->userPasswordHasher->hashPassword($user, 'password'));
            $manager->persist($user);
        }

        //Création des auteurs
        $authorList = [];
        for ($i = 0; $i < 10; $i++) {
            $author = new Author();
            $author->setFirstName('Prénom ' . $i);
            $author->setLastName('Nom ' . $i);
            $manager->persist($author);
            $authorList[] = $author;
        }

        //Création des livres
        for ($i = 0; $i < 20; $i++) {
            $book = new Book();
            $book->setTitle('Titre ' . $i);
            $book->setCoverText('Quatrième de couverture numéro : ' . $i);
            $book->setAuthor($authorList[array_rand($authorList)]);
            $manager->persist($book);
        }

        $manager->flush();
    }
}
