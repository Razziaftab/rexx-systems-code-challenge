<?php

namespace App\Services;

use Exception;
use JsonMachine\Exception\JsonMachineException;
use JsonMachine\Items;

class JsonParseService
{
    const JSON_FILE_PATH = 'Code-Challenge(Events).json';

    /**
     * @throws Exception
     */
    public function ParseJsonFile(): Items
    {
        try {
            return Items::fromFile(self::JSON_FILE_PATH);
        } catch (JsonMachineException $e) {
            throw new Exception("Failed to parse the JSON: " . $e->getMessage());
        }
    }
}