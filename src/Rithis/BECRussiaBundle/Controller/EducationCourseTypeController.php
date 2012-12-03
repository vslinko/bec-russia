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
    public function educationCourseTypesInlineBlockAction()
    {
        return array(
            'types' => $this->getRepository('EducationCourseType')->findForEducationCourseTypesBlock(),
        );
    }
}
