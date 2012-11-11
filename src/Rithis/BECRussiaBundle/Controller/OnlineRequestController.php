<?php

namespace Rithis\BECRussiaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Rithis\BECRussiaBundle\Form\Type\OnlineRequestType,
    Rithis\BECRussiaBundle\Entity\OnlineRequest;

/**
 * @Route("/online-requests")
 */
class OnlineRequestController extends BaseController
{
    /**
     * @Route("/new")
     * @Method("GET")
     * @Template
     */
    public function newAction()
    {
        $onlineRequest = new OnlineRequest();

        $school = $this->loadLastSchool();
        if ($school) {
            $onlineRequest->setSchool($school);
        }

        $type = $this->loadLastEducationCourseType();
        if ($type) {
            $onlineRequest->setAge($type->getAge());

            $course = $this->loadLastEducationCourse();
            if ($course) {
                $courses = $type->getEducationCourses();

                if (!$courses->contains($course)) {
                    $course = $courses->first();
                }

                $onlineRequest->setEducationCourse($course);
            }
        }

        $result = $this->loadLastTestResult();
        if ($result) {
            $onlineRequest->setLanguageLevel($result->getType());
        }

        return array(
            'success' => $this->getRequest()->getSession()->getFlashBag()->get('online-request'),
            'form' => $this->createForm(new OnlineRequestType(), $onlineRequest)->createView(),
        );
    }

    /**
     * @Route("/")
     * @Method("POST")
     * @Template("RithisBECRussiaBundle:OnlineRequest:new.html.twig")
     */
    public function postAction()
    {
        $form = $this->createForm(new OnlineRequestType());
        $form->bind($this->getRequest());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            $this->getRequest()->getSession()->getFlashBag()->add('online-request', true);

            return $this->redirect($this->generateUrl('rithis_becrussia_onlinerequest_new'));
        }

        return array('form' => $form->createView());
    }
}
