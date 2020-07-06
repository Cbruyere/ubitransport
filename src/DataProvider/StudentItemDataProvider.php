<?php

declare(strict_types=1);

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Student;
use App\Repository\MarkRepository;
use App\Repository\StudentRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StudentItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    private MarkRepository $repository;
    private StudentRepository $studentRepository;

    public function __construct(MarkRepository $repository, StudentRepository $studentRepository)
    {
        $this->repository = $repository;
        $this->studentRepository = $studentRepository;
    }

    /**
     * {@inheritDoc}
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Student::class === $resourceClass && $operationName === 'get_student_average_marks' ;
    }

    /**
     * {@inheritDoc}
     */
    public function getItem(string $resourceClass, $studentId, string $operationName = null, array $context = []): \Generator
    {
        $student = $this->studentRepository->find($studentId);

        if (null === $student) {
            // Using internal codes for a better understanding of what's going on
            throw new NotFoundHttpException(sprintf('The student %s does not exist.', $studentId));
        }

        $student->setAverages($this->repository->getAveragesMarksBySubject($studentId));

        yield $student;
    }
}
