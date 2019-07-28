<?php


namespace ShareMyArt\View\Renderer;


use ShareMyArt\View\Renderer\Header\AbstractHeader;
use ShareMyArt\View\Renderer\Header\ConcreteHeader;
use ShareMyArt\View\Renderer\Header\GuestUserHeader;
use ShareMyArt\View\Renderer\Header\LoggedInUserHeader;

abstract class AbstractPageRenderer
{
    private $header;

    public function __construct()
    {
        $this->header = new ConcreteHeader();
        $this->header = $this->wrapHeader($this->header);
    }

    /**
     * Will select the proper header to be rendered
     * if the user is browsing anonymously or not
     *
     * @param AbstractHeader $header
     * @return AbstractHeader
     */
    public function wrapHeader(AbstractHeader $header): AbstractHeader
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        $header = (isset($_SESSION) && array_key_exists('userId', $_SESSION))
            ? new LoggedInUserHeader($header)
            : new GuestUserHeader($header);

        return $header;
    }

    /**
     * Will render a page with header and footer and content according
     * to the implementation of the method
     */
    public function render(): void
    {
        new HeaderRenderer($this->header->getHeaderList());
        $this->addNecessaryContent();
        new FooterRenderer();
    }

    abstract protected function addNecessaryContent();
}