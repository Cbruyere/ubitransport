<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     collectionOperations={
 *        "get"={
 *         "normalization_context"={"groups"={"write"}},
 *         "denormalization_context"={"groups"={"write"}}
 *       },
 *        "post"={
 *         "normalization_context"={"groups"={"write"}},
 *         "denormalization_context"={"groups"={"write"}}
 *       }
 *     },
 *     itemOperations={
 *       "get"= {
 *         "normalization_context"={"groups"={"write"}},
 *         "denormalization_context"={"groups"={"write"}}
 *       },
 *       "put" = {
 *         "normalization_context"={"groups"={"write"}},
 *         "denormalization_context"={"groups"={"write"}}
 *       },
 *       "patch" = {
 *         "normalization_context"={"groups"={"write"}},
 *         "denormalization_context"={"groups"={"write"}}
 *       },
 *       "delete",
 *       "get_student_average_marks"={
 *         "pagination_enabled"=false,
 *         "method"="GET",
 *         "path"="/student/{id}/get_student_average_marks",
 *         "openapi_context"= {
 *           "summary" = "Get average marks for a student"
 *         }
 *       }
 *     }
 * )
 *
 * @ORM\Entity()
 */
class Student
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\Type(
     *     type="string",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters",
     *      allowEmptyString = false
     * )
     *
     * @Assert\NotNull
     *
     * @Groups("write")
     */
    private string $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\Type(
     *     type="string",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your last name must be at least {{ limit }} characters long",
     *      maxMessage = "Your last name cannot be longer than {{ limit }} characters",
     *      allowEmptyString = false
     * )
     *
     * @Assert\NotNull
     *
     * @Groups("write")
     */
    private string $lastname;

    /**
     * @ORM\Column(type="datetime")
     *
     * @Assert\Type("\DateTimeInterface")
     *
     * @Assert\NotNull
     *
     * @Groups("write")
     */
    private DateTimeInterface $birthday;

    /**
     * @ORM\OneToMany(targetEntity=Mark::class, mappedBy="student", orphanRemoval=true)
     */
    private Collection $marks;

    /**
     * @var array
     */
    private array $averages = [];

    public function __construct()
    {
        $this->marks = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getBirthday(): DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(DateTimeInterface $birthday): void
    {
        $this->birthday = $birthday;
    }

    public function getMarks(): Collection
    {
        return $this->marks;
    }

    public function addMark(Mark $mark): void
    {
        if (!$this->marks->contains($mark)) {
            $this->marks[] = $mark;
            $mark->setStudent($this);
        }
    }

    public function removeMark(Mark $mark): void
    {
        if ($this->marks->contains($mark)) {
            $this->marks->removeElement($mark);
            // set the owning side to null (unless already changed)
            if ($mark->getStudent() === $this) {
                $mark->setStudent(null);
            }
        }
    }

    /**
     * @return array
     */
    public function getAverages(): ?array
    {
        return $this->averages;
    }

    /**
     * @param array $averages
     */
    public function setAverages(array $averages): void
    {
        $this->averages = $averages;
    }

}
