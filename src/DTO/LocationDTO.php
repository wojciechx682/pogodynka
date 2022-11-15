<?php
namespace App\DTO;

class LocationDTO
{
    /** @var int */
    public $id;

    /** @var string */
    public $name;

    /** @var string */
    public $country;

    /** @var float */
    public $latitude;

    /** @var float */
    public $longitude;

    public function serialize()
    {
        $serialized = [
            'id' => $this->id,
            'name' => $this->name,
            'country' => $this->country,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];

        return $serialized;
    }

    public static function deserialize($serialized)
    {
        $deserialized = new static();
        $deserialized->id = $serialized['id'] ?? null;
        $deserialized->name = $serialized['name'] ?? null;
        $deserialized->country = $serialized['country'] ?? null;
        $deserialized->latitude = $serialized['latitude'] ?? null;
        $deserialized->longitude = $serialized['longitude'] ?? null;

        return $deserialized;
    }
}