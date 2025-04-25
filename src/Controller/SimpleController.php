<?php

namespace App\Controller;

use App\Entity\SimpleTest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class SimpleController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly SerializerInterface $serializer
    ) {
    }

    #[Route('/simple', name: 'simple_create', methods: ['POST'])]
    public function createSimple(): Response
    {
        $simple = new SimpleTest();
        $simple->setDescription(uniqid('simple-desc-'));

        $this->em->persist($simple);
        $this->em->flush();

        return JsonResponse::fromJsonString($this->serializer->serialize($simple, 'json'));
    }
}
