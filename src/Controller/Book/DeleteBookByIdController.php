<?php

namespace App\Controller\Book;

use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use App\Repository\FactionRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\Operation;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DeleteBookByIdController extends AbstractController
{
    /**
     * @Rest\Delete(
     *     path="/api/books/{id}",
     *     name="api_delete_book_by_its_id",
     * )
     * @Operation(summary="Delete the selected book by its id")
     * @OA\Tag(name="Books")
     * @OA\Response(response="200", description="ok")
     * @OA\Response(response="404", description="ko")
     * @OA\Response(response="500", description="ko")
     */
    public function deleteSelectedBookByItsId(BookRepository $bookRepository, EntityManagerInterface $entityManager, SerializerInterface $serializer, int $id): Response
    {
        $book = $bookRepository->find($id);

        $entityManager->remove($book);
        $entityManager->flush();

        $json = $serializer->serialize($book,'json', null);

        return new Response($json, 200, [
            "Content-Type" => "application/json"
        ]);
    }
}