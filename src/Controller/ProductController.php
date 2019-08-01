<?php

namespace ShareMyArt\Controller;

use ShareMyArt\Model\Helper\ImageDownloader;
use ShareMyArt\Model\Helper\ImageNameConverter;
use ShareMyArt\Model\Helper\TierHandler;
use ShareMyArt\Model\DomainObject\OrderItem;
use ShareMyArt\Model\DomainObject\Product;
use ShareMyArt\Model\DomainObject\Tag;
use ShareMyArt\Model\DomainObject\Tier;
use ShareMyArt\Model\FormToEntityMapper\BuyFormToOrderItemMapper;
use ShareMyArt\Model\FormToEntityMapper\UploadFormToProductMapper;
use ShareMyArt\Model\Persistence\Finder\OrderItemFinder;
use ShareMyArt\Model\Persistence\Finder\ProductFinder;
use ShareMyArt\Model\Persistence\Finder\TagFinder;
use ShareMyArt\Model\Persistence\Finder\TierFinder;
use ShareMyArt\Model\Persistence\Mapper\OrderItemMapper;
use ShareMyArt\Model\Persistence\Mapper\ProductMapper;
use ShareMyArt\Model\Persistence\Mapper\TierMapper;
use ShareMyArt\Model\Persistence\PersistenceFactory;
use ShareMyArt\Model\Validation\FormValidator\UploadProductFormValidator;
use ShareMyArt\Model\Saver\ImageSaver;
use ShareMyArt\View\Renderer\HomepageRenderer;
use ShareMyArt\View\Renderer\ProductPageRenderer;
use ShareMyArt\View\Renderer\UploadProductRenderer;

class ProductController extends AbstractController
{

    /**
     * @throws \Exception
     */
    public function showProducts(): void
    {
        $sortData = array_key_exists('sort', $this->request->getGetData(null))
            ? $this->request->getGetData('sort')
            : '';
        $directionData = array_key_exists('direction', $this->request->getGetData(null))
            ? $this->request->getGetData('direction')
            : '';
        $queryData = array_key_exists('query', $this->request->getGetData(null))
            ? $this->request->getGetData('query')
            : '';

        $page = $this->getCurrentPage();
        $query = $queryData;
        $filters = [];
        $sorts = [
            'sort' => $sortData,
            'direction' => $directionData
        ];

        // remember products per page so they don't get reset in each request
        $numberOfProductsPerPage = $this->getNumberOfProductsPerPages();
        $this->request->setSessionData('resultsPerPage', $numberOfProductsPerPage);

        /** @var ProductFinder $productFinder */
        $productFinder = PersistenceFactory::createFinder(Product::class);
        $products = $productFinder->findAllProducts($page, $numberOfProductsPerPage, $query, $filters, $sorts);

        $homepageRenderer = new HomepageRenderer($this->request, $products, $page,
            $numberOfProductsPerPage, $sortData, $directionData, $queryData);
        $homepageRenderer->render();
    }

    /**
     * @return int Contains the number of the current page
     */
    private function getCurrentPage(): int
    {
        $getData = $this->request->getGetData(null);

        $page = (isset($getData['page']))
            ? $this->request->getGetData('page')
            : 0;
        return $page;
    }

    /**
     * @return int Contains number of products to be displayed in a page
     */
    private function getNumberOfProductsPerPages(): int
    {
        $sessionData = $this->request->getSessionData(null);

        //if there isn't yet set a number of results per page
        //the default value will be 6
        $resultsPerPage = (isset($sessionData['resultsPerPage']))
            ? $sessionData['resultsPerPage']
            : 6;

        $postData = $this->request->getPostData(null);
        $numberOfProductsPerPage = (isset($postData['pages']))
            ? $this->request->getPostData('pages')
            : $resultsPerPage;

        return $numberOfProductsPerPage;
    }

    /**
     * Will display the upload product form
     *
     * @throws \Exception
     */
    public function uploadProduct(): void
    {
        $errors = [];

        /** @var TagFinder $tagFinder */
        $tagFinder = PersistenceFactory::createFinder(Tag::class);
        $tags = $tagFinder->findAllTags();

        $uploadProductRenderer = new UploadProductRenderer($this->request, $errors, $tags);
        $uploadProductRenderer->render();
    }

    /**
     * Will handle uploading of a product, including generating tiers and
     * saving them
     *
     * @throws \Exception
     */
    public function uploadProductPost()
    {
        //validate that the form input is correct
        $uploadProductFormValidator = new UploadProductFormValidator($this->request);
        $errors = $uploadProductFormValidator->validateInput($this->request->getPostData(null));

        /** @var TagFinder $tagFinder */
        $tagFinder = PersistenceFactory::createFinder(Tag::class);
        $tags = $tagFinder->findAllTags();

        if (empty($errors)) {
            $imageSaver = new ImageSaver($this->request);
            $savedImagePath = $imageSaver->saveImage();


            $thumbnailPath = ImageNameConverter::addThumbnailToImagePath($savedImagePath);
            $imageSaver->saveThumbnail($savedImagePath, $thumbnailPath);

            $uploadFormToProductMapper = new UploadFormToProductMapper($this->request);
            $newProduct = $uploadFormToProductMapper->getProduct($thumbnailPath);

            /** @var ProductMapper $productMapper */
            $productMapper = PersistenceFactory::createMapper(Product::class);
            $productMapper->save($newProduct);


            $this->insertTiers($savedImagePath, $newProduct);

            header('Location:/user/myUploads');

        }

        $uploadProductRenderer = new UploadProductRenderer($this->request, $errors, $tags);
        $uploadProductRenderer->render();
    }

    /**
     * Will generate the tiers to be used at upload and will persist them
     *
     * @param string $savedImagePath
     * @param Product $newProduct
     */
    private function insertTiers(string $savedImagePath, Product $newProduct)
    {
        $tierHandler = new TierHandler($this->request);

        $smallTier = $tierHandler->getTier($savedImagePath, $newProduct, 'small');
        $mediumTier = $tierHandler->getTier($savedImagePath, $newProduct, 'medium');
        $largeTier = $tierHandler->getOriginalTier($savedImagePath, $newProduct);


        /** @var TierMapper $tierMapper */
        $tierMapper = PersistenceFactory::createMapper(Tier::class);

        $tierMapper->save($smallTier);
        $tierMapper->save($mediumTier);
        $tierMapper->save($largeTier);
    }


    /**
     * Will handle the download when a product is bought
     */
    public function buyProduct()
    {

        $path = $this->request->getPostData('size');


        $buyFormMapper = new BuyFormToOrderItemMapper($this->request);
        $orderItem = $buyFormMapper->getOrderItem();

        /** @var OrderItemMapper $orderItemMapper */
        $orderItemMapper = PersistenceFactory::createMapper(OrderItem::class);
        $orderItemMapper->save($orderItem);

        ImageDownloader::downloadImage($path);

        header('Location:/user/myOrders');

    }

    /**
     * Will display the product details page
     *
     * @param int $id
     * @throws \Exception
     */
    public function showProduct(int $id)
    {
        /** @var ProductFinder $productFinder */
        $productFinder = PersistenceFactory::createFinder(Product::class);
        $product = $productFinder->findProductById($id);

        /** @var TierFinder $tierFinder */
        $tierFinder = PersistenceFactory::createFinder(Tier::class);
        $tiers = $tierFinder->findAllTiersByProductId($id);

        /** @var OrderItemFinder $orderItemsFinder */
        $orderItemsFinder = PersistenceFactory::createFinder(OrderItem::class);

        $orders = [];
        if (!empty($this->request->getSessionData(null))) {
            $orders = array_key_exists('userId', $this->request->getSessionData(null))
                ? $orderItemsFinder->findAllOrdersByUserId($this->request->getSessionData('userId'))
                : $orderItemsFinder->findAllOrdersByUserId();
        }

        $productPageRenderer = new ProductPageRenderer($this->request, $tiers, $orders, $product);
        $productPageRenderer->render();
    }


}