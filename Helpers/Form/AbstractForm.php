<?php


namespace App\Helpers\Form;


use App\Entity\Entity;

abstract class AbstractForm
{
    abstract public function formIsValid(): bool;

    abstract public function handleForm(Entity $e);

    abstract public function getFormValues($entity): array;

    public function setPostValuesInSession() {
        session_start();
        foreach ($_POST as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }
}