<?php

namespace Rithis\BECRussiaBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;

use Rithis\BECRussiaBundle\Entity\PollAnswer,
    Rithis\BECRussiaBundle\Entity\Poll;

class LoadPollData extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $poll = new Poll();
        $poll->setQuestion('Оцените наш новый сайт');

        $answer = new PollAnswer();
        $answer->setAnswer('Хорошо');
        $poll->addAnswer($answer);

        $answer = new PollAnswer();
        $answer->setAnswer('Плохо');
        $poll->addAnswer($answer);

        $manager->persist($poll);
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
