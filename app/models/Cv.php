<?php
/**
 * Class Cv
 */
class Cv extends BaseModel {
    private $first_name;

    private $last_name;

    private $birthday;

    private $email;

    private $image;

    private $pdf;

    private $education;

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
            $values = array_values(get_object_vars($this));

            foreach ($values as $i => $value) {
                if (is_null($value) || is_object($value)) {
                    unset($values[$i]);
                }
            }
            return $values;
        }
        return get_object_vars($this);
    }

    /**
     * Saglabājam visu datubāzē
     *
     * ideālā variantā, šī funkcija varētu būt abstraktajā klasē, taču testa nolūkos, derēs arī tā
     *
     */
    public function save()
    {
        try {
            $sql = "INSERT INTO user
                    (first_name, last_name, birthday, email, image, pdf)
                VALUES
                    (?, ?, ?, ?, ?, ?)";

            if ($this->_db) {
                $pdo = $this->_db->prepare($sql);

                $data = $this->getData(true);

                $data = array(
                    $data[0], // first name
                    $data[1], // last name
                    $data[2], // birthday
                    $data[3], // email
                    $data[4], // image
                    $data[5]  // pdf
                );

                $pdo->execute($data);

                $userId = $this->_db->lastInsertId();

                // Nav ļoti smuki - var uztaisīt vienu insertu visām skolām, taču
                // ņemot vērā, ka nebūs baigi daudz skolu, šis variants arī derēs
                foreach ($this->education as $edu) {
                    $data = array(
                        $userId,
                        $edu['school_name'],
                        $edu['year_from'],
                        $edu['year_to'],
                        $edu['speciality']
                    );

                    $sql = "INSERT INTO schools
                    (user_id, name, year_from, year_to, speciality)
                VALUES
                    (?, ?, ?, ?, ?)";

                    $pdo = $this->_db->prepare($sql);

                    $pdo->execute($data);
                }

                foreach ($this->languages as $language) {
                    $data = array(
                        $userId,
                        $language['language'],
                        $language['spoken'],
                        $language['reading'],
                        $language['written']
                    );

                    $sql = "INSERT INTO languages
                    (user_id, language, spoken, read, write)
                VALUES
                    (?, ?, ?, ?, ?)";

                    $pdo = $this->_db->prepare($sql);

                    $pdo->execute($data);
                }
            }
        } catch (Exception $e) {
            // Neko nedarīt, jo datubāzes savienojums nav obligāts.
        }
    }
}