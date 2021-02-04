<?php

namespace App\Controller;

use Exception;
use App\Services\StarWarsApiService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CharacterController extends BaseController
{

    private $starWarsApiService;

    public function __construct(StarWarsApiService $starWarsApiService)
    {
        $this->starWarsApiService = $starWarsApiService;
    }

    /**
     * @Route("/characters", methods={"GET"})
     */
    public function index(Request $request)
    {
        try {
            $data = $this->starWarsApiService->searchPeopleByName($request->query->get('search'));
            return $this->respondSuccess($data->results);
        } catch (Exception $exception) {
            return $this->respondError($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * @Route("/characters/{id}", methods={"GET"})
     */
    public function show($id)
    {
        try {
            $data = $this->starWarsApiService->searchPeopleById($id);
            return $this->respondSuccess($data);
        } catch (Exception $exception) {
            return $this->respondError($exception->getMessage(), $exception->getCode());
        }
    }
}
