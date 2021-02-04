<?php

namespace App\Controller;

use Exception;
use App\Entity\Favorite;
use App\Services\StarWarsApiService;
use App\Repository\FavoriteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class FavoriteController extends BaseController
{

    /**
     * @Route("/favorites", methods={"GET"})
     */
    public function index(FavoriteRepository $favoriteRepository)
    {
        try {
            $response = $favoriteRepository->findAll();
            return $this->respondSuccess($response);
        } catch (Exception $exception) {
            return $this->respondError($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * @Route("/favorites", methods={"POST"})
     */
    public function create(Request $request, ValidatorInterface $validator, StarWarsApiService $starWarsApiService)
    {
        try {
            $characterId = $request->request->get('character_id');
            $character = $starWarsApiService->searchPeopleById($characterId);

            $favorite = new Favorite();
            $favorite->setName($character->name);
            $favorite->setSwapiId($characterId);

            $errors = $validator->validate($favorite);
            if (count($errors) > 0) {
                return $this->respondError($errors);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($favorite);
            $entityManager->flush();

            return $this->respondSuccess($favorite, 201);
        } catch (Exception $exception) {
            return $this->respondError($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * @Route("/favorites/{swapiId}", methods={"DELETE"})
     */
    public function destroy(FavoriteRepository $favoriteRepository, $swapiId)
    {
        try {
            $favorite = $favoriteRepository->findOneBy(['swapi_id' => $swapiId]);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($favorite);
            $entityManager->flush();

            return $this->respondSuccess(null, 204);
        } catch (Exception $exception) {
            return $this->respondError($exception->getMessage(), $exception->getCode());
        }
    }
}
