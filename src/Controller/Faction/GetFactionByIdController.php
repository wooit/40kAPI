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

class GetFactionByIdController extends AbstractController
{
    /**
     * @Rest\Get(
     *     path="/api/factions/{id}",
     *     name="api_get_faction_by_its_id",
     * )
     * @Operation(summary="Read the selected faction by its id")
     * @OA\Tag(name="Factions")
     * @OA\Response(response="200", description="ok")
     * @OA\Response(response="404", description="ko")
     * @OA\Response(response="500", description="ko")
     */
    public function readSelectedFactionByItsId(FactionRepository $factionRepository, SerializerInterface $serializer, int $id): Response
    {
        $faction = $factionRepository->find($id);

        $json = $serializer->serialize($faction,'json', null);

        return new Response($json, 200, [
            "Content-Type" => "application/json"
        ]);
    }
}