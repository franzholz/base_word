<?php
/**
 * This file is part of PHPWord - A pure PHP library for reading and writing
 * word processing documents.
 *
 * PHPWord is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/PHPOffice/PHPWord/contributors.
 *
 * @see         https://github.com/PHPOffice/PHPWord
 * @copyright   2010-2018 PHPWord contributors
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */

namespace PhpOffice\PhpWord\Writer\HTML\Element;

use PhpOffice\PhpWord\Element\AbstractContainer as ContainerElement;

/**
 * Container element HTML writer
 *
 * @since 0.11.0
 */
class Container extends AbstractElement
{
    /**
     * Namespace; Can't use __NAMESPACE__ in inherited class (RTF)
     *
     * @var string
     */
    protected $namespace = 'PhpOffice\\PhpWord\\Writer\\HTML\\Element';

// FHO Mod Start
    public function writeElements(array $elements, $withoutP)
    {
        $content = '';
        
        foreach ($elements as $element) {
            $elementClass = get_class($element);
            $writerClass = str_replace('PhpOffice\\PhpWord\\Element', $this->namespace, $elementClass);
            if (class_exists($writerClass)) {
            debug ($writerClass, 'write $writerClass');
                /** @var \PhpOffice\PhpWord\Writer\HTML\Element\AbstractElement $writer Type hint */
                $writer = new $writerClass($this->parentWriter, $element, $withoutP, $this->withoutTags);
                $content .= $writer->write();
                if ($this->withoutTags && method_exists($writer, 'getAllStyles')) {
                    $style = $writer->getAllStyles();
debug ($style, 'Container::write $style +++');
                    if ($style) {
                        $this->styleArray[] = $style;
debug ($this->styleArray, 'Container::write $this->styleArray +++');
                    }
                }
            }
        }
		debug ($content, 'Container::writeElements END $content');
        
        return $content;
    }
// FHO Mod End

    /**
     * Write container
     *
     * @return string
     */
    public function write()
    {
        $container = $this->element;
        if (!$container instanceof ContainerElement) {
            return '';
        }
        $containerClass = substr(get_class($container), strrpos(get_class($container), '\\') + 1);
        $withoutP = in_array($containerClass, array('TextRun', 'Footnote', 'Endnote')) ? true : false;
        $content = '';
		$this->styleArray = array(); // Mod Line FHO
		debug ($container, 'write $container');

     debug ($container->getHeaders(), 'Container::write headers');
     debug ($container->getFooters(), 'Container::write footers');
        
//     public function getFooters()
        $headers = $container->getHeaders();
        $headerContent = '';
        if (isset($headers) && is_array($headers)) {
            foreach ($headers as $header) {
                $headerElements = $header->getElements();
                $headerContent .= $this->writeElements($headerElements, $withoutP);
            }
            debug ($headerContent, 'Container::write $headerContent');
        }
    
        $elements = $container->getElements();
        $content = $this->writeElements($elements, $withoutP);

		debug ($content, 'Container::write END $content');
		$footers = $container->getFooters();
		$footerContent = '';
        if (isset($footers) && is_array($footers)) {
            foreach ($footers as $footer) {
                $footerElements = $footer->getElements();
                $footerContent .= $this->writeElements($footerElements, $withoutP);
            }
            debug ($footerContent, 'Container::write $footerContent');
        }
        $content = $headerContent . $content . $footerContent;
            debug ($content, 'Container::write ENDE $content');

        return $content;
    }
    
// FHO Mod Start
    /**
     * Write container
     *
     * @return array
     */
    public function getStyleArray() {
        return $this->styleArray;
    }
// FHO Mod End

}
