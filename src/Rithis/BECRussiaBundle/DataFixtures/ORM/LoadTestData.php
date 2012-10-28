<?php

namespace Rithis\BECRussiaBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;

use Rithis\BECRussiaBundle\Entity\TestAnswer,
    Rithis\BECRussiaBundle\Entity\TestQuestion,
    Rithis\BECRussiaBundle\Entity\TestResult;

class LoadTestData extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $question = new TestQuestion();
        $question->setQuestion('Вы хорошо знаете английский язык?');

        $answer = new TestAnswer();
        $answer->setAnswer('Хорошо');
        $answer->setPoints(4);
        $question->addAnswer($answer);

        $answer = new TestAnswer();
        $answer->setAnswer('Плохо');
        $answer->setPoints(1);
        $question->addAnswer($answer);

        $manager->persist($question);

        $question = new TestQuestion();
        $question->setQuestion('Вы уверены?');

        $answer = new TestAnswer();
        $answer->setAnswer('Да');
        $answer->setPoints(2);
        $question->addAnswer($answer);

        $answer = new TestAnswer();
        $answer->setAnswer('Нет');
        $answer->setPoints(4);
        $question->addAnswer($answer);

        $manager->persist($question);

        $result = new TestResult();
        $result->setMinimalPoints(3);
        $result->setTitle('Nice try');
        $result->setResult('<p>Nice try</p>');
        $manager->persist($result);

        $result = new TestResult();
        $result->setMinimalPoints(5);
        $result->setTitle('Good');
        $result->setResult('<p>Good</p>');
        $manager->persist($result);

        $result = new TestResult();
        $result->setMinimalPoints(6);
        $result->setTitle('Excellent');
        $result->setResult('<p>Excellent</p>');
        $manager->persist($result);

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
