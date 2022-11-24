<?php

namespace App\Controller\Author;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Operation;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class createAuthorController extends AbstractController
{
    /**
     * @Rest\Post(
     *     path="/api/authors",
     *     name="api_create_new_author",
     * )
     * @Operation(summary="Create a new author")
     * @OA\Tag(name="Authors")
     *
     * @OA\RequestBody(
     *     required=true,
     *     @Model(type=AuthorType::class)
     * )
     * @OA\Response(
     *     response="200",
     *     description="ok",
     *     @Model(type="AuthorType"))
     * @OA\Response(response="404", description="ko")
     * @OA\Response(response="500", description="ko")
     * @param Request $request
     * @param AuthorRepository $authorRepository
     * @param EntityManagerInterface $em
     * @param FormFactoryInterface $formFactory
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function __invoke(Request $request, AuthorRepository $authorRepository, EntityManagerInterface $em, FormFactoryInterface $formFactory, SerializerInterface $serializer) :  Response
    {

//        $author = json_decode($request->getContent(), true); => array
//        $author = json_decode($request->getContent()); => object

        $author = json_decode($request->getContent(), true);
        $form = $this->createForm(AuthorType::class);
        $form->submit(array_merge($author, $request->request->all())); // merge de 2 arrays

        if(!$form->isSubmitted() && $form->isValid()){
           throw new BadRequestException('Form Not Valid');
        }
        $author = $form->getData();
        dd($author);
        $em->persist($author);
        $em->flush();


//    $jsonRecu = $request->getContent();
////    dd($jsonRecu);
//
//    $test = $serializer->deserialize($jsonRecu, Author::class, 'json');
//            dd($test);
//
//        $em->persist($test);
//    $em->flush();
//    return $this->json($test, 201, [], [] );

        return $this->json($author );
    }
}