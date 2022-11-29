<?php

namespace App\Controller\Author;

use App\Repository\AuthorRepository;
use App\Repository\PrimarchRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\Operation;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GetAuthorByIdController extends AbstractController
{
    /**
     * @Rest\Get(
     *     path="/api/author/{id}",
     *     name="api_get_author_by_id",
     * )
     * @Operation(summary="Read selected author by its id")
     * @OA\Tag(name="Authors")
     *
     *
     * @OA\Response(response="200", description="ok")
     * @OA\Response(response="404", description="ko")
     * @OA\Response(response="500", description="ko")
     */
    public function readSelectedAuthor(AuthorRepository $authorRepository, SerializerInterface $serializer, int $id): Response
    {
        $author = $authorRepository->find($id);

        $json = $serializer->serialize($author,'json',null);

        return new Response($json, 200, [
            "Content-Type" => "application/json"
        ]);
    }
}