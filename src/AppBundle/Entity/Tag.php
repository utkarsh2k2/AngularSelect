<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Category;

/**
 * Tag
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TagRepository.php")
 */
class Tag {

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
     * @ORM\Column(name="TagName", type="string")
     */
    protected $tagname;

    /**
     * @ORM\ManyToMany(targetEntity="Category", mappedBy="tags")
     */
    protected $categories;

    /**
     * @return ArrayCollection
     */
    public function __construct()
    {
        $this->categories = new ArrayCollection();
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
     * Set tagname
     *
     * @param string $tagname
     * @return Tag
     */
    public function setTagname($tagname)
    {
        $this->tagname = $tagname;

        return $this;
    }

    /**
     * Get tagname
     *
     * @return string 
     */
    public function getTagname()
    {
        return $this->tagname;
    }

    /**
     * Add categories
     *
     * @param \AppBundle\Entity\Category $categories
     * @return Tag
     */
    public function addCategory(\AppBundle\Entity\Category $categories)
    {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \AppBundle\Entity\Category $categories
     */
    public function removeCategory(\AppBundle\Entity\Category $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
