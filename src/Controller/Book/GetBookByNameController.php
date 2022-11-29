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

class GetBookByNameController extends AbstractController
{
    /**
     * @Rest\Get(
     *     path="/api/books/name/{name}",
     *     name="api_get_book_by_its_name",
     * )
     * @Operation(summary="Read the selected book by its name")
     * @OA\Tag(name="Books")
     * @OA\Response(response="200", description="ok")
     * @OA\Response(response="404", description="ko")
     * @OA\Response(response="500", description="ko")
     */
    public function readSelectedBookByItsName(BookRepository $bookRepository, SerializerInterface $serializer, string $name): Response
    {
        $book = $bookRepository->findOneBy(['name' => $name]);

        $json = $serializer->serialize($book,'json', null);

        return new Response($json, 200, [
            "Content-Type" => "application/json"
        ]);
    }
}