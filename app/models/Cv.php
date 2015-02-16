<?php
/**
 * Created by PhpStorm.
 * User: arthurio
 * Date: 15.16.2
 * Time: 15:11
 */

class Cv extends BaseModel {
    private $firstName;

    private $lastName;

    private $birthday;

    private $email;

    private $image;

    private $schools;

    private $languages;

    /**
     * Saglabājam atribūtus
     *
     * @param array $data
     */
    public function setData($data = array())
    {
        foreach ($data as $attribute => $value) {
            $this->$attribute = $value;
        }
    }

    /**
     * Dabūjam visus atribūtus
     * ja onlyValues = true, atgriezt tikai atribūtu vērtības
     *
     * @return array
     */
    public function getData($onlyValues = false)
    {
        if ($onlyValues) {
            return array_values(get_object_vars($this));
        }
        return get_object_vars($this);
    }

    /**
     * Saglabājam visu datubāzē
     *
     */
    public function save()
    {
        $sql = "INSERT INTO user
                    (first_name, last_name, email, image, pdf)
                VALUES
                    (?, ?, ?, ?)";
        $pdo = $this->_db->prepare($sql);

        $data = $this->getData(true);

        return $pdo->execute($data);
    }
}