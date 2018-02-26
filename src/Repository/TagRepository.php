<?php
/**
 * Created by PhpStorm.
 * User: b_vitis
 * Date: 21/02/2018
 * Time: 09:28
 */

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\Tag;

class TagRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tag::class);
    }
    public function update(Tag $tag){
        $this->_em->persist($tag);
        $this->_em->flush();
    }
}