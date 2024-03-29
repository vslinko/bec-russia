<?php

namespace Rithis\BECRussiaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

use Rithis\BECRussiaBundle\Entity\EducationCourseType;

/**
 * @Route("/education-course-types")
 */
class EducationCourseTypeController extends BaseController
{
    /**
     * @Route("/export.{_format}", requirements={"_format": "xml"})
     * @Method("GET")
     * @Template
     */
    public function exportAction()
    {
        return array(
            'types' => $this->getRepository('EducationCourseType')->findForEducationCourseTypesBlock(),
        );
    }

    /**
     * @Route("/{slug}")
     * @Method("GET")
     * @Template
     * @Cache(expires="+1 Week")
     */
    public function getAction(EducationCourseType $type)
    {
        $this->saveLastEducationCourseType($type);

        $courses = $this->getRepository('EducationCourse')->findByTypeAndTown($type, $this->getSelectedTown());

        return array('type' => $type, 'courses' => $courses);
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

    /**
     * @Template
     */
    public function educationCourseTypesInlineBlockAction()
    {
        return array(
            'types' => $this->getRepository('EducationCourseType')->findForEducationCourseTypesBlock(),
        );
    }
}
