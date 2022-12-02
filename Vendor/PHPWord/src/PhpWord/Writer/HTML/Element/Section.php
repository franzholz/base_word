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

 
// FHO Mod Start

namespace PhpOffice\PhpWord\Writer\HTML\Element;

use PhpOffice\PhpWord\Writer\HTML\Element\Container;
use PhpOffice\PhpWord\Element\Section as SectionElement;


/**
 * Section element HTML writer
 *
 * @since 0.10.0
 */
class Section extends AbstractElement
{
    /**
     * Namespace; Can't use __NAMESPACE__ in inherited class (RTF)
     *
     * @var string
     */
    protected $namespace = 'PhpOffice\\PhpWord\\Writer\\HTML\\Element';

    /**
     * Write container
     *
     * @return string
     */
    public function write()
    {
		$content = '';
        $section = $this->element;
debug ($section, 'Section::write $section');
        if (!$section instanceof SectionElement) {
            return '';
        }
debug ($section, 'Section::write $section Pos 2');

		$elementsArray = array();
        $elementsArray['header'] = $section->getHeaders();
        $elementsArray['footer'] = $section->getFooters();

        foreach ($elementsArray as $type => $elements) {
debug ($type, '$type');
			$typeContent = '';
debug ($elements, 'Section::write $elements');

			foreach ($elements as $element) {
if (method_exists($element, 'getText') )
debug ($element->getText(), 'Section::write $element->getText()');

				$elementClass = get_class($element);
	debug ($elementClass, 'Section::write $elementClass');

				$writerClass = str_replace('PhpOffice\\PhpWord\\Element', $this->namespace, $elementClass);
	debug ($writerClass, 'Section::write $writerClass');
				if (class_exists($writerClass)) {
					/** @var \PhpOffice\PhpWord\Writer\HTML\Element\AbstractElement $writer Type hint */
					$writer = new $writerClass($this->parentWriter, $element, true);
					$contentPart = $writer->write();
	debug ($contentPart, 'Section::write $contentPart +++');
					$typeContent .= $contentPart;
				}
			}
	debug ($typeContent, 'Section::write $typeContent');
			$content .= '<div class="' . $type . '">' . $typeContent . '</div>';
		}

	debug ($content, 'Section::write Pos 1 vor Container $content');

        $writer = new Container($this->parentWriter, $section);
        $contentPart = $writer->write();
debug ($contentPart, 'Section::write $contentPart');

		$content .= chr(13) . $contentPart . chr(13);

debug ($content, 'Section::write ENDE $content');
        return $content;
	}

}

// FHO Mod End



