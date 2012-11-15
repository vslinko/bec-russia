<?php

namespace Rithis\BECRussiaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/subscribes")
 */
class SubscribeController extends BaseController
{
    const LIST_TITLE = 'Британский Образовательный Центр';

    /**
     * @Route("/")
     * @Method("POST")
     * @Template
     */
    public function postAction()
    {
        $email = null;
        $success = false;

        $request = $this->getRequest();
        if ($request->request->has('email')) {
            $email = $request->request->get('email');

            $unisender = $this->get('rithis.becrussia.unisender');
            $lists = json_decode($unisender->getLists(), true);

            if (isset($lists['result']) && is_array($lists['result'])) {
                $neededList = null;

                foreach ($lists['result'] as $list) {
                    if ($list['title'] == self::LIST_TITLE) {
                        $neededList = $list['id'];
                    }
                }

                if (!$neededList) {
                    $list = json_decode($unisender->createList(array(
                        'title' => self::LIST_TITLE,
                    )), true);

                    if (isset($list['result']) && is_array($lists['result'])) {
                        $neededList = $list['result']['id'];
                    }
                }

                if ($neededList) {
                    $subscribeResult = json_decode($unisender->subscribe(array(
                        'list_ids' => array($neededList),
                        'fields' => array(
                            'email' => $email,
                        ),
                    )), true);

                    if (isset($subscribeResult['result']) && is_array($subscribeResult['result'])) {
                        $success = true;
                        $email = null;
                    }
                }
            }
        }

        return array('email' => $email, 'success' => $success);
    }
}
