<?php
    /**
     * Pdf view renderer file
     *
     * @author     Leandro Silva <leandro@leandrosilva.info>
     * @category   LosPdf
     * @license    https://github.com/Lansoweb/LosPdf/blob/master/LICENSE BSD-3 License
     * @link       http://github.com/LansoWeb/LosPdf
     */

    namespace LosPdf\Model;

    use Interop\Container\ContainerInterface;
    use LosPdf\View\Renderer\MpdfRenderer;
    use Zend\ServiceManager\Factory\FactoryInterface;

    /**
     * Pdf view renderer class
     *
     * @author     Leandro Silva <leandro@leandrosilva.info>
     * @category   LosPdf
     * @license    https://github.com/Lansoweb/LosPdf/blob/master/LICENSE BSD-3 License
     * @link       http://github.com/LansoWeb/LosPdf
     */
    class ViewPdfRenderer implements FactoryInterface
    {
        public function __invoke( ContainerInterface $container, $requestedName, array $options = null ) {
            /* @var $viewResolver \Zend\View\Resolver\AggregateResolver */
            $viewResolver = $container->get( 'ViewResolver' );

            /* @var $viewRenderer \Zend\View\Renderer\PhpRenderer */
            $viewRenderer = $container->get( 'ViewRenderer' );

            if ( $viewRenderer == null ) {
                $viewManager = $container->get( 'ViewManager' );
                if ( !method_exists( $viewManager, 'getRenderer' ) ) {
                    throw new \RuntimeException( 'Unable to find a Renderer' );
                }
                $viewRenderer = $viewManager->getRenderer();
            }

            //Later, this will be an option in config (mpdf, dompdf, etc)
            $pdfRenderer = new MpdfRenderer();
            $pdfRenderer->setResolver( $viewResolver );
            $pdfRenderer->setRenderer( $viewRenderer );

            return $pdfRenderer;
        }

    }
