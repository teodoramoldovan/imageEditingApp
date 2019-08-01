<?php


namespace ShareMyArt\Model\FormToEntityMapper;


use ShareMyArt\Model\DomainObject\Product;
use ShareMyArt\Model\DomainObject\Tag;
use ShareMyArt\Request\Request;

class UploadFormToProductMapper
{
    /**
     * @var Request
     */
    private $request;

    /**
     * UploadFormToProductMapper constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Will return a product object from the upload form data
     *
     * @return Product|null
     * @throws \Exception
     */
    public function getProduct(string $savedImagePath = null): ?Product
    {
        if (!$this->request->getPostData(null)) {
            return null;
        }

        $tags = $this->getTagsFromArray($this->request->getPostData('tags'));

        $product = new Product(
            $this->request->getSessionData('userId'),
            $this->request->getPostData('imageTitle'),
            $this->request->getPostData('imageDescription'),
            $tags,
            $this->request->getPostData('cameraSpecifications'),
            new \DateTime($this->request->getPostData('captureDate')),//datetime
            $savedImagePath

        );


        return $product;
    }

    /**
     * @param array $tags
     * @return array|Tag[]
     */
    private function getTagsFromArray(array $tags): array
    {
        $newTags = [];

        foreach ($tags as $tagItem) {
            $newTag = new Tag($tagItem);
            array_push($newTags, $newTag);
        }

        return $newTags;
    }

}