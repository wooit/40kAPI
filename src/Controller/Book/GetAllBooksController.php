<?php

namespace App\Controller\Book;

use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\Operation;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GetAllBooksController extends AbstractController
{
    /**
     * @Rest\Get(
     *     path="/api/books",
     *     name="api_get_books",
     * )
     * @Operation(summary="Read all books")
     * @OA\Tag(name="Books")
     * @OA\Response(response="200", description="ok")
     * @OA\Response(response="404", description="ko")
     * @OA\Response(response="500", description="ko")
     */
    public function readAllBooks(BookRepository $bookRepository, SerializerInterface $serializer): Response
    {
        $books = $bookRepository->findAll();

        $json = $serializer->serialize($books,'json', null);

        return new Response($json, 200, [
            "Content-Type" => "application/json"
        ]);
    }
}