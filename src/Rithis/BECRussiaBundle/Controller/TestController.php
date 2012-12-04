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
        
        if ('POST' === $this->getRequest()->getMethod()) {
            $form->bind($this->getRequest());
            
            if ($form->isValid()) {
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
        
        if ('POST' === $this->getRequest()->getMethod()) {
            $form->bind($this->getRequest());

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                
                $em->persist($form->getData());
                $em->flush();
                
                $this->sendEmail($form->getData());
                
                return $this->redirect($this->generateUrl('rithis_becrussia_test_questions'));
            }
        }

        return array(
            'form' => $form->createView(),
        );
    }

    public function sendEmail($tester)
    {
        $message = $this->get('mailer')->createMessage();
        $message->setSubject('Результаты тестирования')
            ->setFrom('tester@bec-russia.com')
            ->setTo($this->container->getParameter('rithis.becrussia.test.send'))
            ->setBody($this->get('templating')->render(
                'RithisBECRussiaBundle:Test:email.html.twig',
                array(
                    'tester'  => $tester,
                    'result'   => $this->loadLastTestResult(),
                ),
                'text/html'
            ));
        
        $this->get('mailer')->send($message);
    }
}
