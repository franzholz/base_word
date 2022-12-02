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

/**
 * Footer element HTML writer
 *
 * @since 0.10.0
 */
class Footer extends AbstractElement
{
    /**
     * Namespace; Can't use __NAMESPACE__ in inherited class (RTF)
     *
     * @var string
     */
    protected $namespace = 'PhpOffice\\PhpWord\\Writer\\HTML\\Element';

    /**
     * Note type header|footer
     *
     * @var string
     */
    protected $type = 'footer';

    /**
     * Write footnote/endnote marks; The actual content is written in parent writer (HTML)
     *
     * @return string
     */
    public function write()
    {
        if (!$this->element instanceof \PhpOffice\PhpWord\Element\Footer) {
            return '';
        }

        /** @var \PhpOffice\PhpWord\Element\Footer $footer Type hint */
        $footer = $this->element;
debug ($footer, 'write $footer +++');

        /** @var \PhpOffice\PhpWord\Writer\HTML $parentWriter Type hint */
        $parentWriter = $this->parentWriter;
		$content = '';

        $elements = $footer->getElements();
        foreach ($elements as $element) {
// if (method_exists($element, 'getText') )
// debug ($element->getText(), 'Footer::write $element Text');

            $elementClass = get_class($element);
debug ($elementClass, 'Footer::write $elementClass');
// PhpOffice\PhpWord\Element\TextRun
// PhpOffice\PhpWord\Element\Text

			$withoutP = false;

// 			if ($elementClass == 'PhpOffice\\PhpWord\\Element\\TextRun') {
// 				$withoutP = true;
// 			}

            $writerClass = str_replace('PhpOffice\\PhpWord\\Element', $this->namespace, $elementClass);
// debug ($writerClass, 'Footer::write $writerClass');
            if (class_exists($writerClass)) {
                /** @var \PhpOffice\PhpWord\Writer\HTML\Element\AbstractElement $writer Type hint */
debug ($withoutP, 'Footer::write $withoutP');

                $writer = new $writerClass($this->parentWriter, $element, $withoutP);
                $content .= $tmp = $writer->write();
debug ($tmp, 'Footer::write $tmp');
            }
        }


debug ($content, 'Footer::write ENDE $content');

        return $content;
    }
}

// FHO Mod End
