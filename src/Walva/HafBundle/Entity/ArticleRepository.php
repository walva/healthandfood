<?php

namespace Walva\HafBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends EntityRepository
{

    public function searchWith($langue, $page, $countByPage, $value)
    {
        $query = $this->getEntityManager()->createQuery('SELECT a
            FROM WalvaHafBundle:Article a
            WHERE a.titre LIKE :value
            AND a.langue = :langue
            ORDER BY a.dateCreation DESC');
        $query->setParameter(':value', '%' . $value . '%');
        $query->setParameter(':langue', $langue);

        $query->setFirstResult(($page - 1) * $countByPage)
            ->setMaxResults($countByPage);

        return new Paginator($query);
    }

    public function getArticleByTag($tagId, $locale, $returnQuery = false)
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder
            ->select('article')
            ->from('WalvaHafBundle:Article', 'article')
            ->join('article.tag', 'tag')
            ->where('tag.id = :tag')
            ->andWhere('article.langue = :locale')
            ->orderBy('article.dateCreation', 'DESC')
            ->setParameters([
                'tag' => $tagId,
                'locale' => $locale,
            ]);

        if ($returnQuery) {
            return $queryBuilder->getQuery();
        }

        return $queryBuilder->getQuery()->execute();
    }

}
