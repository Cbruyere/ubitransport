<?php

declare(strict_types=1);

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Mark;
use App\Repository\MarkRepository;
use Generator;

class MarkCollectionDataProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private MarkRepository $repository;

    public function __construct(MarkRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * {@inheritDoc}
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Mark::class === $resourceClass && $operationName === 'get_class_average_marks';
    }

    /**
     * {@inheritDoc}
     */
    public function getCollection(string $resourceClass, string $operationName = null): Generator
    {
        // Get all average marks by subject
        $marks = $this->repository->getAveragesMarksBySubject();

        foreach ($marks as $key => $mark) {
            yield $mark;
        }
    }
}
