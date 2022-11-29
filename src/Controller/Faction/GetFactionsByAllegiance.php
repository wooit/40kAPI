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

class GetFactionsByAllegiance extends AbstractController
{
    /**
     * @Rest\Get(
     *     path="/api/factions/allegiance/{loyalty}",
     *     name="api_get_faction_by_its_allegiance",
     * )
     * @Operation(summary="Read the selected faction by its allegiance")
     * @OA\Tag(name="Factions")
     *
     * @OA\Parameter(
     *     name="loyalty",
     *     in="path",
     *     required=true,
     *     example="Choose between 'loyalist', 'traitor' and 'unaligned'",
     * )
     *
     * @OA\Response(response="200", description="ok",
     *     @OA\JsonContent(
     *      type="object",
     *        example={"id": "1", "name": "Blood Angels", "books": "", "loyalty": "loyalist"}
     * )
     * )
     * @OA\Response(response="404", description="ko")
     * @OA\Response(response="500", description="ko")
     */
    public function readSelectedFactionByItsAllegiance(FactionRepository $factionRepository, SerializerInterface $serializer, string $loyalty): Response
    {
        $faction = $factionRepository->findBy(['loyalty'=>$loyalty]);

        $json = $serializer->serialize($faction,'json', null);

        return new Response($json, 200, [
            "Content-Type" => "application/json"
        ]);
    }
}