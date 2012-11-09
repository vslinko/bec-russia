<?php

namespace Rithis\BECRussiaBundle\Listener;

use Symfony\Component\HttpFoundation\File\UploadedFile,
    Doctrine\ORM\Event\LifecycleEventArgs,
    Doctrine\ORM\Event\PreUpdateEventArgs,
    Rithis\BECRussiaBundle\Entity\School,
    PHPExcel_IOFactory;

class SchoolScheduleListener
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof School) {
            $schedule = $entity->getSchedule();

            if ($schedule instanceof UploadedFile) {
                $entity->setSchedule($this->parseSchedule($schedule));
            }
        }
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        if ($args->getEntity() instanceof School && $args->hasChangedField('schedule')) {
            $schedule = $args->getNewValue('schedule');

            if ($schedule instanceof UploadedFile) {
                $args->setNewValue('schedule', $this->parseSchedule($schedule));
            }
        }
    }

    private function parseSchedule(UploadedFile $schedule)
    {
        $path = $schedule->getRealPath();

        $reader = PHPExcel_IOFactory::createReaderForFile($path);
        $excel = $reader->load($path);
        $sheet = $excel->getActiveSheet();

        return $sheet->toArray();
    }
}
