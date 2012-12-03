<?php

namespace Rithis\BECRussiaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Rithis\BECRussiaBundle\Entity\EducationCourseType,
    Rithis\BECRussiaBundle\Entity\EducationCourse,
    Rithis\BECRussiaBundle\Entity\TestResult,
    Rithis\BECRussiaBundle\Entity\School;

class BaseController extends Controller
{
    protected function getSelectedTown()
    {
        $town = $this->getRequest()->getSession()->get('town');
        return $town ? $this->getDoctrine()->getManager()->merge($town) : $town;
    }

    protected function getRepository($entityName)
    {
        return $this->getDoctrine()->getManager()->getRepository(sprintf('RithisBECRussiaBundle:%s', $entityName));
    }

    protected function saveLastEducationCourseType(EducationCourseType $type)
    {
        $this->getRequest()->getSession()->set('last-visited-education-course-type', $type);
    }

    protected function loadLastEducationCourseType()
    {
        $type = $this->getRequest()->getSession()->get('last-visited-education-course-type');
        return $type ? $this->getDoctrine()->getManager()->merge($type) : $type;
    }

    protected function saveLastEducationCourse(EducationCourse $course)
    {
        $this->getRequest()->getSession()->set('last-visited-education-course', $course);
    }

    protected function loadLastEducationCourse()
    {
        $course = $this->getRequest()->getSession()->get('last-visited-education-course');
        return $course ? $this->getDoctrine()->getManager()->merge($course) : $course;
    }

    protected function saveLastSchool(School $school)
    {
        $this->getRequest()->getSession()->set('last-visited-school', $school);
    }

    protected function loadLastSchool()
    {
        $school = $this->getRequest()->getSession()->get('last-visited-school');
        return $school ? $this->getDoctrine()->getManager()->merge($school) : $school;
    }

    protected function saveLastTestResult(TestResult $school)
    {
        $this->getRequest()->getSession()->set('last-test-result', $school);
    }

    protected function loadLastTestResult()
    {
        $school = $this->getRequest()->getSession()->get('last-test-result');
        return $school ? $this->getDoctrine()->getManager()->merge($school) : $school;
    }
}
