<?php

namespace Rithis\BECRussiaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/test")
 */
class TestController extends BaseController
{
    /**
     * @Route("/questions")
     * @Method("GET")
     * @Template
     */
    public function questionsAction()
    {
        return array(
            'questions' => $this->getRepository('TestQuestion')->findAll(),
        );
    }

    /**
     * @Route("/answers")
     * @Method("POST")
     * @Template
     */
    public function postAnswersAction()
    {
        $answers = $this->getRequest()->request->get('answers');

        $result = $this->getRepository('TestResult')->findBestMatch(array_sum($answers));

        return array(
            'result' => $result,
        );
    }
}
