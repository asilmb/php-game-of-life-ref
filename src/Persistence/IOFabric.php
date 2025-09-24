<?php
declare(strict_types=1);


namespace Life\Persistence;

use Life\Persistence\Xml\XmlFileReader;
use Life\Persistence\Xml\XmlFileWriter;

final class IOFabric
{
    public function getReader(string $file): GameReaderInterface
    {
        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if ($extension === 'xml') {
            return new XmlFileReader($file);
        }
        throw new \Exception();
    }

    public function getWriter(string $file): GameWriterInterface
    {
        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if ($extension === 'xml') {
            return new XmlFileWriter($file);
        }
        throw new \Exception();
    }
}