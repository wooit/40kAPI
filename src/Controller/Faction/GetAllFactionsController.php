<?php

namespace App\Controller\Faction;

use App\Repository\AuthorRepository;
use App\Repository\FactionRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\Operation;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GetAllFactionsController extends AbstractController
{
    /**
     * @Rest\Get(
     *     path="/api/factions",
     *     name="api_get_factions",
     * )
     * @Operation(summary="Read all factions")
     * @OA\Tag(name="Factions")
     * @OA\Response(response="200", description="ok")
     * @OA\Response(response="404", description="ko")
     * @OA\Response(response="500", description="ko")
     */
    public function readALlFactions(FactionRepository $factionRepository, SerializerInterface $serializer): Response
    {
        $factions = $factionRepository->findAll();

        $json = $serializer->serialize($factions,'json', null);

        return new Response($json, 200, [
            "Content-Type" => "application/json"
        ]);
    }
}