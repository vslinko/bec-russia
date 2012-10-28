<?php

namespace Rithis\BECRussiaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Rithis\BECRussiaBundle\Entity\Poll;

/**
 * @Route("/polls")
 */
class PollController extends BaseController
{
    /**
     * @Route("/")
     * @Method("GET")
     * @Template
     */
    public function allAction()
    {
        $polls = $this->getRepository('Poll')->findForAllPage();

        $preparedPolls = array();

        foreach ($polls as $poll) {
            $preparedPolls[] = array(
                'poll' => $poll,
                'already_answered' => $this->isAlreadyAnswered($poll),
            );
        }

        return array('prepared_polls' => $preparedPolls);
    }

    /**
     * @Route("/{id}/results")
     * @Method("POST")
     */
    public function postResultsAction(Poll $poll)
    {
        $request = $this->getRequest();
        $answerId = $request->request->get('answer');

        if ($answerId && !$this->isAlreadyAnswered($poll)) {
            $answer = $poll->getAnswers()->filter(function ($answer) use ($answerId) {
                return $answer->getId() == $answerId;
            })->first();

            if ($answer) {
                $answer->incrementCount();
                $this->getDoctrine()->getManager()->flush();
            }
        }

        $this->setIpAddressAnswered($poll);
        $this->addSessionMark($poll);

        return $this->redirect($request->server->get('HTTP_REFERER', '/'));
    }

    /**
     * @Template
     */
    public function lastPollBlockAction()
    {
        $poll = $this->getRepository('Poll')->findLastOne();

        return array(
            'poll' => $poll,
            'already_answered' => $poll ? $this->isAlreadyAnswered($poll) : false,
        );
    }

    private function getApcKey(Poll $poll)
    {
        return sprintf('bec-pool-%s-%s', $poll->getId(), $this->getRequest()->server->get('REMOTE_ADDR'));
    }

    private function isIpAddressAnswered(Poll $poll)
    {
        apc_fetch($this->getApcKey($poll), $ipFound);

        return $ipFound;
    }

    private function setIpAddressAnswered(Poll $poll)
    {
        apc_store($this->getApcKey($poll), true, 60*60*24);
    }

    private function isSessionMarkFound(Poll $poll)
    {
        return in_array($poll->getId(), $this->getRequest()->getSession()->get('polls', array()));
    }

    private function addSessionMark(Poll $poll)
    {
        if (!$this->isSessionMarkFound($poll)) {
            $session = $this->getRequest()->getSession();
            $pollIds = $session->get('polls', array());

            $pollIds[] = $poll->getId();
            $session->set('polls', $pollIds);
        }
    }

    private function isAlreadyAnswered(Poll $poll)
    {
        return $this->isIpAddressAnswered($poll) || $this->isSessionMarkFound($poll);
    }
}
