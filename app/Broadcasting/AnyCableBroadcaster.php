<?php

namespace App\Broadcasting;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Broadcasting\Broadcasters\Broadcaster;
use Illuminate\Broadcasting\BroadcastException;
use Illuminate\Support\Facades\Log;

class AnyCableBroadcaster extends Broadcaster
{
    /**
     * The HTTP client instance.
     */
    protected Client $client;

    /**
     * The AnyCable broadcasting configuration.
     */
    protected array $config;

    /**
     * Create a new AnyCable broadcaster instance.
     */
    public function __construct(Client $client, array $config)
    {
        $this->client = $client;
        $this->config = $config;
    }

    /**
     * Authenticate the incoming request for a given channel.
     */
    public function auth($request)
    {
        // Stub method - not needed for basic broadcasting
        return true;
    }

    /**
     * Return the valid authentication response.
     */
    public function validAuthenticationResponse($request, $result)
    {
        // Stub method - not needed for basic broadcasting
        return [];
    }

    /**
     * Broadcast the given event.
     */
    public function broadcast(array $channels, $event, array $payload = [])
    {
        $broadcastUrl = $this->getBroadcastUrl();
        $headers = $this->getHeaders();

        foreach ($channels as $channel) {
            $this->broadcastToChannel($broadcastUrl, $headers, $channel, $event, $payload);
        }
    }

    /**
     * Broadcast to a specific channel.
     */
    protected function broadcastToChannel(string $url, array $headers, string $channel, string $event, array $payload): void
    {
        $data = [
            'stream' => $channel,
            'data' => json_encode([
                'event' => $event,
                'data' => $payload,
            ]),
        ];

        try {
            $response = $this->client->post($url, [
                'headers' => $headers,
                'json' => $data,
                'timeout' => $this->config['timeout'] ?? 5,
            ]);

            if ($response->getStatusCode() !== 200) {
                Log::error('AnyCable broadcast failed', [
                    'channel' => $channel,
                    'event' => $event,
                    'status' => $response->getStatusCode(),
                    'response' => $response->getBody()->getContents(),
                ]);
            }
        } catch (RequestException $e) {
            Log::error('AnyCable broadcast request failed', [
                'channel' => $channel,
                'event' => $event,
                'error' => $e->getMessage(),
                'url' => $url,
            ]);

            throw new BroadcastException('Failed to broadcast to AnyCable: ' . $e->getMessage());
        }
    }

    /**
     * Get the broadcast URL.
     */
    protected function getBroadcastUrl(): string
    {
        $host = $this->config['host'] ?? 'localhost';
        $port = $this->config['broadcast_port'] ?? 8090;
        $scheme = $this->config['scheme'] ?? 'http';

        return sprintf('%s://%s:%d/_broadcast', $scheme, $host, $port);
    }

    /**
     * Get the headers for the broadcast request.
     */
    protected function getHeaders(): array
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];

        if (isset($this->config['broadcast_key'])) {
            $headers['Authorization'] = 'Bearer ' . $this->config['broadcast_key'];
        }

        return $headers;
    }
}