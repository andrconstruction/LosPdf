<?php
	/**
	 * Mpdf Renderer file
	 *
	 * @author     Leandro Silva <leandro@leandrosilva.info>
	 * @category   LosPdf
	 * @license    https://github.com/Lansoweb/LosPdf/blob/master/LICENSE BSD-3 License
	 * @link       http://github.com/LansoWeb/LosPdf
	 */

	namespace LosPdf\View\Renderer;

	use LosPdf\View\Model\PdfModel;

	/**
	 * Mpdf Renderer class
	 *
	 * @author     Leandro Silva <leandro@leandrosilva.info>
	 * @category   LosPdf
	 * @license    https://github.com/Lansoweb/LosPdf/blob/master/LICENSE BSD-3 License
	 * @link       http://github.com/LansoWeb/LosPdf
	 */
	final class MpdfRenderer extends AbstractRenderer {

		public function getEngine( $options = [] ) {
			if ( $this->engine === null ) {
				$this->engine = new \Mpdf\Mpdf( $options );
			}


			return $this->engine;
		}

		protected function doRender() {
			return $this->getEngine()->Output();
		}

		protected function doPrepare( $model, $values ) {
			$options = [];

			$this->html = $this->renderer->render( $model, $values );

			$paperOrientation = $this->getOption( PdfModel::PAPER_ORIENTATION, PdfModel::ORIENTATION_PORTRAIT );
			$paperSize        = $this->getOption( PdfModel::PAPER_SIZE, PdfModel::SIZE_A4 );

			if ( !is_array( $paperSize ) ) {
				$format = strtolower( $paperOrientation[ 0 ] );
				if ( $format == 'l' ) {
					$paperSize = $paperSize . '-' . $format;
				}
			}

			if ( $this->getOption( PdfModel::FONT_EXT, [] ) ) {

				$opt = $this->getOption( PdfModel::FONT_EXT, [] );

				if ( isset( $opt[ 'fontDir' ] ) ) {
					$defaultConfig = ( new \Mpdf\Config\ConfigVariables() )->getDefaults();
					$fontDirs      = $defaultConfig[ 'fontDir' ];

					$options[ 'fontDir' ] = array_merge( $fontDirs, $opt[ 'fontDir' ] );
				}

				if ( isset( $opt[ 'fontdata' ] ) ) {
					$defaultFontConfig     = ( new \Mpdf\Config\FontVariables() )->getDefaults();
					$fontData              = $defaultFontConfig[ 'fontdata' ];
					$options[ 'fontdata' ] = $fontData + $opt[ 'fontdata' ];
				}

				if ( isset( $opt[ 'default_font' ] ) ) {
					$options[ 'default_font' ] = $opt[ 'default_font' ];
				}

			}

			$this->getEngine( $options );

			$this->getEngine()->_setPageSize( $paperSize, $paperOrientation );
			$this->getEngine()->WriteHTML( $this->html );
		}

		protected function doRenderToString( PdfModel $model ) {
			return $this->getEngine()->Output( '', 'S' );
		}

		protected function doRenderToFile( PdfModel $model, $fileName ) {
			return $this->getEngine()->Output( $fileName, 'F' );
		}
	}
