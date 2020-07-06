<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     collectionOperations={
 *       "get",
 *       "post",
 *       "get_class_average_marks"={
 *          "pagination_enabled"=false,
 *          "method"="GET",
 *          "path"="/marks/get_class_average_marks",
 *          "openapi_context"= {
 *            "summary" = "Get average marks for the classromm"
 *         }
 *       }
 *     }
 * )
 *
 * @ORM\Entity()
 */
class Mark
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="float")
     *
     * @Assert\Range(
     *      min = 0,
     *      max = 20,
     *      notInRangeMessage = "The mark value shoud be between {{ min }} and {{ max }}",
     * )
     *
     * @Assert\NotNull
     */
    private float $value;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotNull
     */
    private string $subject;

    /**
     * @ORM\ManyToOne(targetEntity=Student::class, inversedBy="marks")
     * @ORM\JoinColumn(nullable=false)
     */
    private Student $student;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): float
    {
        return round($this->value, 1);
    }

    public function setValue(float $value): void
    {
        $this->value = $value;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    public function getStudent(): Student
    {
        return $this->student;
    }

    public function setStudent(Student $student): void
    {
        $this->student = $student;
    }
}
