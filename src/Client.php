<?php

declare(strict_types=1);

namespace Enabel\Eip;

use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

final readonly class Client
{
    public function __construct(
        private HttpClientInterface $eipClient,
        private LoggerInterface $logger,
    ) {
    }

    /**
     * @return iterable<mixed>
     */
    public function list(string $endpoint): iterable
    {
        return $this->iterate('GET', $endpoint);
    }

    /**
     * @param array<mixed> $data
     * @return array<mixed>
     */
    public function create(string $endpoint, array $data): array
    {
        return $this->request('POST', $endpoint, ['json' => $data])->toArray();
    }

    /**
     * @param array<mixed> $data
     * @return array<mixed>
     */
    public function update(string $endpoint, array $data): array
    {
        $data['@id'] = $endpoint;

        return $this->request('PUT', $endpoint, ['json' => $data])->toArray();
    }

    /**
     * @param array<mixed> $options
     */
    private function request(string $method, string $url, array $options = []): ResponseInterface
    {
        try {
            return $this->eipClient->request($method, $url, $options);
        } catch (\Throwable $exception) {
            $this->logger->error('Request to EIP failed', [
                'method' => $method,
                'url' => $url,
                'data' => $options['json'] ?? [],
            ]);

            throw $exception;
        }
    }

    /**
     * @return iterable<mixed>
     */
    private function iterate(string $method, string $url): iterable
    {
        do {
            $response = $this->request($method, $url)->toArray();

            foreach ($response['hydra:member'] as $member) {
                yield $member;
            }

            $url = $response['hydra:view']['hydra:next'] ?? false;
        } while ($url);
    }
}
