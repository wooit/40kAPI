<?php

namespace App\Controller\Author;

use App\Repository\AuthorRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\Operation;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GetAuthorsByNationalityController extends AbstractController
{
    /**
     * @Rest\Get(
     *     path="/api/author/nationality/{nationality}",
     *     name="api_get_authors_by_nationality",
     * )
     * @Operation(summary="Read selected authors by their nationality")
     * @OA\Tag(name="Authors")
     *
     *
     * @OA\Response(response="200", description="ok")
     * @OA\Response(response="404", description="ko")
     * @OA\Response(response="500", description="ko")
     */
    public function readSelectedAuthorsByNationality(AuthorRepository $authorRepository, SerializerInterface $serializer, string $nationality): Response
    {
        $author = $authorRepository->findBy(['nationality' => $nationality]);

        $json = $serializer->serialize($author,'json',null);

        return new Response($json, 200, [
            "Content-Type" => "application/json"
        ]);
    }
}