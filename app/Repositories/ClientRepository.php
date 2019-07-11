<?php

namespace App\Repositories;

use App\Model\Client;

class ClientRepository
{

    protected $client;

    public function __construct(Client $client){

        $this->client = $client;
    }

    public function getPaginate($n){

        return $this->client->paginate($n);
    }

    public function store(Array $inputs){

        return $this->client->create($inputs);
    }

    public function destroy(Client $client){

       // $client->commandes()->dissociate();
        $client->delete();
    }
}