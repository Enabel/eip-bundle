<?php

namespace Enabel\Eip;

interface ClientInterface
{
    /**
     * @return iterable<mixed>
     */
    public function list(string $endpoint): iterable;

    /**
     * @param array<mixed> $data
     * @return array<mixed>
     */
    public function create(string $endpoint, array $data): array;

    /**
     * @param array<mixed> $data
     * @return array<mixed>
     */
    public function update(string $endpoint, array $data): array;

    public function updateOrCreate(string $endpoint, array $data, array $search): array;

    /**
     * @return array<mixed>
     */
    public function delete(string $endpoint): array;
}
