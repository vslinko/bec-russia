<?php

namespace Rithis\BECRussiaBundle\Entity;

use Doctrine\ORM\EntityRepository;

use Rithis\BECRussiaBundle\Form\DataClass\EducationCourseSearch;

class EducationCourseRepository extends EntityRepository
{
    public function findByTypeAndTown(EducationCourseType $type, $town = null)
    {
        $qb = $this->createSortedQueryBuilder()
            ->where('ec.type = :type')
            ->setParameter('type', $type->getId());

        if ($town instanceof Town) {
            $qb->join('ec.schools', 's');
            $qb->andWhere('s.town = :town');
            $qb->setParameter('town', $town->getId());
        }

        return $qb->getQuery()->getResult();
    }

    public function findReasons()
    {
        return $this->flat($this->createQueryBuilder('ec')
            ->select('ec.reason')
            ->groupBy('ec.reason')
            ->getQuery()
            ->getResult());
    }

    public function findSchedules()
    {
        return $this->flat($this->createQueryBuilder('ec')
            ->select('ec.schedule')
            ->groupBy('ec.schedule')
            ->getQuery()
            ->getResult());
    }

    public function findLanguageLevels()
    {
        return $this->flat($this->createQueryBuilder('ec')
            ->select('ec.languageLevel')
            ->groupBy('ec.languageLevel')
            ->getQuery()
            ->getResult());
    }

    public function filter(EducationCourseSearch $request)
    {
        return $this->createSortedQueryBuilder()
            ->join('ec.type', 't')
            ->join('ec.schools', 's')
            ->where('t.age = :age')
            ->andWhere('s.town = :town')
            ->andWhere('ec.reason = :reason')
            ->andWhere('ec.schedule = :schedule')
            ->andWhere('ec.languageLevel = :languageLevel')
            ->setParameters($request->toArray())
            ->getQuery()
            ->getResult();
    }

    public function similar(EducationCourseSearch $request)
    {
        $similar = $this->createSortedQueryBuilder()
            ->join('ec.type', 't')
            ->join('ec.schools', 's')
            ->where('t.age = :age')
            ->andWhere('s.town = :town')
            ->andWhere('ec.schedule = :schedule')
            ->andWhere('ec.languageLevel = :languageLevel')
            ->setParameter('age', $request->getAge())
            ->setParameter('town', $request->getTown())
            ->setParameter('schedule', $request->getSchedule())
            ->setParameter('languageLevel', $request->getLanguageLevel())
            ->getQuery()
            ->getResult();

        if (count($similar) > 0) {
            return $similar;
        }

        $similar = $this->createSortedQueryBuilder()
            ->join('ec.type', 't')
            ->join('ec.schools', 's')
            ->where('t.age = :age')
            ->andWhere('s.town = :town')
            ->andWhere('ec.languageLevel = :languageLevel')
            ->setParameter('age', $request->getAge())
            ->setParameter('town', $request->getTown())
            ->setParameter('languageLevel', $request->getLanguageLevel())
            ->getQuery()
            ->getResult();

        if (count($similar) > 0) {
            return $similar;
        }

        $similar = $this->createSortedQueryBuilder()
            ->join('ec.schools', 's')
            ->where('s.town = :town')
            ->andWhere('ec.languageLevel = :languageLevel')
            ->setParameter('town', $request->getTown())
            ->setParameter('languageLevel', $request->getLanguageLevel())
            ->getQuery()
            ->getResult();

        if (count($similar) > 0) {
            return $similar;
        }

        $similar = $this->createSortedQueryBuilder()
            ->join('ec.schools', 's')
            ->where('s.town = :town')
            ->setParameter('town', $request->getTown())
            ->getQuery()
            ->getResult();

        return $similar;
    }

    public function createSortedQueryBuilder()
    {
        return $this->createQueryBuilder('ec')
            ->orderBy('ec.title');
    }

    private function flat($array)
    {
        $flat = array();

        foreach ($array as $row) {
            $flat[] = array_shift($row);
        }

        return $flat;
    }
}
