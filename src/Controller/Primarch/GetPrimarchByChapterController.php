<?php

namespace App\Controller\Primarch;

use App\Repository\PrimarchRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\Operation;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GetPrimarchByChapterController extends AbstractController
{
    /**
     * @Rest\Get(
     *     path="/api/primarchs/chapter/{chapter}",
     *     name="api_get_primarch_by_chapter",
     * )
     * @Operation(summary="Read selected primarch by its chapter")
     * @OA\Tag(name="Primarchs")
     *
     *
     * @OA\Response(response="200", description="ok")
     * @OA\Response(response="404", description="ko")
     * @OA\Response(response="500", description="ko")
     */
    public function readSelectedPrimarchByChapter(PrimarchRepository $primarchRepository, SerializerInterface $serializer, string $chapter): Response
    {
        $primarch = $primarchRepository->findOneBy(['chapter'=> $chapter]);

        $json = $serializer->serialize($primarch,'json',null);

        return new Response($json, 200, [
            "Content-Type" => "application/json"
        ]);
    }
}