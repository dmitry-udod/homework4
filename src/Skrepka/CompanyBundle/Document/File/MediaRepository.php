<?php

namespace Skrepka\CompanyBundle\Document\File;

use Doctrine\ODM\MongoDB\DocumentRepository;
use Skrepka\CompanyBundle\Document\File\Media;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MediaRepository extends DocumentRepository
{
    /**
     * @param UploadedFile $file
     * @return Media
     */
    public function upload(UploadedFile $file)
    {
        $reference = sha1(uniqid(mt_rand(), true)) . '.'.$file->guessExtension();
        $media = new Media();
        $media->setName($file->getClientOriginalName())
            ->setSize($file->getSize())
            ->setMimeType($file->getClientMimeType())
            ->setReference($reference)
        ;
        $file->move($media->getUploadRootDir(), $reference);

        $this->getDocumentManager()->persist($media);

        return $media;
    }
}