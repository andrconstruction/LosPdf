<?php
    /**
     * Pdf view strategy file
     *
     * @author     Leandro Silva <leandro@leandrosilva.info>
     * @category   LosPdf
     * @license    https://github.com/Lansoweb/LosPdf/blob/master/LICENSE BSD-3 License
     * @link       http://github.com/LansoWeb/LosPdf
     */

    namespace LosPdf\Model;

    use Interop\Container\ContainerInterface;
    use LosPdf\View\Strategy\PdfStrategy;
    use Zend\ServiceManager\Factory\FactoryInterface;

    /**
     * Pdf view strategy class
     *
     * @author     Leandro Silva <leandro@leandrosilva.info>
     * @category   LosPdf
     * @license    https://github.com/Lansoweb/LosPdf/blob/master/LICENSE BSD-3 License
     * @link       http://github.com/LansoWeb/LosPdf
     */
    class ViewPdfStrategy implements FactoryInterface
    {
        public function __invoke( ContainerInterface $container, $requestedName, array $options = null ) {
            $pdfRenderer = $container->get( 'ViewPdfRenderer' );

            return new PdfStrategy( $pdfRenderer );
        }

    }
