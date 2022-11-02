<?php

namespace App\Controller\Author;

use App\Repository\AuthorRepository;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class getAllAuthorsController extends AbstractController
{
    /**
     * @param AuthorRepository $authorRepository
     * @return void
     * @OA\Get(
     *     path="/api/dd",
     * )
     */
    public function readALlAuthors(AuthorRepository $authorRepository) : Response
    {
        $authors = $authorRepository->findAll();
        return $this->json($authors);
    }
}