<?php

namespace App\Controller\Faction;

use App\Repository\AuthorRepository;
use App\Repository\FactionRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\Operation;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DeleteFactionByIdController extends AbstractController
{
    /**
     * @Rest\Delete(
     *     path="/api/factions/{id}",
     *     name="api_delete_faction_by_its_id",
     * )
     * @Operation(summary="Delete the selected faction by its id")
     * @OA\Tag(name="Factions")
     * @OA\Response(response="200", description="ok")
     * @OA\Response(response="404", description="ko")
     * @OA\Response(response="500", description="ko")
     */
    public function deleteSelectedFactionByItsId(FactionRepository $factionRepository, EntityManagerInterface $entityManager, SerializerInterface $serializer, int $id): Response
    {
        $faction = $factionRepository->find($id);

        $entityManager->remove($faction);
        $entityManager->flush();

        $json = $serializer->serialize($faction,'json', null);

        return new Response($json, 200, [
            "Content-Type" => "application/json"
        ]);
    }
}