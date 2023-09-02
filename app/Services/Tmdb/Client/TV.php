<?php
/**
 * NOTICE OF LICENSE.
 *
 * UNIT3D Community Edition is open-sourced software licensed under the GNU Affero General Public License v3.0
 * The details is bundled with this project in the file LICENSE.txt.
 *
 * @project    UNIT3D Community Edition
 *
 * @author     HDVinnie <hdinnovations@protonmail.com>
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html/ GNU Affero General Public License v3.0
 */

namespace App\Services\Tmdb\Client;

use JsonException;

class TV
{
    public \GuzzleHttp\Client $client;

    final public const API_BASE_URI = 'https://api.TheMovieDB.org/3';

    public $data;

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws JsonException
     */
    public function __construct($id)
    {
        $this->client = new \GuzzleHttp\Client(
            [
                'base_uri'    => self::API_BASE_URI,
                'verify'      => false,
                'http_errors' => false,
                'headers'     => [
                    'Content-Type' => 'application/json',
                    'Accept'       => 'application/json',
                ],
                'query' => [
                    'api_key'            => config('api-keys.tmdb'),
                    'language'           => config('app.meta_locale'),
                    'append_to_response' => 'videos,images,aggregate_credits,external_ids,keywords,recommendations,alternative_titles',
                ],
            ]
        );

        $response = $this->client->request('get', 'https://api.TheMovieDB.org/3/tv/'.$id);

        $this->data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }

    public function getData()
    {
        return $this->data;
    }

    public function get_trailer(): ?string
    {
        if (!empty($this->data['videos']['results'])) {
            return 'https://www.youtube.com/embed/'.$this->data['videos']['results'][0]['key'];
        }

        return null;
    }
}
