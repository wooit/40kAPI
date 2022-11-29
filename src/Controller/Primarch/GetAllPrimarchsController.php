<?php

namespace App\Controller\Primarch;

use App\Repository\PrimarchRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\Operation;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GetAllPrimarchsController extends AbstractController
{
    /**
     * @Rest\Get(
     *     path="/api/primarchs",
     *     name="api_get_primarchs",
     * )
     * @Operation(summary="Read all primarchs")
     * @OA\Tag(name="Primarchs")
     *
     *
     * @OA\Response(response="200", description="ok")
     * @OA\Response(response="404", description="ko")
     * @OA\Response(response="500", description="ko")
     */
    public function readALlPrimarchs(PrimarchRepository $primarchRepository, SerializerInterface $serializer): Response
    {
        $primarchs = $primarchRepository->findAll();

        $json = $serializer->serialize($primarchs,'json',null);

        return new Response($json, 200, [
            "Content-Type" => "application/json"
        ]);
//        $json = $serializer->serialize(
//            $product,
//            'json',
//            ['groups' => 'primarch_basic_info']
//        );
    }
}