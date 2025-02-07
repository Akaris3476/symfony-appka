<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Formatter\ApiResponseFormatter;
use App\Repository\UserRepository;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController {
    // #[Route('/api/users/show', name: 'app_user', methods: ['GET'])]
    // public function showUser(): JsonResponse
    // {
    //     $currentUser = $this->getUser();
    //     dd($currentUser);

    //     return new JsonResponse([
    //         'data' => [
    //             'user_id'=> $currentUser->getId(),
    //             'user_email' => $currentUser->getEmail()],
    //         'messages' => NULL,
    //         'errors' => NULL,
    //         'statusCode' => '200',
    //         'additionalData' => NULL
    //     ]);
    // }


    public function __construct(
        private UserRepository       $userRepository,
        private UserPasswordHasherInterface $passwordHasher,
        private ApiResponseFormatter $apiResponseFormatter
    ) {}

    #[Route('/users', name: 'app_user', methods: ['GET'])]
    public function index(): Response
    {
        $users = $this->userRepository->findAll();

        $newUsers = [];
        foreach ($users as $user) {
            $newUsers[] = (array) $user;
        }

        return $this->apiResponseFormatter
            ->withData($newUsers)
            ->response();
        }

    #[Route('/users/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(int $id){
        $user = $this->userRepository->findOneBy(['id' => $id]);

        return $this->apiResponseFormatter
            ->withData((array) $user)
            ->response();
    }

    #[Route('/users', name: 'create_user', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $requestInfo = json_decode($request->getContent(), true);

        $user = new User();
        $user->setEmail($requestInfo['email']);
        $hashedPassword = $this->passwordHasher->hashPassword($user, $requestInfo['password']);

        $user->setPassword($hashedPassword);
        

        $this->userRepository->add($user);

        return $this->apiResponseFormatter
            ->withData((array) $user)
            ->withStatus(200)
            ->response();
    }

    #[Route('/users', name: 'update_user', methods: ['PATCH'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $user = $this->userRepository->findOneBy(['id' => $id]);

        $newUserInfo = json_decode($request->getContent(), true);
        
        $user->setEmail($newUserInfo['email']);

 
        $hashedPassword = $this->passwordHasher->hashPassword($user, $newUserInfo['password']);
        $user->setPassword($hashedPassword);
        

        $this->userRepository->add($user);

        return $this->apiResponseFormatter
            ->withData((array) $user)
            ->response();
    }

    #[Route('/users', name: 'delete_user', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $user = $this->userRepository->findOneBy(['id' => $id]);
        $this->userRepository->remove($user);

        return $this->apiResponseFormatter
            ->withMessage('User deleted successfully')
            ->withData((array) $user)
            ->response();
    }

}