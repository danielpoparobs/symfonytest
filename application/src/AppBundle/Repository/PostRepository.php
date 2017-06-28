<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Post;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

/**
 * This custom Doctrine repository contains some methods which are useful when
 * querying for blog post information.
 *
 * See https://symfony.com/doc/current/book/doctrine.html#custom-repository-classes
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 */
class PostRepository extends EntityRepository
{
    /**
     * @param int $page
     *
     * @return Pagerfanta
     */
    public function findLatest($page = 1)
    {
        $query = $this->getEntityManager()
            ->createQuery('
                SELECT p, a, t
                FROM AppBundle:Post p
                JOIN p.author a
                LEFT JOIN p.tags t
                WHERE p.publishedAt <= :now
                ORDER BY p.publishedAt DESC
            ')
            ->setParameter('now', new \DateTime())
        ;

        return $this->createPaginator($query, $page);
    }


    /**
     * Find latest x posts
     * @param int $limit
     *
     * @return array
     */
    public function findLatestX($limit = 10)
    {
        $query = $this->getEntityManager()
            ->createQuery('
                SELECT p, a
                FROM AppBundle:Post p
                JOIN p.author a                
                WHERE p.publishedAt <= :now               
                ORDER BY p.publishedAt DESC 
            ')
            ->setParameter('now', new \DateTime());

        return $query->setMaxResults($limit)->getResult();
    }

    /**
     * Find latest posts by page
     * @param int $limit
     *
     * @return array
     */
    public function findLatestByPage($page = 1)
    {
        $query = $this->getEntityManager()
            ->createQuery('
                SELECT p, a
                FROM AppBundle:Post p
                JOIN p.author a               
                WHERE p.publishedAt <= :now               
                ORDER BY p.publishedAt DESC 
            ')
            ->setParameter('now', new \DateTime())
            ->setMaxResults(10)
            ->setFirstResult(($page*10)-10);

        return $query->getResult();
    }


    private function createPaginator(Query $query, $page)
    {
        $paginator = new Pagerfanta(new DoctrineORMAdapter($query));
        $paginator->setMaxPerPage(Post::NUM_ITEMS);
        $paginator->setCurrentPage($page);

        return $paginator;
    }
}
