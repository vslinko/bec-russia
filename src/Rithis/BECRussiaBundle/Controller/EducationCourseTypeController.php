<?php

namespace Rithis\BECRussiaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/education-course-types")
 */
class EducationCourseTypeController extends BaseController
{
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
