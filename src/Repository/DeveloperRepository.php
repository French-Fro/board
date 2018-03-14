<?php
/**
 * Created by PhpStorm.
 * User: b_vitis
 * Date: 28/02/2018
 * Time: 09:39
 */

namespace App\Repository;

use App\Entity\Developer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
class DeveloperRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Developer::class);
    }
    public function insert(Developer $dev){
        $this->_em->persist($dev);
        $this->_em->flush();
    }
}