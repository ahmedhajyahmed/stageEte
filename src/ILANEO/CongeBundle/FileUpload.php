<?php
namespace ILANEO\CongeBundle;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUpload
{

    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->getTargetDir(), $fileName);

        return $fileName;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }

}