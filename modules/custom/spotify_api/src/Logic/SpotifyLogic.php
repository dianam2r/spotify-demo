<?php

namespace Drupal\spotify_api\Logic;

/**
 * This class makes the logic to obtain info from the user spotify account.
 */
class SpotifyLogic {
    protected $clientId = 'dac4276a2bcf444b9db87596b85e7f92';
    protected $clientSecret = 'bc46b68502094ff790f4880de3321922';
    protected $grantType = 'client_credentials';

  /**
   * This function retrieves de data from spotify.
   */
  public function getData() {
    // API config to obtain and display media.
    $clientId = $this->userId;
    $clientSecret = $this->accessToken;
    $url = "https://accounts.spotify.com/api/token";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    $result = curl_exec($ch);
    curl_close($ch);
    $response = $this->arrangeData($result);
    return $response;
  }
}