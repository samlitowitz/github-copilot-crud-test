<?php

namespace App\Controller;

use App\Entity\SimpleTest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class SimpleController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly SerializerInterface $serializer,
        private readonly ValidatorInterface $validator
    ) {
    }

    #[Route('/simple', name: 'simple_create', methods: ['POST'])]
    public function create(): Response
    {
        $simple = new SimpleTest();
        $simple->setDescription(uniqid('simple-desc-'));

        $errors = $this->validator->validate($simple);
        if (count($errors) > 0) {
            return new Response(
                json_encode($errors),
                Response::HTTP_BAD_REQUEST,
                ['Content-Type' => 'application/json']
            );
        }

        $this->em->persist($simple);
        $this->em->flush();

        return JsonResponse::fromJsonString($this->serializer->serialize($simple, 'json'));
    }

    #[Route('/simple/{id}', name: 'simple_get', methods: ['GET'])]
    public function get(int $id): Response
    {
        $simple = $this->em->getRepository(SimpleTest::class)->find($id);
        if ($simple === null) {
            return new Response(
                json_encode(['error' => 'SimpleTest not found']),
                Response::HTTP_NOT_FOUND,
                ['Content-Type' => 'application/json']
            );
        }

        return JsonResponse::fromJsonString($this->serializer->serialize($simple, 'json'));
    }
}
