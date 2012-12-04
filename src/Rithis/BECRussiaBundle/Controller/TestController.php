<?php

namespace Rithis\BECRussiaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Rithis\BECRussiaBundle\Entity\Tester,
    Rithis\BECRussiaBundle\Form\Type\TesterType;

/**
 * @Route("/test")
 */
class TestController extends BaseController
{
    /**
     * @Route("/register")
     * @Method("GET|POST")
     * @Template
     */
    public function registerAction()
    {
        $tester = $this->get('session')->get('rithis.becrussia.tester');
        $form = $this->createForm(new TesterType(), $tester);
        
        $form->bind($this->getRequest());
        
        if ($form->isValid()) {
            if ('POST' === $this->getRequest()->getMethod()) {
                $this->get('session')->set('rithis.becrussia.tester', $form->getData());
                
                return $this->redirect($this->generateUrl('rithis_becrussia_test_questions'));
            }
        }

        return array(
            'form' => $form->createView(),
        );
    }

    /**
     * @Route("/questions")
     * @Method("GET")
     * @Template
     */
    public function questionsAction()
    {
        if (!$this->get('session')->has('rithis.becrussia.tester')) {
            return $this->redirect($this->generateUrl('rithis_becrussia_test_register'));
        }

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
        $this->saveLastTestResult($result);

        return array(
            'result' => $result,
        );
    }

    /**
     * @Route("/submit")
     * @Method("POST|GET")
     * @Template
     */
    public function submitAction()
    {
        $tester = $this->get('session')->get('rithis.becrussia.tester');
        $form = $this->createForm(new TesterType(), $tester);

        $form->bind($this->getRequest());
        
        if ($form->isValid()) {
            if ('POST' === $this->getRequest()->getMethod()) {
                $em = $this->getDoctrine()->getManager();
                
                $em->persist($form->getData());
                $em->flush();
                
                return $this->redirect($this->generateUrl('rithis_becrussia_test_questions'));
            }
        }

        return array(
            'form' => $form->createView(),
        );
    }
}
