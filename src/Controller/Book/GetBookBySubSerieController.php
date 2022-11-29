<?php

namespace App\Controller\Book;

use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use App\Repository\FactionRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\Operation;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GetBookBySubSerieController extends AbstractController
{
    /**
     * @Rest\Get(
     *     path="/api/books/subSerie/{subSerie}",
     *     name="api_get_books_from_selected_subSeries",
     * )
     * @Operation(summary="Read the selected books from the choosen sub serie")
     * @OA\Tag(name="Books")
     * @OA\Response(response="200", description="ok")
     * @OA\Response(response="404", description="ko")
     * @OA\Response(response="500", description="ko")
     */
    public function readSelectedBookByItsSubSerie(BookRepository $bookRepository, SerializerInterface $serializer, string $subSerie): Response
    {
        $books = $bookRepository->findBy(['subSerie' => $subSerie]);

        $json = $serializer->serialize($books,'json', null);

        return new Response($json, 200, [
            "Content-Type" => "application/json"
        ]);
    }
}