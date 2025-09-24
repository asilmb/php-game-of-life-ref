<?php declare(strict_types = 1);

namespace Life\Persistence\Xml;

use Life\Exception\OutputWritingException;
use Life\Model\GameState;
use Life\Persistence\GameWriterInterface;
use SimpleXMLElement;

class XmlFileWriter implements GameWriterInterface
{
    private const OUTPUT_TEMPLATE = '/output-template.xml';


    public function __construct(private readonly string $filePath)
    {
    }


    public function save(GameState $gameState): void
    {
        $life = simplexml_load_string(file_get_contents(__DIR__ . self::OUTPUT_TEMPLATE));
        $life->world->cells = $gameState->size;
        $life->world->species = $gameState->species;
        for ($y = 0; $y < $gameState->size; $y++) {
            for ($x = 0; $x < $gameState->size; $x++) {
                $cell = $gameState->getCell($x, $y);
                if ($cell->isAlive()) {
                    $organism = $life->organisms->addChild('organism');
                    /** @var SimpleXMLElement $organism */
                    $organism->addChild('x_pos', (string)$x);
                    $organism->addChild('y_pos', (string)$y);
                    $organism->addChild('species', (string)$cell->value);
                }
            }
        }
        $this->saveXml($life);
    }


    private function saveXml(SimpleXMLElement $life): void
    {
        $dom = new \DOMDocument('1.0');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($life->asXML());
        $result = file_put_contents($this->filePath, $dom->saveXML());
        if ($result === false) {
            throw new OutputWritingException("Writing XML file failed");
        }
    }
}
