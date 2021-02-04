<?php

namespace App\Services;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class StarWarsApiService
{
    private $url;
    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->url = $_ENV['CHARACTERS_API'];
        $this->httpClient = $httpClient;
    }

    public function searchPeopleByName($name)
    {
        $response = $this->httpClient->request('GET', "$this->url/people/", [
            'query' => ['search' => $name]
        ]);

        return json_decode($response->getContent());
    }

    public function searchPeopleById($id)
    {
        $response = $this->httpClient->request('GET', "$this->url/people/$id");
        return json_decode($response->getContent());
    }
}
