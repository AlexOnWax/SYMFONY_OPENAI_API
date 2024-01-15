# SYMFONY_OPENAI_API
Developpement découverte de l'utilisation de l'api Open Ai dans un projet Symfony 7

## Utilisation d'un Service pour connecter et return la réponse.
 Ajout du Service GptApi.php
```php
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
``````


## Création d'un formulaire de récupération des datas pour lancer le prompt.
 Les datas sont récupérées dans un controlleur puis envoyé dans le service.
## Récupération de la réponse dans la vue
Inscription en bas ede donnée de la réponse de l'API et affichage à l'utilisateur

## TODO : 

Réflechir à un sujet de prompt différent
Travailler le Front

