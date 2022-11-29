<?php

namespace App\Controller\Primarch;

use App\Repository\PrimarchRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\Operation;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DeletePrimarchByIdController extends AbstractController
{
    /**
     * @Rest\Delete(
     *     path="/api/primarchs/{id}",
     *     name="api_delete_primarch_by_id",
     * )
     * @Operation(summary="Delete the selected primarch by its id")
     * @OA\Tag(name="Primarchs")
     *
     *
     * @OA\Response(response="200", description="ok")
     * @OA\Response(response="404", description="ko")
     * @OA\Response(response="500", description="ko")
     */
    public function deleteSelectedPrimarch(PrimarchRepository $primarchRepository, EntityManagerInterface $entityManager, SerializerInterface $serializer, int $id): Response
    {
        $primarch = $primarchRepository->find($id);

        $entityManager->remove($primarch);
        $entityManager->flush();

        $json = $serializer->serialize($primarch,'json',null);

        return new Response($json, 200, [
            "Content-Type" => "application/json"
        ]);
    }
}