<?php

namespace Rithis\BECRussiaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

use Rithis\BECRussiaBundle\Form\DataClass\EducationCourseSearch,
    Rithis\BECRussiaBundle\Entity\EducationCourse;

/**
 * @Route("/education-courses")
 */
class EducationCourseController extends BaseController
{
    /**
     * @Route("/search")
     * @Method("GET")
     * @Template
     */
    public function searchAction()
    {
        $request = new EducationCourseSearch();

        $town = $this->getSelectedTown();
        if ($town) {
            $request->setTown($this->getSelectedTown());
        }

        $type = $this->loadLastEducationCourseType();
        if ($type) {
            $request->setAge($type->getAge());
        }

        $result = $this->loadLastTestResult();
        if ($result) {
            $request->setLanguageLevel($result->getType());
        }

        return array('form' => $this->createForm($this->get('rithis.becrussia.form.education_course_search'), $request)->createView());
    }

    /**
     * @Route("/search")
     * @Method("POST")
     * @Template("RithisBECRussiaBundle:EducationCourse:search.html.twig")
     */
    public function filterAction()
    {
        $form = $this->createForm($this->get('rithis.becrussia.form.education_course_search'));
        $form->bind($this->getRequest());
        $courses = $this->getRepository('EducationCourse')->filter($form->getData());
        $similar = $this->getRepository('EducationCourse')->similar($form->getData());
        return array('form' => $form->createView(), 'courses' => $courses, 'similar' => $similar);
    }

    /**
     * @Route("/{slug}")
     * @Method("GET")
     * @Template
     * @Cache(expires="+1 Week")
     */
    public function getAction(EducationCourse $course)
    {
        $this->saveLastEducationCourse($course);
        $this->saveLastEducationCourseType($course->getType());
    }

    /**
     * @Template
     */
    public function educationCourseTypesBlockAction()
    {
        return array(
            'types' => $this->getRepository('EducationCourseType')->findForEducationCourseTypesBlock(),
        );
    }
}
