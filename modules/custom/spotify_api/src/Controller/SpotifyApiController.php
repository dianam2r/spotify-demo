<?php

namespace Drupal\racc_social\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\spotify_api\Logic\SpotifyLogic

/**
 * This class retrieves all requiered services.
 */
class RaccSocialMediaController extends ControllerBase {
    
    private $spotifyCall;

    /**
     * This function constructs the object of the class so it can be instantiated.
     */
    public function __construct(SpotifyLogic $spotifyCall) {
        $this->spotifyCall = $spotifyCall;
    }

    /**
     * This function get album info.
     */
    public function getMediaAlbum() {
        $response = [];
        $spotifyData = $this->spotifyCall->getData();
        $response['spotifyRespone'] = $spotifyData;
        $build = [
            '#theme' => 'spotify_container',
            '#results' => $response,
            '#title' => 'Latest Releases',
        ];
        $html = \Drupal::service('renderer')->renderRoot($build);
        $output = new Response();
        $output->setContent($html);
        return $output;
    }

    /**
     * This function makes the call to the containers of the services.
     * Can also be extensible to other media sources, if it's set like before.
     */
    public static function create(ContainerInterface $container) {
        $spotifyCall = $container->get('spotify_api.spotify.call');
        return new static($spotifyCall);
    }
}