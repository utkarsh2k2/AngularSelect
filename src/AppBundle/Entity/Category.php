<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Tag;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository.php")
 */
class Category {

    /**
     * @var int
     *
     * @ORM\Column(name="Id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * 
     * @var string
     *
     * @ORM\Column(name="CategoryName", type="string")
     */
    protected $categoryname;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", cascade={"persist"}, inversedBy="categories")
     */
    protected $tags;

    /**
     * @return ArrayCollection 
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set categoryname
     *
     * @param string $categoryname
     * @return Category
     */
    public function setCategoryname($categoryname)
    {
        $this->categoryname = $categoryname;

        return $this;
    }

    /**
     * Get categoryname
     *
     * @return string 
     */
    public function getCategoryname()
    {
        return $this->categoryname;
    }

    /**
     * Add tags
     *
     * @param \AppBundle\Entity\Tag $tags
     * @return Category
     */
    public function addTag(\AppBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \AppBundle\Entity\Tag $tags
     */
    public function removeTag(\AppBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }
}
