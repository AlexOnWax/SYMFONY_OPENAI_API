<?php

declare(strict_types=1);

namespace App\Service;

use OpenAI;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class GptApi
{
    private $params;
    public function __construct(
        ParameterBagInterface $params
        )
        {
            $this->params = $params;
        }


   
    public function getMessage(array $data): string
    {
        $apiKey = $this->params->get('gpt_key');
        $client = OpenAI::client($apiKey);

        $response = $client->chat()->create([
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            ['role'=>'user','content' => "Je m'appelle ".$data['Nom']." ".$data['prenom'] .'.'],
            ['role'=>'user','content' => 'Mon niveau de diplome est : '.$data['diplome'].'.'],
            ['role'=>'user','content' => 'Entreprise : '.$data['entreprise']],
            ['role'=>'user','content' => 'Poste : '.$data['poste'].'.'],
            ['role'=>'user','content' => 'Annonce : '.$data['annonce'].'.'],
            ['role'=>'user' ,'content' => 'Ecrit une lettre de motivation pour moi en utilisant les informations ci-dessus.'],
        ],
    ]);
    $message = $response->toArray()['choices'][0]['message']['content'];
    return $message;

    }
}