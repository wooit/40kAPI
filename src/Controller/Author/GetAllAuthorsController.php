<?php

namespace App\Controller\Author;

use App\Repository\AuthorRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\Operation;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GetAllAuthorsController extends AbstractController
{
    /**
     * @Rest\Get(
     *     path="/api/authors",
     *     name="api_get_authors",
     * )
     * @Operation(summary="Read all authors")
     * @OA\Tag(name="Authors")
     * @OA\Response(response="200", description="ok")
     * @OA\Response(response="404", description="ko")
     * @OA\Response(response="500", description="ko")
     */
    public function readALlAuthors(AuthorRepository $authorRepository, SerializerInterface $serializer): Response
    {
        $authors = $authorRepository->findAll();

        $json = $serializer->serialize($authors,'json', null);

        return new Response($json, 200, [
            "Content-Type" => "application/json"
        ]);
    }
}