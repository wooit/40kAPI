<?php

namespace App\Controller\Author;

use App\Repository\AuthorRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\Operation;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GetAuthorByLasNameController extends AbstractController
{
    /**
     * @Rest\Get(
     *     path="/api/author/name/{lastName}",
     *     name="api_get_author_by_lastName",
     * )
     * @Operation(summary="Read selected author by its last name")
     * @OA\Tag(name="Authors")
     *
     *
     * @OA\Response(response="200", description="ok")
     * @OA\Response(response="404", description="ko")
     * @OA\Response(response="500", description="ko")
     */
    public function readSelectedAuthorByLastName(AuthorRepository $authorRepository, SerializerInterface $serializer, string $lastName): Response
    {
        $author = $authorRepository->findOneBy(['lastName' => $lastName]);

        $json = $serializer->serialize($author,'json',null);

        return new Response($json, 200, [
            "Content-Type" => "application/json"
        ]);
    }
}