<?php

namespace App\Controller\Primarch;

use App\Repository\PrimarchRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\Operation;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GetPrimarchByIdController extends AbstractController
{
    /**
     * @Rest\Get(
     *     path="/api/primarchs/{id}",
     *     name="api_get_primarch_by_id",
     * )
     * @Operation(summary="Read selected primarch by its id")
     * @OA\Tag(name="Primarchs")
     *
     *
     * @OA\Response(response="200", description="ok")
     * @OA\Response(response="404", description="ko")
     * @OA\Response(response="500", description="ko")
     */
    public function readSelectedPrimarch(PrimarchRepository $primarchRepository, SerializerInterface $serializer, int $id): Response
    {
        $primarch = $primarchRepository->find($id);

        $json = $serializer->serialize($primarch,'json',null);

        return new Response($json, 200, [
            "Content-Type" => "application/json"
        ]);
    }
}