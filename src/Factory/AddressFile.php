<?php

namespace Moassaad\Addressia\Factory;

use stdClass;

class AddressFile
{
    private $jsonFile;
    
    /**
     * @var string|array|stdClass|object $content
     */
    private $content;
    public function __construct(string $filename = "address.json")
    {
        $this->jsonFile = $this->build($filename);
        $this->toArray();
    }
    public function getContent()
    {
        return $this->content;
    }
    public function build(string $filename ,string $path = 'data_store/address/')
    {
        $linkFile = $this->storagePath($path,$filename);
        $this->content = $this->readFile($linkFile);
        return $this->content;
    }
    protected function storagePath($path, $filename): string
    {
        // TODO get storage path;
        $link = 'storage/'.$path.$filename;
        return $link;
    }
    protected function readFile($filename): string
    {
        return file_get_contents($filename);
    }
    protected function toObject(): static
    {
        $this->content = json_decode($this->content);
        return $this;
    }
    protected function toArray(): array
    {
        $this->content = json_decode($this->content, JSON_OBJECT_AS_ARRAY);
        return $this->content;
    }
    public function isObject()
    {
        return ($this->content instanceof stdClass);
    }
    public function isArray()
    {
        return is_array($this->content);
    }
}
