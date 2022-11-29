<?php

namespace App\Controller\Author;

use App\Repository\AuthorRepository;
use App\Repository\PrimarchRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\Operation;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DeleteAuthorByIdController extends AbstractController
{
    /**
     * @Rest\Delete(
     *     path="/api/author/{id}",
     *     name="api_delete_author_by_id",
     * )
     * @Operation(summary="Delete selected author by its id")
     * @OA\Tag(name="Authors")
     *
     *
     * @OA\Response(response="200", description="ok")
     * @OA\Response(response="404", description="ko")
     * @OA\Response(response="500", description="ko")
     */
    public function deleteSelectedAuthor(AuthorRepository $authorRepository, EntityManagerInterface $entityManager, SerializerInterface $serializer, int $id): Response
    {
        $author = $authorRepository->find($id);

        $entityManager->remove($author);
        $entityManager->flush();

        $json = $serializer->serialize($author,'json',null);

        return new Response($json, 200, [
            "Content-Type" => "application/json"
        ]);
    }
}